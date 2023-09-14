<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DictionaryItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_dictionary_item';
    protected $primaryKey = 'dict_item_id';
    protected $fillable=['text', 'item_key', 'translate'];
    protected $casts=['translate'=>'boolean'];

    public function parent()
    {
        return $this->belongsTo(Dictionary::class, 'fn_dictionary_id', 'dictionary_id');
    }
}
