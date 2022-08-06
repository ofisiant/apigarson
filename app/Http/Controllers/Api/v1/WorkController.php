<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkResource;
use App\Models\Appeal;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkController extends BaseController
{
    public function index()
    {
        $works = Work::where('status' , '0')->get();

        return $this->sendResponse($works, 'Aktiv işlər siyahısı');

    }

    public  function show($id)
    {
        //İşi axtardığımız zaman bu işə müraciətt edənləridə görmək üçün
        $appealedUsers = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id));
        $job = Work::find($id);
        return response()->json([
            "success" => true,
            "message" => "İş haqqında məlumat",
            "data" => [$job , $appealedUsers]
        ]);

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $works = Work::create($input);
        return response()->json([
            "success" => true,
            "message" => "Product created successfully.",
            "data" => $works
        ]);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }


}
