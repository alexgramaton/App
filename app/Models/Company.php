<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Claim;
use App\Models\Sub_category;
use App\Models\Brand;
use App\Models\Company_image;
use App\Models\Certification;
use App\Models\Product;

class Company extends Model
{
    protected $table = 'company';
		protected $fillable = [
			'business_name', 'logo_url', 'description', 'products_image_url', 'website_url',
			'company_phone', 'company_email', 'video_url', 'private_label', 
			'distinction_1', 'distinction_2', 'distinction_3', 'distinction_4', 'distinction_5',
			'production_capacity', 'main_markets', 'main_sales_channels', 'products_description',
			'contact_first_name', 'contact_last_name', 'contact_role', 'contact_email', 'contact_phone', 'status', 'isDraft'];

		public $timestamps = false;

		public function user()
    {
      return $this->belongsTo(User::class);
		}

		public function claims()
		{
    	return $this->belongsToMany(Claim::class);
		}

		public function sub_categories()
		{
    	return $this->belongsToMany(Sub_category::class);
		}

		public function brands()
    {
      return $this->hasMany(Brand::class);
		}
		
		public function images()
    {
      return $this->hasMany(Company_image::class);
		}
		
		public function certifications()
    {
      return $this->hasMany(Certification::class);
		}
		
		public function products()
    {
      return $this->hasMany(Product::class);
    }
}
