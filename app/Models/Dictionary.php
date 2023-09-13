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
    protected $fillable = ['text', 'translate', 'dict_key'];
    protected $casts = ['translate' => 'boolean'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'dictionary_id');
    }

    public function items()
    {
        return $this->hasMany(self::class, 'parent_id', 'dictionary_id');
    }
}
