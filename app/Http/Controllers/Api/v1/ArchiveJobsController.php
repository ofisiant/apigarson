<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseController;
use App\Models\Appeal;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;

class ArchiveJobsController extends BaseController
{
    public function index()
    {
        $archivejobs = Work::where('status' , '2')->get();
        return $this->sendResponse($archivejobs, 'Arxiv (Tamamlanmış işlər!)');

    }

    public function store()
    {

    }
    public function show($id)
    {
        $archivejob = Work::findOrFail($id);
        $appealedUsers = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id))->get();

        return $this->sendResponse(['job'=>$archivejob , 'appliier'=>$appealedUsers], 'İş haqqında məlumat');


    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
