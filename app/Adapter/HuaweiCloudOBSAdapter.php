<?php

namespace App\Adapter;
use App\Exceptions\WebApiException;
use Generator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Config;
use League\Flysystem\DirectoryAttributes;
use League\Flysystem\FileAttributes;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\FilesystemOperationFailed;
use League\Flysystem\PathPrefixer;
use League\Flysystem\StorageAttributes;
use League\Flysystem\UnableToCheckDirectoryExistence;
use League\Flysystem\UnableToCheckFileExistence;
use League\Flysystem\UnableToCopyFile;
use League\Flysystem\UnableToCreateDirectory;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\UnableToMoveFile;
use League\Flysystem\UnableToReadFile;
use League\Flysystem\UnableToRetrieveMetadata;
use League\Flysystem\UnableToSetVisibility;
use League\Flysystem\UnableToWriteFile;
use League\Flysystem\Visibility;
use League\MimeTypeDetection\FinfoMimeTypeDetector;
use League\MimeTypeDetection\MimeTypeDetector;
use Obs\ObsClient;

use Obs\ObsException;
use Psr\Http\Message\StreamInterface;

class HuaweiCloudOBSAdapter implements FilesystemAdapter
{
    private $client;


    private $prefixer;


    private $bucket;


    private $visibility;


    private $mimeTypeDetector;

    private $options;

    private $streamReads;

    public function __construct(
        array $config
//        ObsClient $client
//        string $bucket,
//        string $prefix = '',
//        VisibilityConverter $visibility = null,
//        MimeTypeDetector $mimeTypeDetector = null,
//        array $options = [],
//        bool $streamReads = true
    ) {

        $this->client = new ObsClient($config);
        $this->bucket = $config['bucket'];
//        $this->prefixer = new PathPrefixer($prefix);
//        $this->bucket = $bucket;
//        $this->visibility = $visibility ?: new PortableVisibilityConverter();
//        $this->mimeTypeDetector = $mimeTypeDetector ?: new FinfoMimeTypeDetector();
//        $this->options = $options;
//        $this->streamReads = $streamReads;
    }

    public function fileExists(string $path): bool
    {
        try {
            try {
                $metadata =  $this->client->getObjectMetadata([
                    "Bucket" => $this->bucket,
                    "Key" => $path
                ]);
                return true;
            }catch (ObsException $e){
                if($e->getResponse()->getStatusCode() == 404)
                    return false;
                else throw new WebApiException($e->getMessage());
            }
        } catch (Throwable $exception) {
            throw UnableToCheckFileExistence::forLocation($path, $exception);
        }
    }

    public function directoryExists(string $path): bool
    {
        try {
            return false;
        } catch (Throwable $exception) {
            throw UnableToCheckDirectoryExistence::forLocation($path, $exception);
        }
    }

    public function write(string $path, string $contents, Config $config): void
    {
        $this->upload($path, $contents, $config);
    }

    public function getUrl(string $path) : string
    {
        return '${OBS_URL}/'.$path;
    }

    /**
     * @param string          $path
     * @param string|resource $body
     * @param Config          $config
     */
    private function upload(string $path, $body, Config $config): void
    {
        try {
            dd($config);
            $result = $this->client->putObject([
                'Bucket' => $this->bucket,
                'Key' => $path,
                'Body' => $body,
                'StorageClass' => ObsClient::StorageClassStandard
            ]);
        } catch (Throwable $exception) {
            throw UnableToWriteFile::atLocation($path, '', $exception);
        }
    }


    private function determineAcl(Config $config): string
    {
        dd(1);
        $visibility = (string) $config->get(Config::OPTION_VISIBILITY, Visibility::PRIVATE);

        return $this->visibility->visibilityToAcl($visibility);
    }

    private function createOptionsFromConfig(Config $config): array
    {
        dd(2);
        $config = $config->withDefaults($this->options);
        $options = ['params' => []];

        if ($mimetype = $config->get('mimetype')) {
            $options['params']['ContentType'] = $mimetype;
        }

        foreach (static::AVAILABLE_OPTIONS as $option) {
            $value = $config->get($option, '__NOT_SET__');

            if ($value !== '__NOT_SET__') {
                $options['params'][$option] = $value;
            }
        }

        foreach (static::MUP_AVAILABLE_OPTIONS as $option) {
            $value = $config->get($option, '__NOT_SET__');

            if ($value !== '__NOT_SET__') {
                $options[$option] = $value;
            }
        }

        return $options;
    }

