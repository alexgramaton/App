<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Company_image extends Model
{
    protected $table = 'company_image';
		protected $fillable = ['image_url'];

		public $timestamps = false;

		public function company()
		{
    	return $this->belongsTo(Company::class);
		}
}
