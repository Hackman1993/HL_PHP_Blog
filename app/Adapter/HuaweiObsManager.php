<?php

namespace App\Adapter;

use Obs\ObsClient;

class HuaweiObsManager
{
    public function __construct($diskname)
    {
        $this->config = config("filesystems.disks.".$diskname);
    }

    public static function put($path, $file, $option, $diskname = "huawei_obs"){
        $config = self::instance($diskname)->config;
        $client = new ObsClient($config);
        $res2 = $client->optionsObject([
            "Bucket" => $config['bucket'],
            "Key" => "assets/image/LoaHAoW5L3kY3kdWOf5YcvaJMVb7qCPXdSCxjNOF.jpg"
        ]);
        dd($res2);
        $file_path = $file->getRealPath();
        $resp = $client->putObject([
            'Bucket' => $config['bucket'],
            'Key' => $path,
            'SourceFile' => $file_path,
            'Expires' => 1
        ]);

        if($resp["HttpStatusCode"] == 200){
            return '${OBS_URL}'.$path;
        }else{
            return null;
        }
    }

    protected static function instance($diskname){

        if(!array_key_exists($diskname, HuaweiObsManager::$manager)){
            HuaweiObsManager::$manager[$diskname] = new HuaweiObsManager("huawei_obs");
        }
        return HuaweiObsManager::$manager[$diskname];
    }
    protected static $manager = [] ;
    protected $config = [];
}
