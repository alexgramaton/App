<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Claim;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function claims()
		{
			$claims = Claim::all();
			return view('admin.claims')->with('claims',$claims);	
		}

		public function add(Request $request)
		{
			$claim = Claim::where('name', '=', $request->input('claimName'))->first();
			if ($claim === null) {
				$claim = new Claim;
				$claim->name = $request->input('claimName');
				$claim->save();
				Session::flash('statuscode','success');
				return redirect('claims')->with('status','New claim added');
			} else {
				Session::flash('statuscode','error');
				return redirect('claims')->with('status','Claim already exists');
			}
		}

		public function update(Request $request, $id)
		{
			$claim = Claim::find($id);
			$claim->name = $request->input('updateClaimName');
			$claim->update();
			Session::flash('statuscode','info');
			return redirect('claims')->with('status','Claim is updated');
		}

		public function delete(Request $request, $id)
		{
			$claim = Claim::find($id);
			$claim->companies()->detach();
			$claim->delete();
			Session::flash('statuscode','error');
			return redirect('claims')->with('status','Claim is deleted');
		}
}
