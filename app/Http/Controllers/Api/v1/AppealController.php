<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Models\Appeal;
use Illuminate\Support\Facades\Auth;

class AppealController extends Controller
{

    public function index()
    {

    }

    // Müraciətdən imtina etmək .
    public function destroy($id)
    {
        $refusing = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id))->delete();

        return response()->json([
            "success" => true,
            "message" => "İşə müraciət edənlər",
            "data" => $refusing
        ]);


    }
    public function update()
    {

    }
    public  function show($id)
    {
        $data = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id))->get();
        $count = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id))->count();

        return response()->json([
            "success" => true,
            "message" => "İşə müraciət edənlər",
            "data" => $data
        ]);

    }


    public function store(Request $request)
    {
        //Yoxlamaq Lazımdırki işçi sayı dolubsa bu işə müraciət etmək olmasın!&

        if (Auth::user()->role < '2') {
            return response()->json([
                "success" => false,
                "message" => "İşə  müraciət etmək üçün ilk öncə Hesabınızı təstiq edin",
            ]);

        }

        if (Auth::user()->job_status == '1') {
            return response()->json([
                "success" => false,
                "message" => "Siz artıq müraciət etmisiniz. Müraciətiniz gözləmədədir!",
            ]);
        }

        if (Auth::user()->job_status == '2') {
            return response()->json([
                "success" => false,
                "message" => "İşinizin bitməyini gözləyin!",
            ]);
        }

        //Bazaya yeni müraciətin əlavə olunması
        $insert = new Appeal;
        $insert->user_id = Auth::user()->id;
        $insert->job_id = $request->job_id;

        if ($insert->save()) {

            //Müraciət olundusa istifadəçinin iş statusu gözləməyə düşür.
            User::where('id', Auth::user()->id)->update(["job_status" => '1']);

            return response()->json([
                "success" => true,
                "message" => "Müraciətiniz qəbul olundu",
                "data" => $insert
            ]);
        }



    }

}
