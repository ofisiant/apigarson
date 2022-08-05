<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $usersCount = User::all()->count();
        $users = User::all();

        return response()->json([
            "success" => true,
            "message" => "Bütün İstifadəçilər",
            "data" => [$usersCount , $users]
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            "success" => true,
            "message" => " İstifadəçi",
            "data" =>  $user
        ]);
    }


}
