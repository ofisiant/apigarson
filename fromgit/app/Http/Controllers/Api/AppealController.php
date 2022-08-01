<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Appeal;
use Illuminate\Support\Facades\Auth;

class AppealController extends Controller
{
    public function store(Request $request)
    {

        //validation
        if (Auth::user()->role < '2') {
            return response()->json([
                "success" => false,
                "message" => "İşə  müraciət etmək üçün ilk öncə Hesabınızı təstiq edin",
            ]);
        }

        if (Auth::user()->appeal_work == '1') {
            return response()->json([
                "success" => false,
                "message" => "Siz artıq müraciət etmisiniz",
            ]);
        }


        //insert data to Appeals
        $id = Auth::user()->id;
        $insert = new Appeal;
        $insert->user_id = $id;
        $insert->job_id = $request->job_id;

        if ($insert->save()) {

            //if insert change in users column
            User::where('id', Auth::user()->id)->update(["appeal_work" => '1']);

            return response()->json([
                "success" => true,
                "message" => "Müraciətiniz qəbul olundu",
                "data" => $insert
            ]);
        }



    }

}
