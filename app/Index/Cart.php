<?php

namespace App\Index;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $primaryKey='cart_id';

    protected $table='cart';

    public $timestamps=false;

    protected $guarded=[];
}


