<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkResource;
use App\Models\Appeal;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::where('status' , '0')->get();

        //return $this->sendResponse(WorkResource::collection($works), 'Works retrieved successfully.');
        return response()->json([
            "success" => true,
            "message" => "Active Works",
            "data" => $works
        ]);
    }

    public  function show($id)
    {
        //$data = Work::find($id);
        //$data = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id));
        $data = Work::find($id);

        return response()->json([
            "success" => true,
            "message" => "İş haqqında məlumat",
            "data" => $data
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
