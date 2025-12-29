<?php

namespace App\Http\Controllers;
use App\Mcategory;
use App\InactiveJob;
use App\Property;
use App\Query;
use App\Report;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminProperty extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pendingproperty = Property::where('post_status',0)->count();
        $approvedproperty = Property::where('post_status',1)->count();
        $rejectedproperty = Property::where('status',0)->count();
        $activeproperty = Property::where('status',2)->count();
        $deActiveproperty = Property::where('status',1)->count();
        $allproperty= Property::count();
        $queries = Query::whereNotNUll('property_id')->count();
        $reports = Report::whereNotNUll('property_id')->count();
        return view('admin.property.index',compact('pendingproperty','approvedproperty','rejectedproperty','allproperty','deActiveproperty','activeproperty','reports','queries'));
    }
    


    public function listing($type)
    {
        switch ($type) {
            case 'approve':
                $jobs = Property::where('post_status', 1)
                    ->paginate(20);
                break;
    
            case 'pending':
                $jobs = Property::where('post_status', 0)
                    ->paginate(20);
                break;
    
            case 'de-active':
                $jobs = Property::where('status', 1)
                    ->paginate(20);
                break;
    
            case 'reject':
                $jobs = Property::where('status', 0)
                    ->paginate(20);
                break;

            case 'report':
                $jobs =Property::with('report')->where('post_status', 1)
                    ->paginate(20);
                return view('admin.jobs.query',compact('jobs','type'));
                break;
    
            case 'query':
                $jobs =Property::with('quires')->where('post_status', 1)
                ->paginate(20);
                return view('admin.jobs.query', compact('jobs','type'));
                break;
            default:
            $jobs = collect([]); 
        }
        return view('admin.property.listing', compact('jobs','type'));
    }
    
    public function active(Request $request, $id)
    {
        // Retrieve the inactive job using the ID
        $inactivejobs = InactiveJob::findOrFail($request->wid);
        // Update the status of the inactive job
        $inactivejobs->update([
            'status' => $request->status,
        ]);
    
        // Create a new Job using the data from the inactive job
        $jobData = $inactivejobs->toArray(); // Convert the inactive job data to an array
        unset($jobData['id']); // Remove the 'id' field to prevent conflicts
    
        $jobData['inactive_job_id'] = $inactivejobs->id; // Add the reference to inactive job ID
        $job = Job::create($jobData); // Create the new job
    
        // Flash a success message
        Session::flash('transfer', 'Job Approved');
    
        // Redirect back to the previous page
        return redirect()->back();
    }
    
}
