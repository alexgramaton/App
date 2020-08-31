<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Company;

class Sub_category extends Model
{
	protected $table = 'sub_category';
	protected $fillable = ['name'];

	public $timestamps = false;
	
	public function category()
  {
    return $this->belongsTo(Category::class);
	}
	
	public function companies()
	{
    return $this->belongsToMany(Company::class);
	}

	public function products()
  {
    return $this->hasMany(Product::class);
  }
}
