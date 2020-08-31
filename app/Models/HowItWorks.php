<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class HowItWorks extends Model
{
    protected $table = 'howItWorks';
		protected $fillable = ['description'];

		public $timestamps = true;
}
