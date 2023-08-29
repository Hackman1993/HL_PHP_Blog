<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerRecord extends Model
{
    use HasFactory;

    protected $primaryKey = 'answer_record_id';
    protected $table = 'g_answer_record';
    protected $fillable = ['name', 'phone', 'score'];
    protected $hidden = ['created_at', 'updated_at'];
}
