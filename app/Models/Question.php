<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'g_question';
    protected $primaryKey='question_id';
    protected $fillable = ['question_text', 'question_html', 'option_data'];
    protected $hidden=['created_at', 'updated_at', 'deleted_at'];
}
