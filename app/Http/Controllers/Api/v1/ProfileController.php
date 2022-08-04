<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //Daxil olan İstifadəçinin profili
    public function index()
    {
        $user = Auth::user();

        return response()->json([
            "success" => true,
            "message" => " Daxil olan İstifadəçinin məlumatları",
            "data" => $user
        ]);
    }

    public function show($id)
    {
        $showUser = User::where('id', $id)->get();
        return response()->json([
            "success" => true,
            "message" => "Axtardığınız İstifadəçinin məlumatları",
            "data" => $showUser
        ]);
    }

    //Hesabın təstiqlənməsi üçün müraciət etmək
    public function store()
    {
        //Əgər istifadəçi təstiqlənibsə
        $id = Auth::user()->id;
        if (Auth::user()->role > '1') {
            return response()->json([
                "success" => false,
                "message" => "Hesabınız artıq təstiqlənib",
            ]);
        }

        //Əgər istifadəçi gözləmədədirsə
        if (Auth::user()->role == '1') {
            return response()->json([
                "success" => false,
                "message" => "Müraciətiniz gözləmədədir!",
            ]);
        }


        // @TODO Bildiriş sistemi əlavə olunmalıdır.
        $user = User::where('id', $id)->update(["role" => '1']);
            return response()->json([
                "success" => true,
                "message" => "Müraciətiniz qəbul olundu! Tezliklə moderator tərəfindən geri dönüş əldə edəcəksiniz!",
                "data" => "User Role Updated to $user"
            ]);

    }


    //İstifadəçi məlumatlarının yenilənməsi
    public function update(Request $request)
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
        if ($request->hasFile('photo')) {
            $logo = $request->photo;
            $fileName = date('Y') . $logo->getClientOriginalName();

            //Get the path to the folder where the image is stored
            //and then save the path in database
            $path = $request->photo->storeAs('photo', $fileName, 'public');
            $user['photo'] = $path;
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
