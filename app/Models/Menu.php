<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;
    protected $primaryKey='menu_id';
    protected $table='t_menu';
    protected $hidden=['created_at', 'updated_at', 'deleted_at', '_lft', '_rgt', 'parent_id', 'description', 'fn_permission_id'];

    public function getParentIdName(): string
    {
        return 'parent_id';
    }



}
