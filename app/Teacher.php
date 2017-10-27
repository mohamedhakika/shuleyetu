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
        return $this->belongsToMany('App\Subject', 'teacher_subjects')->withPivot( 'id', 'class_id', 'year');
    }

    public function teaching_classes()
    {
        return $this->belongsToMany('App\Darasa', 'teacher_subjects', 'teacher_id','class_id');
    }

    public function addedBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function classes()
    {
        return $this->belongsToMany('App\Darasa', 'class_teacher', 'teacher_id','class_id')
                                    ->withPivot('id')
                                    ->orderBy('name')
                                    ->orderBy('stream');
    }
}
