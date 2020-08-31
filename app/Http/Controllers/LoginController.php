<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Validation\RegisterRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use RegisterRequest;

    public function ShowLoginForm()
    {
    	return view('admin.login');
		}
		
		public function HandleLogin(Request $request)
    {
    	$this->loginDataSanitization($request->except(['_token']));
        $credentials = $request->except(['_token']);
        $user = User::where('email',$request->email)->first();
				if($user->email_verified == 1 && $user->type == 0)
				{
					if (auth()->attempt($credentials)) {
						$user = auth()->user();
						$user->last_login = Carbon::now();
						$user->save();
						return redirect()->route('users');
					}
				}
				session()->flash('message', 'Invalid Credentials');
				session()->flash('type', 'danger');
				return redirect()->back();
    }
}

