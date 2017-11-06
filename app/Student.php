<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'reg_no', 'address', 'mobile_no',
        'first_name', 'middle_name', 'last_name',
        'dob', 'year_admitted', 'status', 'level',
        'thumbnail', 'created_by', 'updated_by',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function forms()
    {
        return $this->belongsToMany('App\Darasa', 'class_student', 'student_id', 'class_id')->withPivot('id', 'year');
    }

    public function combination()
    {
        return $this->belongsTo('App\Combination');
    }

     /**
     * Returning User created the student
     * @return User
     */

    public function addedBy(){
        return $this->belongsTo('App\User', 'created_by');
    }

    public function tabia()
    {
        return $this->belongsToMany('App\Tabia', 'student_tabia', 'student_id', 'tabia_id')
            ->withPivot('id', 'grade', 'term', 'year');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject')->orderBy('name', 'DESC');
    }

    public function results()
    {
        return $this->hasMany('App\Result');
    }

}
