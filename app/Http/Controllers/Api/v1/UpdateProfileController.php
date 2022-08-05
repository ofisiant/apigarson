<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UpdateProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $id  = Auth::user()->id;
        $user = User::find($id);

        $validatedData = Validator::make($request->all(), [
            'name' => 'nullable|max:45',
            'phone'  =>  'nullable|min:6|max:11',
            'photo' => 'nullable|mimes:jpg,png,jpeg|max:3048',

        ]);
        if ($validatedData->fails()) {
            return response()->json([
                "success" => false,
                "message" => "$validatedData->errors()",
            ]);
        }
        if($request->hasFile('photo')){

            $filename = time().'.'.$request->photo->extension();
            //dd($filename);


            $request->photo->storeAs('images',$filename,'public');
            //Auth::user()->update(["photo" => $filename]);
            Auth::user()->update(['photo' => $filename]);





        }

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
//        $user->passport_seriya = $request->input('passport_seriya');
        $user->photo = $request->input('photo');
//        $user->description = $request->input('description');
//        $user->position = $request->input('position');
//        $user->facebook = $request->input('facebook');
//        $user->instagram = $request->input('instagram');
//        $user->eng_lang = $request->input('eng_lang');
//        $user->tr_lang = $request->input('tr_lang');
//        $user->ru_lang = $request->input('ru_lang');



        $user->save();
        return response()->json([
            "success" => true,
            "message" => "Hesab məlumatlarınız uğurla yadda saxlanıldı!",
            "data" => $user
        ]);
    }

}
