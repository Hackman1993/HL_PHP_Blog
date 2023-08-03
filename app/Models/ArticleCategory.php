<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class ArticleCategory extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;
    protected $table = "t_article_category";
    protected $primaryKey="art_category_id";
    protected $fillable=['label', 'priority', 'action_type', 'value'];
    protected $hidden = ['_lft', '_rgt', 'priority', 'created_at', 'updated_at', 'deleted_at', 'fk_parent_id'];

    public function getParentIdName(): string
    {
        return 'fk_parent_id';
    }

    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class, 'fk_category_id', 'art_category_id');
    }
}
