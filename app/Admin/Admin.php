<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
class Admin extends Model
{
    //
    public $primaryKey='admin_id';

    protected $table='admin';

    public $timestamps=false;
    //白名单  表设计中不允许为空的
//    protected $fillable=['brand_name','brand_url'];

    //黑名单  表设计中允许为空的
    protected $guarded=[];
}
