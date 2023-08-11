<?php

namespace App\Http\Controllers;


use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'string',
            'fn_category_id' => 'integer'
        ]);
        $article = new Article($request->input());
        //$article->author()->associate($request->user());
        $article->save();

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
        $target->update($request->input());
        $target->save();

        return $this->json_response($target);
    }

    public function list(Request $request)
    {
        $query = Article::query()->orderByDesc('created_at');


        return $this->json_response($query->paginate(($request->has("limit")? $request["limit"]:10)));
    }
}
