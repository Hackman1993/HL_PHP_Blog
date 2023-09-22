<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RenderingJob extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='t_rendering_job';

    protected $primaryKey = 'job_id';
    protected $fillable=['job_key', 'name'];

    public function files(){
        return $this->morphMany(Attachment::class, "attachable");
    }
}
