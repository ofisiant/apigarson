<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Models\Appeal;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use function response;

class JobController extends BaseController
{
    public function index()
    {
        $jobs = Work::all();
        return $this->sendResponse($jobs, 'Bütün işlər');
    }

    public function show($id)
    {
        $job = Work::where('id', $id)->get();
        return $this->sendResponse($job, 'Sechilen ish haqqinda melumat. Bu ishde ishleyenler');

    }


    public function store(Request $request)
    {
        //ToDo Request elave olunub validation olunmalidir !
        $input = $request->all();
        $jobs = Work::create($input);
        //ToDo İş əlavə olunduqdan sonra Hesabı təstiq olunmuş istifadəçilərə bildiriş getməlidir .

        return $this->sendResponse($jobs, 'Yeni iş elanı əlavə olundu!');

    }


    //Admin işi bitirdikdən sonra istifadəçilərin hesablarının update olunması
    public function update(Request $request , $id)
    {
      $endJob = Work::find($id);
      $endJob->update(['status' => '2']);

      //İş bitdikdən sonra həmin işdə işləyənlərin tapılması
      if ($endJob){
          $increment = User::whereIn('id', Appeal::select('user_id')->where('job_id', $id));
          //$increment->increment('balance', $request->salary);
          $increment->increment('profit', $request->salary);
          $increment->increment('completed_work', 1);

          /// İstifadəçilərin İş statusunun tənzimlənməsi.
          User::whereIn('id', Appeal::select('user_id')->where('job_id', $id))->update(["job_status" => '0',]);

      }
      return response()->json([ "success" => true, "message" => "İşi tamamlandı! İstifadəçilərin tamamladığı iş sayı +1 artdı . Balansları artırıldı . Yenidən işə müraciət etmək üçün Statusları update olundu !",]);

    }

    public function destroy()
    {

    }


}
