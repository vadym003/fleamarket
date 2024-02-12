<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use App\Invoice;

class JobAllowController extends Controller
{
    public function index(){
        $data['jobs'] = DB::table('jobs')->where('jobs.isDeleted', '=', 0)->paginate(5);
        return view('admin.jobs', $data);
    }

    public function allowJob(Request $request, string $id){
        $job = Job::find($id);
        // $job->update([
        //     isAllowed => 1
        // ]);
        $job->isAllowed = 1;
        $job->save();

        return redirect('admin/jobs')->with('status', 'Job Has Been successfully allowed');

    }
    
}
