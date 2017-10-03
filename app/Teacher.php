<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function addedBy(){
        return $this->belongsTo('App\User', 'created_by');
    }
}
