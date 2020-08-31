<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Claim extends Model
{
    protected $table = 'claim';
		protected $fillable = ['name'];

		public $timestamps = false;

		public function companies()
		{
    	return $this->belongsToMany(Company::class);
		}
}
