<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|min:3|max:191',
            'phone' => 'string|min:0|max:191',
            'passport_seriya' => 'string',
            'photo' => 'image||mimes:jpeg,png,jpg,gif',
            'description' => 'string',
            'position' => 'string',
            'eng_lang' => 'numeric',
            'tr_lang' => 'numeric',
            'ru_lang' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Adınız minimum 3 hərf olmalıdır!',
            'phone.numeric' => 'Yalniz Reqem',

        ];
    }
}
