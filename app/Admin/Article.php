<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public $primaryKey='article_id';

    protected $table='article';

    public $timestamps=false;

    protected $guarded=[];

}
