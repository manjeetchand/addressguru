<?php
namespace App\Http\Controllers;
use App\{Coaching,listing,Query,Report};
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class AdminBusiness extends Controller
{

    public function index(){
        $data = [
            'all_posts' => listing::count(),
            'approved_posts' => listing::where('is_approved','1')->count(),
            'pending_posts' => listing::where('is_approved','0')->count(),
            'reject_posts' => listing::where('is_approved','2')->count(),
            'queries' => Query::where('queryable_type', Listing::class)->count(),
            'reports' => Report::where('queryable_type', Listing::class)->count(),
        ];
        return view('admin.business.index',compact('data'));
    }

    public function listing($type){
        switch ($type) {
            case 'approve':
                $listings = listing::where('is_approved', '1')->paginate(20);
                break;
            case 'pending':
                $listings = listing::where('is_approved', '0')->paginate(20);
                break;
            case 'reject':
                $listings = listing::where('is_approved', "2")->paginate(20);
                break;
            case 'report':
                $listings = Report::where('queryable_type', Listing::class)->paginate(20);
                return view('admin.business.query',compact('listings','type'));
                break;
            case 'query':
                $listings = Query::where('queryable_type', Listing::class)->paginate(20);
                return view('admin.business.query', compact('listings','type'));
                break;
            default:
        }
        return view('admin.business.listing', compact('listings','type'));
    }

    public function active(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'wid' => 'required|exists:listings,id',
            'status' => 'required|in:approve,pending,de-active,reject',
        ]);
        $inactiveJob = listing::findOrFail($validated['wid']);
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
}