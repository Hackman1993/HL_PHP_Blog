<?php

namespace App\Http\Controllers;


use App\Adapter\HuaweiObsManager;
use App\Models\Article;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'string',
            'fn_category_id' => 'integer',
            'attachments' => 'json'
        ]);
        $article = new Article($request->input());
        $article->save();
        if($request->has("attachments")){
            $attachments = json_decode($request['attachments']);
            foreach ($attachments as $attachment){
                $model = new Attachment();
                $model->original_name = $attachment->original_name;
                $model->url = $attachment->storage_url;
                $model->file_size = $attachment->file_size;
                $model->access_url = '${STORAGE_BASE_URL}/'.$attachment->storage_url;
                $model->attachable()->associate($article);
                $model->fn_owner_id = 1;
                $model->save();
            }
        }
        //$article->author()->associate($request->user());

        return $this->json_response([]);
    }

    public function content(Request $request, Article $target)
    {
        //$article->author()->associate($request->user());
        $target->content_html = $target->content;

        return $this->json_response($target);
    }

    public function update(Request $request, Article $target)
    {
        $request->validate([
            'attachments' => 'json'
        ]);

        if($request->has("attachments")){
            $attachments = json_decode($request['attachments']);
            foreach ($attachments as $attachment){
                $model = new Attachment();
                $model->original_name = $attachment->original_name;
                $model->url = $attachment->storage_url;
                $model->file_size = $attachment->file_size;
                $model->access_url = '${STORAGE_BASE_URL}/'.$attachment->storage_url;
                $model->attachable()->associate($target);
                $model->fn_owner_id = 1;
                $model->save();
            }
        }

        $target->update($request->input());
        $target->save();

        return $this->json_response($target);
    }

    public function list(Request $request)
    {
        $query = Article::with('category')->orderByDesc('created_at');

        return $this->json_response($query->paginate(($request->has("limit")? $request["limit"]:10)));
    }

    public function delete(Request $request, Article $target)
    {
        foreach($target->attachments as $attachment){
            HuaweiObsManager::delete($attachment->url);
            $attachment->delete();
        }
        $target->delete();

        return $this->json_response();
    }
}
