<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    protected $table = 'logs';//表名
    protected $fillable = ['user_name', 'user_id', 'url', 'method'];
}
