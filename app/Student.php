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

    //Date formated 
    /**
     * @param $column
     * @return null|string
     */
    protected function getFormattedDateAttribute($column){
        if ($this->attributes[$column]) {
            return Carbon::parse($this->attributes[$column])->diffForHumans();
        }
        return null;
    }

    /**
     * @return null|string
     */
    public function getFormattedCreatedAtAttribute() {
        return $this->getFormattedDateAttribute("created_at");
    }

}
