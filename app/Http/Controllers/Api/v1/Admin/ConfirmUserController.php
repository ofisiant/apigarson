<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class ConfirmUserController extends BaseController
{
    public function index()
    {
        $users = User::where('role' , '1')->get();
        return $this->sendResponse($users, 'Hesabını təstiq etmək üçün müraciət edənlər');
    }

    public function confirmUser($id)
    {
        $update = User::where('id', $id)->update(['role'=>'2']);
        return $this->sendResponse($update, 'Hesab testiqlendi');

    }
}
