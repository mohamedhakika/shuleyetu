<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'level', 'created_by', 'updated_by',
    ];

    public function teacherForms()
    {
        return $this->belongsToMany('App\Form', 'teacher_subjects')->withPivot('id', 'year', 'created_by');
    }
}
