<?php
namespace App\Http\Controllers;
use App\Mcategory;
use App\Job;
use App\Property;
use App\Query;
use App\Report;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class jobsController extends Controller
{
    public function index(){
        $jobPostDatas = Job::orderBy('id','DESC')->get();
        return view('jobs.index',compact('jobPostDatas'));
    }

    public function show($slug){
        $job_detail = Job::where('slug',$slug)->first();
        return view('jobs.details',compact('job_detail'));
    }
}