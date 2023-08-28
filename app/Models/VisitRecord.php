<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitRecord extends Model
{
    use HasFactory;
    protected $primaryKey='visit_record_id';
    protected $table='g_visit_record';

    protected $fillable=['key'];
}
