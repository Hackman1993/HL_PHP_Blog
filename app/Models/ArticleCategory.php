<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class ArticleCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "t_article_category";
    protected $primaryKey="art_category_id";
    protected $fillable=['label', 'action_type', 'value', 'fn_category_id'];
    protected $hidden = ['_lft', '_rgt', 'priority', 'created_at', 'updated_at', 'deleted_at', 'fn_parent_id'];


    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class, 'fn_category_id', 'art_category_id');
    }

    public function dictionaries(){
        return $this->belongsToMany(Dictionary::class, 't_mid_article_category_dictionary', 'article_category_id', 'dictionary_id');
    }
}
