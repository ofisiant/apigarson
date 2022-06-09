<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class ArchiveJobsController extends Controller
{
    public function index()
    {
        $archivejobs = Work::where('status' , '2')->get();

        //return $this->sendResponse(WorkResource::collection($works), 'Works retrieved successfully.');
        return response()->json([
            "success" => true,
            "message" => "Arxiv (Tamamlanmış işlər!)",
            "data" => $archivejobs
        ]);
    }

    public function store()
    {

    }
    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
