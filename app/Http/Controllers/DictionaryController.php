<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DictionaryController extends Controller
{
    public function list(Request $request){
        $query = Dictionary::whereNull('parent_id')->with(['items']);

        return $this->json_response($query->paginate($request['limit']));
    }

    public function create(Request $request){
        $request->validate([
            'dict_key' => 'required|unique:t_dictionary,dict_key',
            'text' => 'required',
            'translate' => 'boolean',
            'items' => 'array'
        ]);
        $target = Dictionary::create($request->input());
        if($request->has('items')){
            $items = $request['items'];
            foreach ($items as $item){
                $data_extracted = (array)json_decode($item);
                $child_dict = isset($data_extracted['dictionary_id'])? Dictionary::find($data_extracted['dictionary_id']): new Dictionary($data_extracted);
                $child_dict->update($data_extracted);
                $child_dict->parent()->associate($target);
                $child_dict->save();
            }
        }

        return $this->json_response($target);
    }

    public function update(Request $request, Dictionary $target){
        $request->validate([
            'dict_key' => [Rule::unique('t_dictionary', 'dict_key')->ignore($target->dictionary_id, 'dictionary_id')],
            'text' => 'required',
            'translate' => 'boolean',
            'items' => 'array'
        ]);
        if($request->has('items')){
            $items = $request['items'];
            foreach ($items as $item){
                $data_extracted = (array)json_decode($item);
                $child_dict = isset($data_extracted['dictionary_id'])? Dictionary::find($data_extracted['dictionary_id']): new Dictionary($data_extracted);
                $child_dict->update($data_extracted);
                $child_dict->parent()->associate($target);
                $child_dict->save();
            }
        }
        $target->update($request->input());

        return $this->json_response($target);
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'ids' => 'array|required'
        ]);
        Dictionary::whereIn('dictionary_id', $request['ids'])->orWhereIn('parent_id', $request['ids'])->delete();
        return $this->json_response();
    }
}
