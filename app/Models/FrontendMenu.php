<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class FrontendMenu extends Model
{
    use HasFactory, NodeTrait;
    protected $table="t_frontend_menu";
    protected $primaryKey="frontend_menu_id";

}
