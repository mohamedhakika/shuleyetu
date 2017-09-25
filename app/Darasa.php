<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Darasa extends Model
{
    //Table deffinition here
    protected $table = 'classes';

    protected $fillable = [
      'name',
      'level',
      'stream',
    ];
}
