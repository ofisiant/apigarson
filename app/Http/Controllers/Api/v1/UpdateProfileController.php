<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UpdateProfileController extends BaseController
{
    public function updateProfile(ProfileRequest $request)
    {
        $userUpdate = User::where('id', Auth::user()->id)->update($request->validated());
        $user = User::findOrFail(Auth::user()->id);


        if ($request->hasFile('photo'))
        {
            $photo = $request->file('photo');
            $name = time() . '.'. $photo->getClientOriginalName();
            $destinationPath = public_path('/images/profile');
            $photo->move($destinationPath , $name);

            $user->update(['photo'=> $name]);
        }
        return $this->sendResponse($user, 'Hesabiniz yenilendi');



    }

}
