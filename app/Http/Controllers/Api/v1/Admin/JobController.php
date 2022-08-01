<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appeal;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use function response;

class JobController extends Controller
{
    public function index()
    {

    }



    public function store(Request $request)
    {
        $input = $request->all();
        $works = Work::create($input);
        return response()->json([
            "success" => true,
            "message" => "Yeni iş elanı əlavə olundu!",
            "data" => $works
        ]);
    }


    //Admin işi bitirdikdən sonra istifadəçilərin hesablarının update olunması
    public function update(Request $request , $id)
    {
      $endJob = Work::find($id);
      $endJob->update(['status' => '2']);

      //İş bitdikdən sonra həmin işdə işləyənlərin tapılması
      if ($endJob){
          $increment = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id));
          $increment->increment('balance', $request->salary);
          $increment->increment('completed_work', 1);

          /// İstifadəçilərin İş statusunun tənzimlənməsi.
          User::whereIn('id', Appeal::select('user_id')->where('job_id', $id))->update(["job_status" => '0',]);

      }
      return response()->json([ "success" => true, "message" => "İşi tamamlandı!",]);

    }

    public function destroy()
    {

    }
    public function show()
    {

    }

}
