<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Facility;
use App\PaymentMode;
use App\Service;
// use App\Http\Requests\CategoryRequest;
// use App\Http\Requests;



class CategoryControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $category = Category::with('services','facilities','forms')->orderBy('id', 'ASC')->get();
        return view('admin.category.index', compact('category'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|unique:categories,name',
            'description' => 'nullable|min:10|max:300',
            'meta_tile' => 'nullable|min:5|max:100',
            'meta_description' =>'nullable|min:10|max:300',
            'svg_code' => 'nullable|max:100000|required_without:icon',
            'colors' => 'required|min:2|max:20',
            'icon' => 'nullable|image|mimes:svg,png|max:2048|required_without:svg_code',
            'status' => 'required',
        ]);

        $data = $request->all();
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $storagePath = "assets/categories/";
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move($storagePath, $fileName);
            $data['icon'] = $storagePath . $fileName;
        }
        Category::create($data);
        return redirect('admin-category')->with('success', 'Category created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::with('services','facilities','forms')->findOrFail($id);
        return view('admin.category.edit', compact('cat'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|unique:categories,name,' . $id,
            'description' => 'nullable|min:10|max:300',
            'meta_tile' => 'nullable|min:5|max:100',
            'meta_description' =>'nullable|min:10|max:300',
            'svg_code' => 'nullable|max:100000',
            'colors' => 'required|min:2|max:20',
            'icon' => 'nullable|image|mimes:svg,png|max:2048',
            'status' => 'required',
        ]);

        $category = Category::findOrFail($id);
        if($category){
            $data = $request->all();
            if ($request->hasFile('icon')) {
                $image = $request->file('icon');
                $storagePath = "assets/categories/";
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move($storagePath, $fileName);
                $data['icon'] = $storagePath . $fileName;
            }else{
                $data['icon'] = $category->icon;
            }
            $category->update($data);
        }
        return redirect('admin-category')->with('success', 'Category update successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('admin-category');
    }
     public function facilities(Request $request, $id = null)
    {
        $request->validate([
            'category_id' => 'required|numeric',
            'facilities.*' => 'required|string|max:255',
            'facility_id.*' => 'sometimes|nullable|numeric' 
        ]);
        if ($id) {
            // Retrieve existing facilities to handle deletions
            $existingFacilities = Facility::where('category_id', $id)->get()->keyBy('id');
            // Array to keep track of existing facility IDs for deletion check
            $existingFacilityIds = $existingFacilities->keys()->toArray();
            // Iterate over the incoming facilities
            foreach ($request->facilities as $index => $facility) {
                $facilityId = $request->input("facility_id.$index"); // Get facility ID from the request
                // Update or create facility
                Facility::updateOrCreate(
                    ['id' => $facilityId], // Unique identifier
                    [
                        'name' => $facility, // Field to update/create
                        'category_id' => $request->category_id,
                    ]
                );
            }
            foreach ($existingFacilityIds as $existingFacilityId) {
                if (!in_array($existingFacilityId, $request->input('facility_id', []))) {
                    Facility::destroy($existingFacilityId); // Delete facility if not in request
                }
            }
        } else {
            // Create new facilities when no ID is provided
            foreach ($request->facilities as $facility) {
                Facility::create([
                    'name' => $facility, 
                    'category_id' => $request->category_id,
                ]);
            }
        }
        return response()->json(['success' => 'Facilities updated successfully!']);
    }
    public function services(Request $request, $id = null)
    {
        // Validate the request
        $request->validate([
            'category_id' => 'required|numeric',
            'services.*' => 'required|string|max:255',
            'service_id.*' => 'sometimes|nullable|numeric' // For existing services
        ]);
        // If $id is provided, handle update or create
        if ($id) {
            // Retrieve existing services to handle deletions
            $existingServices = Service::where('category_id', $id)->get()->keyBy('id');
            // Array to keep track of existing service IDs for deletion check
            $existingServiceIds = $existingServices->keys()->toArray();
            // Iterate over the incoming services
            foreach ($request->services as $index => $service) {
                $serviceId = $request->input("service_id.$index"); // Get service ID from the request
                // Update or create service
                Service::updateOrCreate(
                    ['id' => $serviceId], // Unique identifier
                    [
                        'name' => $service, // Field to update/create
                        'category_id' => $request->category_id,
                    ]
                );
            }
            // Check for services that need to be deleted (not in the new request)
            foreach ($existingServiceIds as $existingServiceId) {
                if (!in_array($existingServiceId, $request->input('service_id', []))) {
                    Service::destroy($existingServiceId); // Delete service if not in request
                }
            }
        } else {
            // Create new services when no ID is provided
            foreach ($request->services as $service) {
                Service::create([
                    'name' => $service, 
                    'category_id' => $request->category_id,
                ]);
            }
        }
        return response()->json(['success' => 'Services updated successfully!']);
    }
    public function payment(){
        $payments = PaymentMode::orderBy('name','asc')->get();
        return view('admin.category.payment',compact('payments'));
    }
    public function paymentEdit(Request $request,$id){
        $request->validate([
            'name' => 'required|string',
        ]);
        $paymentMode =   PaymentMode::findorfail($id);
        $paymentMode->name = $request->name;
        $paymentMode->save();
        return back()->with('message','Payment Mode update');
    }
    public function paymentDestroy($id){
        $paymentMode =   PaymentMode::findorfail($id);
        if($paymentMode){
           $paymentMode->delete();
           return back()->with('message','Payment Mode Delete');
        }else{
            abort(503);
        }
    }
    public function paymentCreate(Request $request){
          $request->validate([
            'name' => 'required|string',
        ]);
        $paymentMode = new PaymentMode ();
        $paymentMode->name = $request->name;
        $paymentMode->save();
        return back()->with('message','Payment Mode Add');
    }
}