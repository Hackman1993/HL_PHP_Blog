<?php

namespace App\Http\Controllers;

use App\Adapter\HuaweiObsManager;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'file' => 'file|required'
        ]);
        $file = $request->file('file');
        $file_hash_name = $file->hashName();
        $storage_path = "temp_upload/".$file_hash_name;

        if(HuaweiObsManager::put($storage_path, $request->file('file'))){
            $attachment = new Attachment([
                "original_name" => $file->getClientOriginalName(),
                "url" => $storage_path,
                "file_size" => $file->getSize(),
                "access_url" => env('OBS_VISIT_BASE', "")."/".$storage_path,
                "hashname" => $file_hash_name
            ]);
            $attachment->fn_owner_id = 1;
            $attachment->save();
            return $this->json_response(Attachment::find($attachment->attachment_id));
        }
        return $this->json_response();
    }

    public function info(Request $request, Attachment $target): \Illuminate\Http\JsonResponse
    {
        return $this->json_response($target);
    }
}
