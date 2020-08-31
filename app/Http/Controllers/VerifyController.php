<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
	public function VerifyEmail($token = null)
  {
			if($token == null)
			{
    		return view('auth.verifyError');
    	}

       $user = User::where('email_verification_token',$token)->first();

			 if($user == null )
			 {
    		return view('auth.verifyError');
       }

       $user->update([
        'email_verified' => 1,
        'email_verified_at' => Carbon::now(),
        'email_verification_token' => ''
       ]);
       
    	return view('auth.verifySuccess');
	}
}