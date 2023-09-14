<?php

namespace App\Http\Controllers;


use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function view(Request $request): \Illuminate\Http\JsonResponse
    {

        $query = ArticleCategory::query();
        if($request->has('except'))
            $query->where("art_category_id", "<>", $request->input('except'));

        return $this->json_response($query->get());
    }

    public function list(Request $request)
    {
        $query = ArticleCategory::withCount(['articles'])->with(['dictionaries'])->orderByDesc('created_at');
        return $this->json_response($query->paginate($request['limit']));
    }

    public function create(Request $request)
    {
        return $this->json_response(ArticleCategory::create($request->input()));
    }
    public function update(Request $request, ArticleCategory $target)
    {
        $request->validate([ 'dict_ids'=>'array']);
        $target->update($request->input());
        $target->dictionaries()->sync($request['dict_ids']);
        return $this->json_response($target);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'ids' => 'array|required'
        ]);
        ArticleCategory::whereIn('art_category_id', $request['ids'])->delete();
        return $this->json_response();
    }
}
