<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\DictionaryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DictionaryController extends Controller
{
    public function list(Request $request){
        $query = Dictionary::with(['items']);

        return $this->json_response($query->paginate($request['limit']));
    }

    public function all_parent(Request $request){
        return $this->json_response(Dictionary::all());
    }

    public function get_by_key(Request $request){
        $request->validate([
            'dict_key' => "required|exists:t_dictionary,dict_key"
        ]);
        $query = Dictionary::with('items')->where('dict_key', $request['dict_key'])->first();
        return json_decode($query);
    }

    public function create(Request $request){
        $request->validate([
            'dict_key' => 'required|unique:t_dictionary,dict_key',
            'text'=> 'required|string',
            'items' => 'array'
        ]);
        $target = Dictionary::create($request->input());
        if($request->has('items')){
            $items = $request['items'];
            foreach ($items as $item){
                $data_extracted = (array)json_decode($item);
                $child_dict = isset($data_extracted['dict_item_id'])? DictionaryItem::find($data_extracted['dict_item_id']): new DictionaryItem($data_extracted);
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
            'items' => 'array',
            'deleted' => 'array'
        ]);
        if($request->has('items')){
            $items = $request['items'];
            foreach ($items as $item){
                $data_extracted = (array)json_decode($item);
                $child_dict = isset($data_extracted['dict_item_id'])? DictionaryItem::find($data_extracted['dict_item_id']): new DictionaryItem($data_extracted);
                $child_dict->update($data_extracted);
                $child_dict->parent()->associate($target);
                $child_dict->save();
            }
        }
        if($request->has('deleted')){
            DictionaryItem::whereIn('dict_item_id', $request['deleted'])->delete();
        }
        $target->update($request->input());

        return $this->json_response($target);
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'ids' => 'array|required'
        ]);
        DictionaryItem::whereIn('fn_dictionary_id', $request['ids'])->delete();
        Dictionary::whereIn('dictionary_id', $request['ids'])->delete();
        return $this->json_response();
    }
}
