<?php

namespace App\Http\Controllers\api\v1\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Appeal;
use Illuminate\Http\Request;

class AppealController extends BaseController
{
    public function index()
    {
        $appeals = Appeal::where('status' , '0')->get();
        return $this->sendResponse($appeals, 'Muraciet edenler');
    }
}
