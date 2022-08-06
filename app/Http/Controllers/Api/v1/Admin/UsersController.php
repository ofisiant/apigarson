<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Admin\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends BaseController
{
    public function index()
    {
        $usersCount = User::all()->count();
        $users = User::all();

        return $this->sendResponse($users, 'Bütün İstifadəçilər');
    }

    public function show($id)
    {
        $user = User::find($id);

        return $this->sendResponse($user, ' Sechilen istifadeci');
    }

    public function store(Request $request)
    {
        //dd($request); //UserStoreRequest
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'name.required' => 'Adınızı daxil etməmisiniz',
            'password.required' => 'Şifrə daxil edilməyib ',
            'email.required' => 'Email daxil edilməyib',
            'email.email' => 'Email duzgun daxil edilmeyib',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $createUser  = User::create($request->all());
        return $this->sendResponse($createUser, 'Yeni İstifadəçi əlavə olundu');

    }


}
