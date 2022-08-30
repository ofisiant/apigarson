<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseController;
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
        $express = Work::where('express' , '1')->get();

        return $this->sendResponse(['job'=>$works , 'express'=>$express], 'Aktiv işlər siyahısı');

    }

    public  function show($id)
    {
        //İşi axtardığımız zaman bu işə müraciət edənləridə görmək üçün
        $job = Work::findOrFail($id);
        //$appealedUsers = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id));
        $appealedUsers = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id))->get();

        return $this->sendResponse(['job'=>$job , 'appliier'=>$appealedUsers], 'İş haqqında məlumat');

    }


}
