<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function users()
		{
			$users = User::all();
			return view('admin.users')->with('users',$users);
		}

		public function user(Request $request, $id)
		{
			$user = User::findOrFail($id);
			return view('admin.user')->with('user',$user);;
		}

		public function update(Request $request, $id)
		{
			$user = User::find($id);
			if ($request->input('email_verified') == '1')
			{
				$user->email_verified = 1;
			} elseif ($request->input('email_verified') == '0')
			{
				$user->email_verified = 0;
			}
			$user->update();
			Session::flash('statuscode','info');
			return redirect('users')->with('status','Your data is updated');
		}
		
		public function delete(Request $request, $id)
		{
			$user = User::findOrFail($id);
			$user->delete();
			Session::flash('statuscode','error');
			return redirect('users')->with('status','Customer deleted');
		}
}
