<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'teacher_subjects')->withPivot( 'year');
    }

    public function addedBy(){
        return $this->belongsTo('App\User', 'created_by');
    }
}
