<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\HowItWorks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class HowItWorksController extends Controller
{
    public function index()
		{
			return view('admin.howitworks');	
		}

		public function store(Request $request)
		{
				$howItWorks = new HowItWorks;
				$howItWorks->description = $request->input('summary-ckeditor');
				$howItWorks->save();
				Session::flash('statuscode','success');
				return redirect('howItWorks')->with('status','Information updated');
		}
}
