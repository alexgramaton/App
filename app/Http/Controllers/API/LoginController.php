<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        //if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
        //    $user = Auth::user(); 
        //    $success['token'] =  $user->createToken('MyApp')-> accessToken;
        //    return $this->sendResponse($success, 'User login successfully.');
        //} 
        //else{ 
        //    return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
				//}
				$data = $request->validate([
					'email' 	 => 'required|string|email|max:255',
					'password' => 'required|string|min:8',
				]);
				$user = User::where('email', $request->email)->first();
				if (!$user) {
        	return response([
            'error' => ['User not found'],
					], 401);
				}
				if (!$user || !Hash::check($request->password, $user->password) || $user->type != 1) {
        	return response([
            'error' => ['The provided credentials are incorrect.'],
					], 401);
				}
				if ($user->email_verified != 1) {
        	return response([
            'error' => ['Account not verifed.'],
					], 401);
				}
				$user->tokens()->delete();

				$token = $user->createToken($request->email)->plainTextToken;
				$response = [
						'success' => true,
						'id'			=> $user->id,
						'email'		=> $user->email,
						'token'   => $token,
        ];
      	return response()->json($response, 200);
		}
}
