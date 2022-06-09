<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    //appealing to Approve User
    public function store()
    {
        //Validation
        $id = Auth::user()->id;
        if (Auth::user()->role > '1') {
            return response()->json([
                "success" => false,
                "message" => "Hesabınız artıq təstiqlənib",
            ]);
        }

        if (Auth::user()->role == '1') {
            return response()->json([
                "success" => false,
                "message" => "Müraciətiniz gözləmədədir!",
            ]);
        }

        //Insert Data - Need For Notify
        $user = User::where('id', $id)->update(["role" => '1']);

            return response()->json([
                "success" => true,
                "message" => "Müraciətiniz qəbul olundu! Tezliklə moderator tərəfindən geri dönüş əldə edəcəksiniz!",
                "data" => "User Role Updated to $user"
            ]);

    }


    //User Profile Update
    public function update(Request $request, $id)
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
