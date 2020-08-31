<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sub_category;

class Category extends Model
{
		protected $table = 'category';
		protected $fillable = ['name'];

		public $timestamps = false;

		public function sub_categories()
    {
    	return $this->hasMany(Sub_category::class);
		}
		
}
