<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicyController extends Controller
{
    public function index()
		{
			return view('admin.privacypolicy');	
		}

		public function store(Request $request)
		{
				$privacyPolicy = new PrivacyPolicy;
				$privacyPolicy->description = $request->input('summary-ckeditor');
				$privacyPolicy->save();
				Session::flash('statuscode','success');
				return redirect('privacyPolicy')->with('status','Information updated');
		}
}
