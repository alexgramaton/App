<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class TermsOfUsage extends Model
{
    protected $table = 'terms_of_usage';
		protected $fillable = ['description'];

		public $timestamps = true;
}
