<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignRecord extends Model
{
    use HasFactory;
    protected $table = 'g_sign_record';
    protected $primaryKey='sign_record_id';
    protected $fillable = ['name', 'phone'];
    protected $hidden=['created_at', 'updated_at'];
}
