<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'photo', 'salary', 'employers' , 'position' , 'customer' , 'description' , 'status', 'start_at'
    ];



    public function job_id()
    {
        return $this->hasOne('App\Models\Appeal', 'job_id');
    }


    public function endJob($id)
    {
        Work::where('id', $id)->update(["status" => '2',]);
    }
}
