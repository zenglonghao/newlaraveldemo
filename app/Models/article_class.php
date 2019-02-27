<?php
namespace App\Models;

class article_class extends Model{
    protected $fillable = ['ac_id', 'ac_name','ac_parent_id','ac_sort'];//字段
    protected $table = 'article_class';//表名
    protected $primaryKey = 'ac_id';//主键
    public $timestamps = false; //取消自动管理(时间戳设置)



}






