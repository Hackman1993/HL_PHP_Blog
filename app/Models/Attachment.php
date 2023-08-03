<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='t_attachment';
    protected $primaryKey="attachment_id";

    protected $fillable=['url', 'file_size', 'storage_path', 'access_url', 'thumbnail_url', "original_name"];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function target(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo('target');
    }

    public function uploader(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'fn_owner_id', 'user_id');
    }
}
