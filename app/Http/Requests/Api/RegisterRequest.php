<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ];
    }

    public function messages()
    {

        /*
         * @TODO find out how to get Azerbaijani response without encoding issue
         * Example of current response: Email \u00fcnvan\u0131 daxil edilm\u0259yib
         * */
        return [
//            'name.required' => 'Ad daxil edilməyib.',
//            'email.required' => 'Email ünvanı daxil edilməyib',
//            'email.email' => 'Email düzgün daxil edilməyib.',
//            'password.required' => 'Şifrə daxil edilməyib.',
//            'c_password.required' => 'Şifrə təsdiqi daxil edilməyib.',
//            'c_password.same:password'=> 'Şifrə təsdiqlənmədi.'
        ];
    }
}
