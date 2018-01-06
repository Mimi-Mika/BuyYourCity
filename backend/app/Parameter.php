<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
	protected $fillable = ['name', 'perimeter', 'sellPercent', 'seeRadius', ];
}
