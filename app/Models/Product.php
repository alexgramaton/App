<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Sub_category;

class Product extends Model
{
    protected $table = 'product';
		protected $fillable = ['name','self_life', 'storage_type'];

		public $timestamps = false;
	
		public function company()
  	{
    	return $this->belongsTo(Company::class);
		}

		public function sub_category()
  	{
    	return $this->belongsTo(Sub_category::class);
		}
}
