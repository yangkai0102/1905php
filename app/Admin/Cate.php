<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    public $primaryKey='cate_id';

    protected $table='cate';

    public $timestamps=false;
}
