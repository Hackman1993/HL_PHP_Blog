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
            'attachments' => 'array',
            'keywords' => 'array',
            'dict_item_ids'=>'array'
        ]);
        $target = new Article($request->input());
        $target->content = $request['content'];

        if ($request->has('keywords')) {
            $target->keywords = implode(',', $request['keywords']);
        }

        if ($request->has("attachments")) {
            foreach ($request['attachments'] as $attachment_id) {
                $attachment = Attachment::find($attachment_id);
                if ($attachment && !$attachment->persist) {

                    $storage_path = "assets/images/" . $attachment->hashname;
                    $target->content = str_replace($attachment->url, $storage_path, $target->content);
                    $attachment->url = HuaweiObsManager::copy($attachment->url, $storage_path);
                    $attachment->persist = 1;
                    $attachment->access_url = env('OBS_VISIT_BASE', "") . "/" . $storage_path;
                    $attachment->attachable()->associate($target);
                    $attachment->save();
                }
            }
        }
        if ($request->has('fn_cover_id')) {
            $attachment = Attachment::find($request['fn_cover_id']);
            if ($attachment && !$attachment->persist) {
                $storage_path = "assets/images/" . $attachment->hashname;
                $attachment->url = HuaweiObsManager::copy($attachment->url, $storage_path);
                $attachment->persist = 1;
                $attachment->access_url = env('OBS_VISIT_BASE', "") . "/" . $storage_path;
                $attachment->attachable()->associate($target);
                $attachment->save();
            }
        }
        $target->dict_item()->sync($request['dict_item_ids']);
        $target->save();
        return $this->json_response([]);
    }

    public function content(Request $request, Article $target): \Illuminate\Http\JsonResponse
    {
        //$article.blade.php->author()->associate($request->user());
        $target->content_html = $target->content;
        $target->cover = $target->cover;
        $target->dict_item_ids = $target->dict_item->pluck('dict_item_id');

        return $this->json_response($target);
    }

    public function update(Request $request, Article $target): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'attachments' => 'array',
            'keywords' => 'array'
        ]);
        $target->content = $request['content'];

        if ($request->has('keywords')) {
            $target->keywords = implode(',', $request['keywords']);
        }
        if ($request->has("attachments")) {
            foreach ($request['attachments'] as $attachment_id) {
                $attachment = Attachment::find($attachment_id);
                if ($attachment && !$attachment->persist) {

                    $storage_path = "assets/images/" . $attachment->hashname;
                    $target->content = str_replace($attachment->url, $storage_path, $target->content);
                    $attachment->url = HuaweiObsManager::copy($attachment->url, $storage_path);
                    $attachment->persist = 1;
                    $attachment->access_url = env('OBS_VISIT_BASE', "") . "/" . $storage_path;
                    $attachment->attachable()->associate($target);
                    $attachment->save();
                }
            }
        }
        if ($request->has('fn_cover_id')) {
            $attachment = Attachment::find($request['fn_cover_id']);
            if ($attachment && !$attachment->persist) {
                $storage_path = "assets/images/" . $attachment->hashname;
                $attachment->url = HuaweiObsManager::copy($attachment->url, $storage_path);
                $attachment->persist = 1;
                $attachment->access_url = env('OBS_VISIT_BASE', "") . "/" . $storage_path;
                $attachment->attachable()->associate($target);
                $attachment->save();
            }
        }

        $target->update($request->input());
        $target->save();
        $target->dict_item()->sync($request['dict_item_ids']);
        return $this->json_response($target);
    }

    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = Article::with(['category', 'cover'])->orderByDesc('created_at');

        return $this->json_response($query->paginate(($request->has("limit") ? $request["limit"] : 10)));
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'article_ids' => 'array|required'
        ]);
        $articles = Article::with(['attachments'])->whereIn('article_id', $request['article_ids'])->get();
        foreach ($articles as $target) {
            foreach ($target->attachments as $attachment) {
                HuaweiObsManager::delete($attachment->url);
                $attachment->delete();
            }
            $target->delete();
        }
        return $this->json_response();
    }
}
