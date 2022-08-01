<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {

    }
    public function destroy()
    {

    }
    public function show()
    {

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
        //Insert Data -
        $user = User::where('id', $id)->update(["role" => '1']);

            return response()->json([
                "success" => true,
                "message" => "Müraciətiniz qəbul olundu! Tezliklə moderator tərəfindən geri dönüş əldə edəcəksiniz!",
                "data" => "User Role Updated to $user"
            ]);

    }


    //İstifadəçi məlumatlarının yenilənməsi
    public functi------------------------------------------------------------------------------------------------------------ on update(ProfileRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->passport_seriya = $request->input('passport_seriya');
        $user->photo = $request->input('photo');
        $user->description = $request->input('description');
        $user->position = $request->input('position');
        $user->facebook = $request->input('facebook');
        $user->instagram = $request->input('instagram');
        $user->eng_lang = $request->input('eng_lang');
        $user->tr_lang = $request->input('tr_lang');
        $user->ru_lang = $request->input('ru_lang');

        $user->save();
        return response()->json([
            "success" => true,
            "message" => "Hesab məlumatlarınız uğurla yadda saxlanıldı!",
            //"data" => $user
        ]);
    }
}