    public function writeStream(string $path, $contents, Config $config): void
    {
        $this->upload($path, $contents, $config);
    }

    public function read(string $path): string
    {
        dd(4);
        $body = $this->readObject($path, false);

        return (string) $body->getContents();
    }

    public function readStream(string $path)
    {
        dd(5);
        /** @var resource $resource */
        $resource = $this->readObject($path, true)->detach();

        return $resource;
    }

    public function delete(string $path): void
    {

        try {
            Log::warning($path);
            $this->client->deleteObject([
                "Bucket" => $this->bucket,
                "Key"=>$path
            ]);
        } catch (Throwable $exception) {
            throw UnableToDeleteFile::atLocation($path, '', $exception);
        }
    }

    public function deleteDirectory(string $path): void
    {
        dd(7);
        $prefix = $this->prefixer->prefixPath($path);
        $prefix = ltrim(rtrim($prefix, '/') . '/', '/');

        try {
            $this->client->deleteMatchingObjects($this->bucket, $prefix);
        } catch (Throwable $exception) {
            throw UnableToCreateDirectory::dueToFailure($path, $exception);
        }
    }

    public function createDirectory(string $path, Config $config): void
    {
        dd(8);
        $defaultVisibility = $config->get('directory_visibility', $this->visibility->defaultForDirectories());
        $config = $config->withDefaults(['visibility' => $defaultVisibility]);
        $this->upload(rtrim($path, '/') . '/', '', $config);
    }

    public function setVisibility(string $path, string $visibility): void
    {
        dd(9);
        $arguments = [
            'Bucket' => $this->bucket,
            'Key' => $this->prefixer->prefixPath($path),
            'ACL' => $this->visibility->visibilityToAcl($visibility),
        ];
        $command = $this->client->getCommand('PutObjectAcl', $arguments);

        try {
            $this->client->execute($command);
        } catch (Throwable $exception) {
            throw UnableToSetVisibility::atLocation($path, '', $exception);
        }
    }

    public function visibility(string $path): FileAttributes
    {
        dd(10);
        $arguments = ['Bucket' => $this->bucket, 'Key' => $this->prefixer->prefixPath($path)];
        $command = $this->client->getCommand('GetObjectAcl', $arguments);

        try {
            $result = $this->client->execute($command);
        } catch (Throwable $exception) {
            throw UnableToRetrieveMetadata::visibility($path, '', $exception);
        }

        $visibility = $this->visibility->aclToVisibility((array) $result->get('Grants'));

        return new FileAttributes($path, null, $visibility);
    }

    private function fetchFileMetadata(string $path, string $type): FileAttributes
    {
        dd(11);
        $arguments = ['Bucket' => $this->bucket, 'Key' => $this->prefixer->prefixPath($path)];
        $command = $this->client->getCommand('HeadObject', $arguments);

        try {
            $result = $this->client->execute($command);
        } catch (Throwable $exception) {
            throw UnableToRetrieveMetadata::create($path, $type, '', $exception);
        }

        $attributes = $this->mapS3ObjectMetadata($result->toArray(), $path);

        if ( ! $attributes instanceof FileAttributes) {
            throw UnableToRetrieveMetadata::create($path, $type, '');
        }

        return $attributes;
    }

    private function mapS3ObjectMetadata(array $metadata, string $path = null): StorageAttributes
    {
        dd(12);
        if ($path === null) {
            $path = $this->prefixer->stripPrefix($metadata['Key'] ?? $metadata['Prefix']);
        }

        if (substr($path, -1) === '/') {
            return new DirectoryAttributes(rtrim($path, '/'));
        }

        $mimetype = $metadata['ContentType'] ?? null;
        $fileSize = $metadata['ContentLength'] ?? $metadata['Size'] ?? null;
        $fileSize = $fileSize === null ? null : (int) $fileSize;
        $dateTime = $metadata['LastModified'] ?? null;
        $lastModified = $dateTime instanceof DateTimeResult ? $dateTime->getTimeStamp() : null;

        return new FileAttributes(
            $path,
            $fileSize,
            null,
            $lastModified,
            $mimetype,
            $this->extractExtraMetadata($metadata)
        );
    }

