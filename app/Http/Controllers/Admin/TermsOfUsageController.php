<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\TermsOfUsage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


class TermsOfUsageController extends Controller
{
    public function index()
		{
			return view('admin.termsofusage');	
		}

		public function store(Request $request)
		{
				$termsOfUsage = new TermsOfUsage;
				$termsOfUsage->description = $request->input('summary-ckeditor');
				$termsOfUsage->save();
				Session::flash('statuscode','success');
				return redirect('termsOfUsage')->with('status','Information updated');
		}
}
