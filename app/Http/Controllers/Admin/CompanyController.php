<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Company;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function companies()
		{
			$companies = Company::where('isDraft', '=', False)->get();
			return view('admin.companies')->with('companies',$companies);
		}

		public function approveCompany(Request $request, $id)
		{
			$company = Company::find($id);
			$company->status = 1;
			$company->update();
			Session::flash('statuscode','success');
			return redirect('companies')->with('status','Company approved');
		}
}
