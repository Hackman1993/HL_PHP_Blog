<?php

namespace App\Adapter;

use Illuminate\Support\Facades\Log;
use Obs\ObsClient;

class HuaweiObsManager
{
    public function __construct($diskname)
    {
        $this->config = config("filesystems.disks." . $diskname);
    }

    public static function put($path, $file, $diskname = "huawei_obs")
    {
        $config = self::instance($diskname)->config;
        $client = new ObsClient($config);

        $file_path = $file->getRealPath();
        $resp = $client->putObject([
            'Bucket' => $config['bucket'],
            'Key' => $path,
            'SourceFile' => $file_path,
        ]);

        if ($resp["HttpStatusCode"] == 200) {
            return $path;
        } else {
            return null;
        }
    }

    public static function copy($src, $target, $diskname = "huawei_obs")
    {
        $config = self::instance($diskname)->config;
        $client = new ObsClient($config);
        $resp = $client->copyObject([
            'Bucket' => $config['bucket'],
            'Key' => $target,
            'CopySource' => $config['bucket'].'/'.$src,
        ]);

        if ($resp["HttpStatusCode"] == 200) {
            return $target;
        } else {
            return null;
        }
    }

    public static function delete($path, $diskname = "huawei_obs")
    {
        $config = self::instance($diskname)->config;
        $client = new ObsClient($config);
        $resp = $client->deleteObject([
            'Bucket' => $config['bucket'],
            'Key' => $path,
        ]);

        if ($resp["HttpStatusCode"] == 200) {
            return true;
        } else {
            return false;
        }
    }

    protected static function instance($diskname)
    {

        if (!array_key_exists($diskname, HuaweiObsManager::$manager)) {
            HuaweiObsManager::$manager[$diskname] = new HuaweiObsManager("huawei_obs");
        }
        return HuaweiObsManager::$manager[$diskname];
    }

    protected static $manager = [];
    protected $config = [];
}
