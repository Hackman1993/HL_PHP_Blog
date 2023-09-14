<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictionary extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 't_dictionary';
    protected $primaryKey = 'dictionary_id';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['text', 'dict_key'];

    public function items()
    {
        return $this->hasMany(DictionaryItem::class, 'fn_dictionary_id', 'dictionary_id');
    }
}