    private function extractExtraMetadata(array $metadata): array
    {
        dd(13);
        $extracted = [];

        foreach (static::EXTRA_METADATA_FIELDS as $field) {
            if (isset($metadata[$field]) && $metadata[$field] !== '') {
                $extracted[$field] = $metadata[$field];
            }
        }

        return $extracted;
    }

    public function mimeType(string $path): FileAttributes
    {
        dd(14);
        $attributes = $this->fetchFileMetadata($path, FileAttributes::ATTRIBUTE_MIME_TYPE);

        if ($attributes->mimeType() === null) {
            throw UnableToRetrieveMetadata::mimeType($path);
        }

        return $attributes;
    }

    public function lastModified(string $path): FileAttributes
    {
        dd(15);
        $attributes = $this->fetchFileMetadata($path, FileAttributes::ATTRIBUTE_LAST_MODIFIED);

        if ($attributes->lastModified() === null) {
            throw UnableToRetrieveMetadata::lastModified($path);
        }

        return $attributes;
    }

    public function fileSize(string $path): FileAttributes
    {
        dd(16);
        $attributes = $this->fetchFileMetadata($path, FileAttributes::ATTRIBUTE_FILE_SIZE);

        if ($attributes->fileSize() === null) {
            throw UnableToRetrieveMetadata::fileSize($path);
        }

        return $attributes;
    }

    public function listContents(string $path, bool $deep): iterable
    {
        dd(17);
        $prefix = trim($this->prefixer->prefixPath($path), '/');
        $prefix = empty($prefix) ? '' : $prefix . '/';
        $options = ['Bucket' => $this->bucket, 'Prefix' => $prefix];

        if ($deep === false) {
            $options['Delimiter'] = '/';
        }

        $listing = $this->retrievePaginatedListing($options);

        foreach ($listing as $item) {
            yield $this->mapS3ObjectMetadata($item);
        }
    }

    private function retrievePaginatedListing(array $options): Generator
    {
        dd(18);
        $resultPaginator = $this->client->getPaginator('ListObjects', $options + $this->options);

        foreach ($resultPaginator as $result) {
            yield from ($result->get('CommonPrefixes') ?: []);
            yield from ($result->get('Contents') ?: []);
        }
    }

    public function move(string $source, string $destination, Config $config): void
    {
        dd(19);
        try {
            $this->copy($source, $destination, $config);
            $this->delete($source);
        } catch (FilesystemOperationFailed $exception) {
            throw UnableToMoveFile::fromLocationTo($source, $destination, $exception);
        }
    }

    public function copy(string $source, string $destination, Config $config): void
    {
        dd(20);
        try {
            /** @var string $visibility */
            $visibility = $this->visibility($source)->visibility();
        } catch (Throwable $exception) {
            throw UnableToCopyFile::fromLocationTo(
                $source,
                $destination,
                $exception
            );
        }

        try {
            $this->client->copy(
                $this->bucket,
                $this->prefixer->prefixPath($source),
                $this->bucket,
                $this->prefixer->prefixPath($destination),
                $this->visibility->visibilityToAcl($visibility),
                $this->createOptionsFromConfig($config)['params']
            );
        } catch (Throwable $exception) {
            throw UnableToCopyFile::fromLocationTo($source, $destination, $exception);
        }
    }

    private function readObject(string $path, bool $wantsStream): StreamInterface
    {
        dd(21);
        $options = ['Bucket' => $this->bucket, 'Key' => $this->prefixer->prefixPath($path)];

        if ($wantsStream && $this->streamReads && ! isset($this->options['@http']['stream'])) {
            $options['@http']['stream'] = true;
        }

        $command = $this->client->getCommand('GetObject', $options + $this->options);

        try {
            return $this->client->execute($command)->get('Body');
        } catch (Throwable $exception) {
            throw UnableToReadFile::fromLocation($path, '', $exception);
        }
    }
}
