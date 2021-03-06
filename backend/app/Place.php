<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'latitude', 'longitude', 'pointsGiven', 'pointsCost', 'user_id', 'img_id'];
	protected $hidden = [];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
