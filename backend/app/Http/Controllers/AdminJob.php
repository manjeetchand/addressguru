<?php

namespace App\Http\Controllers;
use App\Mcategory;
use App\InactiveJob;
use App\Job;
use App\Query;
use App\Report;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class AdminJob extends Controller
{

    public function index(){
        $data = [   
            'pending_jobs'  => Job::where('is_approved', 0)->count(),
            'approved_jobs' => Job::where('is_approved', 1)->count(),
            'rejected_jobs' => Job::where('is_approved', 2)->count(),
            // 'active_jobs'   => Job::where('is_active', 1)->count(),
            // 'in_active_jobs' => Job::where('is_active', 2)->count(), 
            'all_jobs'      => Job::count(),
            'queries'      => Query::where('queryable_type', Job::class)->count(),
            'reports'      => Report::where('queryable_type', Job::class)->count(),   
        ];
        return view('admin.jobs.index', compact('data'));   
    }

    

    // public function active(Request $request, $id)

    // {

    //     // Validate the incoming request

    //     $validated = $request->validate([

    //         'wid' => 'required|exists:inactive_jobs,id',

    //         'status' => 'required|in:approve,pending,de-active,reject',

    //     ]);

    

    //     $inactiveJob = InactiveJob::findOrFail($validated['wid']);

    //     $status = $validated['status'];

    

    //     try {

    //         switch ($status) {

    //             case 'approve':

    //                 $inactiveJob->update(['post_status' => 1]);

    //                 // Transfer data to the Job model

    //                 $jobData = $inactiveJob->toArray();

    //                 unset($jobData['id']); // Remove the original ID

    //                 $jobData['inactive_job_id'] = $inactiveJob->id; // Reference inactive job ID

    //                 Job::create($jobData);

    

    //                 $message = 'Job Approved Successfully!';

    //                 break;

    

    //             case 'pending':

    //                 $inactiveJob->update(['post_status' => 0]);

    //                 $message = 'Job marked as Pending.';

    //                 break;

    

    //             case 'active':

    //                 $inactiveJob->update(['status' => 2]);

    //                 $message = 'Job Deactivated Successfully.';

    //                 break;



    //             case 'de-active':

    //                 $inactiveJob->update(['status' => 1]);

    //                 $message = 'Job Deactivated Successfully.';

    //                 break;

    

    //             case 'reject':

    //                 $inactiveJob->update(['status' => 0]);

    //                 $message = 'Job Rejected Successfully.';

    //                 break;

    

    //             default:

    //                 $message = 'Invalid action.';

    //         }

    

    //         // Return success response

    //         return response()->json(['success' => true, 'message' => $message]);

    //     } catch (\Exception $e) {

    //         // Log the error and return an error response

    //         \Log::error('Error updating job status: ' . $e->getMessage());

    

    //         return response()->json([

    //             'success' => false,

    //             'message' => 'An error occurred while updating the job status.',

    //         ], 500);

    //     }

    // }

    public function active(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'wid' => 'required|exists:jobs,id',
            'status' => 'required|in:approve,pending,de-active,reject',
        ]);
        $inactiveJob = Job::findOrFail($validated['wid']);
        $status = $validated['status'];
        try {
            switch ($status) {
                case 'approve':
                    $inactiveJob->update(['is_approved' => '1']);
                    $message = 'Post  Approved Successfully!';
                    break;
                case 'pending':
                    $inactiveJob->update(['is_approved' => '0']);
                    $message = 'Job marked as Pending.';
                    break;
                case 'reject':
                    $inactiveJob->update(['is_approved' => '2']);
                    $message = 'Post Rejected Successfully.';
                    break;
                default:
                    $message = 'Invalid action.';
            }
            // Return success response
            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            // Log the error and return an error response
            \Log::error('Error updating job status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the job status.',
            ], 500);
        }
    }

    public function listing($type){
        switch ($type) {
            case 'approve':
                $jobs = Job::with('company')->where('is_approved', '1')->paginate(20);
                break;
            case 'pending':
                $jobs = Job::with('company')->where('is_approved', '0')->paginate(20);
                break;
            case 'reject':
                $jobs = Job::with('company')->where('is_approved', "2")->paginate(20);
                break;
            case 'report':
                $jobs = Report::where('queryable_type', Job::class)->paginate(20);
                return view('admin.business.query',compact('listings','type'));
                break;
            case 'query':
                $jobs = Query::where('queryable_type', Job::class)->paginate(20);
                return view('admin.business.query', compact('listings','type'));
                break;
            default:
        }
        return view('admin.jobs.listing', compact('jobs','type'));
    }
    
    // public function listing($type){
    //     switch ($type) {
    //         case 'approve':
    //             $jobs = Job::with('company')->where('status', 1)->paginate(20);
    //             break;
    //         case 'pending':
    //             $jobs = InactiveJob::where('post_status', 0)
    //                 ->paginate(20);

    //             break;

    

    //         case 'de-active':

    //             $jobs = InactiveJob::where('status', 1)

    //                 ->paginate(20);

    //             break;

    

    //         case 'reject':

    //             $jobs = InactiveJob::where('status', 0)

    //                 ->paginate(20);

    //             break;



    //         case 'report':

    //             $jobs =InactiveJob::with('report')->where('post_status', 1)

    //                 ->paginate(20);

    //             return view('admin.jobs.query',compact('jobs','type'));

    //             break;

    

    //         case 'query':

    //             $jobs =InactiveJob::with('quires')->where('post_status', 1)

    //             ->paginate(20);

    //             return view('admin.jobs.query', compact('jobs','type'));

    //             break;

    //         default:

    //         $jobs = collect([]); 

    //     }

    //     return view('admin.jobs.listing', compact('jobs','type'));

    // }
}

