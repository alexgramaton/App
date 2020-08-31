<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Certification extends Model
{
    protected $table = 'certification';
		protected $fillable = ['name, picture_url'];

		public $timestamps = false;

		public function company()
		{
    	return $this->belongsTo(Company::class);
		}

		
}
