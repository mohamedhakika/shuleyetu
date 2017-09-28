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
    // protected $fillable = [
    //     'name', 'level', 'created_by', 'updated_by',
    // ];

    public function kidato()
    {
        return $this->belongsTo('App\Kidato', 'vidato_id');
    }

    public function updatedBy(){
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by');
    }
}
