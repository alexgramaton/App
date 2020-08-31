<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\User;
use Session;
use App\Validation\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegisterRequest;

    public function ShowRegisterForm()
    {
    	return view('admin.register');
		}
		
    public function HandleRegister(Request $request)
    {
			$user = User::where('email', '=', $request->input('email'))->first();
			if ($user === null) {
        $this->inputDataSanitization($request->all());
        $user = User::create([
						'email' => strtolower($request->input('email')),
						'password' => bcrypt($request->input('password')),
						'email_verified' => 0,
						'email_verification_token' => Str::random(50)
        ]);
            
        \Mail::to($user->email)->send(new VerificationEmail($user));
				Session::flash('statuscode','success');
				return redirect('users')->with('status','The account has been created. An email has been sent to verify the account');
       } else {
					Session::flash('statuscode','error');
					return redirect('users')->with('status','Account with this email already exists');
			 }
    }
}
