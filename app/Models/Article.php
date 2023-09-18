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
    protected $fillable=["title", "fn_category_id", "abstract", 'fn_cover_id'];
    protected $hidden=["updated_at", "deleted_at", "content"];
    protected $casts=[
        "created_at" => "date:Y-m-d"
    ];

    public function category(){
        return $this->belongsTo(ArticleCategory::class, 'fn_category_id', 'art_category_id');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, "attachable");
    }

    public function cover(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Attachment::class, 'attachment_id', 'fn_cover_id');
    }

    public function dict_item(){
        return $this->belongsToMany(DictionaryItem::class, 't_mid_article_dict_item','fn_article_id', 'fn_dict_item_id');
    }
}
