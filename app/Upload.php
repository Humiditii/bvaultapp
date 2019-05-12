<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    protected $fillable = [

    	'description',
    	'path',
    	'size',
    	'extension',
    	'type',
    	'sizeType',

    ]; 


}
