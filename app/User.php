<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Student table one-one relationship
    public function student()
    {
        return $this->hasOne('App\Student');
    }

    /**
     * Subjects for particular teacher
     */
    public function teacherSubjects()
    {
        return $this->belongsToMany('App\Subject', 'teacher_subjects')->withPivot('id', 'year', 'created_by');
    }

    /**
     * Kidato teacher (stream) for particular teacher
     */
    public function teacherForms()
        {
            return $this->belongsToMany('App\Form', 'teacher_subjects');
        }

    /**
     *Formated date
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
