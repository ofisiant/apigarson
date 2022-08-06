<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UpdateProfileController extends BaseController
{
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->passport_seriya = $request->passport_seriya;
        $user->description = $request->description;
        $user->position = $request->position;
        $user->eng_lang = $request->eng_lang;
        $user->tr_lang = $request->tr_lang;
        $user->ru_lang = $request->ru_lang;
        $user->save();
        return $this->sendResponse($user, 'Hesabiniz yenilendi');


        //dd($id);
    }

}
