<?php

namespace App\Adapter;

use Obs\ObsClient;

class HuaweiObsManager
{
    public function __construct($diskname)
    {
        $this->config = config("filesystems.disks." . $diskname);
    }

    public static function put($path, $file, $option, $diskname = "huawei_obs")
    {
        $config = self::instance($diskname)->config;
        $client = new ObsClient($config);
        $res2 = $client->optionsObject([
            "Bucket" => $config['bucket'],
            "Key" => "assets/image/LoaHAoW5L3kY3kdWOf5YcvaJMVb7qCPXdSCxjNOF.jpg"
        ]);

        $file_path = $file->getRealPath();
        $resp = $client->putObject([
            'Bucket' => $config['bucket'],
            'Key' => $path,
            'SourceFile' => $file_path,
        ]);

        if ($resp["HttpStatusCode"] == 200) {
            return '${OBS_URL}' . $path;
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
