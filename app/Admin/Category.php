<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $primaryKey='cate_id';

    protected $table='category';

    public $timestamps=false;
    //白名单  表设计中不允许为空的
//    protected $fillable=['brand_name','brand_url'];

    //黑名单  表设计中允许为空的
    protected $guarded=[];
}
