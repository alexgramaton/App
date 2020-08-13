<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
						'surname' => ['required'],
						'patronymic' => ['required'],
						'email' => ['required', 'email', 'unique:users'],
						'phone' => ['required', 'regex:/(\+7)[0-9]{10}/', 'unique:users'],
            'password' => ['required', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*?[$%&!:]).+$/'],
            'c_password' => ['required', 'same:password'],
        ];
    }
}
