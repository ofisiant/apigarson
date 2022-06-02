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
        $id = Auth::user()->id;
        $insert = new Appeal;
        $insert->user_id = $id;
        $insert->job_id = $request->job_id;

        if ($insert->save()) {
            User::where('id', Auth::user()->id)->update(["appeal_work" => '1']);
            //return Redirect::back()->with('success', 'Müraciətiniz qəbul olundu');
            return response()->json([
                "success" => true,
                "message" => "Müraciətiniz qəbul olundu",
                "data" => $insert
            ]);
        }



    }

}
