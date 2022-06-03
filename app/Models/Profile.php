<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Profile extends User
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'passport_seriya',
        'photo' ,
        'description' ,
        'position' ,
        'balance' ,
        'completed_work',
        'facebook' ,
        'instagram',
        'eng_lang',
        'tr_lang',
        'ru_lang',
        'created_at'
    ];
}
