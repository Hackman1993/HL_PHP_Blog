<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="t_article";
    protected $primaryKey="article_id";
    protected $fillable=["title", "content", "keywords", "fn_category_id"];
    protected $hidden=["updated_at", "deleted_at", "content"];
    protected $casts=[
        "created_at" => "date:Y-m-d"
    ];

}
