<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class RegisterController extends Controller
{
    public function __invoke(RegisterFormRequest $request)
    {
        $user = User::create(array_merge(
            $request->only('name', 'surname', 'patronymic', 'email', 'phone', 'password'),
            ['password' => bcrypt($request->password)],
        ));

        return response()->json([
            'message' => 'You were successfully registered. Use your email and password to sign in.'
        ], 200);
    }
}