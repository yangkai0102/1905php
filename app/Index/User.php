<?php

namespace App\Index;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $primaryKey='user_id';

    protected $table='user';

    public $timestamps=false;

    protected $guarded=[];
}
