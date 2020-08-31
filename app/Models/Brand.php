<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Brand extends Model
{
    protected $table = 'brand';
		protected $fillable = ['name, picture_url'];

		public $timestamps = false;

		public function company()
		{
    	return $this->belongsTo(Company::class);
		}
}
