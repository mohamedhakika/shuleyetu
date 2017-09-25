<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assessID', 'name', 'created_by', 'updated_by',
    ];

    public function addedBy()
    {
    	return $this->belongsTo('App\User', 'created_by');	
    }

    public function updatedBy()
    {
    	return $this->belongsTo('App\User', 'updated_by');
    }
}
