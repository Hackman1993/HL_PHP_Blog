<?php

namespace App\Http\Controllers;

use App\Adapter\HuaweiObsManager;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function editorUpload(Request $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('file');
        $file_hash_name = $file->hashName();

        HuaweiObsManager::put("assets/image/".$file_hash_name, $request->file('file'), ["Expires" => 1]);
        Storage::disk("huawei_obs")->put("assets/image/".$file_hash_name, $request->file('file'),[]);
        $path = $file->storePubliclyAs("assets/image", $file_hash_name, "huawei_obs");
        $attachment = new Attachment([
            "original_name" => $file->getClientOriginalName(),
            "url" => '${OSS_URL}/assets/image/"'.$file_hash_name,
            "file_size" => $file->getSize(),
            "access_url" => "/assets/image/".$file_hash_name,
            "thumbnail_url" => ""
        ]);
        $attachment->fn_owner_id = 1;
        $attachment->save();
        return response()->json([
            'attachment_id' => $attachment->attachment_id,
            'location' => $attachment->url
        ]);
    }
}
