<?php

namespace App\Http\Controllers;


use App\Models\Attachment;
use App\Models\RenderingJob;
use App\Protobuf\Model\RenderingJobItem;
use Denpa\ZeroMQ\Facades\ZeroMQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use longlang\phpkafka\Producer\Producer;
use longlang\phpkafka\Producer\ProducerConfig;
use Ramsey\Uuid\Uuid;

class RenderingJobController extends Controller
{
    public function test()
    {
        $config = new ProducerConfig();
        $config->setBootstrapServers(['192.168.0.175:9092', '192.168.0.175:9093', '192.168.0.175:9094']);
        $config->setUpdateBrokers(true);
        $config->setAutoCreateTopic(true);
        $producer = new Producer($config);
        $producer->send('testTopic', json_encode(['aaaccc' => 'bbbccc']), Uuid::uuid4());
    }

    public function upload(Request $request)
    {
        $request->validate([
            'sha512' => 'required|string',
            'file' => 'required|file',
            'relative_path' => 'required|string',
            'token' => 'required|string|exists:t_rendering_job,job_key'
        ]);

        $render_job = RenderingJob::where('job_key', $request['token'])->first();
        $file = $request->file('file');
        $attachment = $render_job->files()->where([
            'original_name' => $request['relative_path'],
        ])->first();
        if($attachment && $attachment->sha512 == $request['sha512'])
            return $this->json_response();
        $path = $file->storePubliclyAs("/render_job/" . $render_job->job_key, $file->hashName(), 'public');
        if ($attachment == null) {
            $attachment = new Attachment([
                'url' => $path,
                'access_url' => '/storage/' . $path,
                'original_name' => $request['relative_path'],
                'sha512' => $request['sha512'],
                'file_size' => $file->getSize(),
            ]);
            $attachment->persist = 1;
        }else {
            Storage::disk('public')->delete($attachment->url);
            $attachment->url = $path;
            $attachment->access_url = '/storage/'. $path;
            $attachment->file_size = $file->getSize();
            $attachment->sha512 = $request['sha512'];
        }
        $attachment->attachable()->associate($render_job);
        $attachment->save();
        return $this->json_response();
    }

    public function finish_upload(Request $request){
        $job = new RenderingJobItem();
        $job->setFrame(930922);

        $request->validate([
            'token' => 'required|string|exists:t_rendering_job,job_key',
        ]);

//        $render_job = RenderingJob::where('job_key', $request['token'])->first();
//        if($render_job){
//        }
        ZeroMQ::push($job->serializeToString());
        return $this->json_response();

    }
}
