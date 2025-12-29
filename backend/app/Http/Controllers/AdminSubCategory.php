<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use App\Facility;
use App\PaymentMode;
use App\Service;
use App\ChildCategory;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class AdminSubCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category_id,$id = null){
        dd(1);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        SubCategory::create([

            'category_id' => $input['category'],
            'name' => $input['name'],

        ]);

        Session::flash('insert', 'Successfully Submitted!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = SubCategory::where('category_id', '=', $id)->orderBy('id', 'DESC')->get();

        $category = Category::findorFail($id);

        return view('admin.category.subcategory.index', compact('subcategory', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat =  SubCategory::findorfail($id);
        return view('admin.category.subcategory.edit',compact('cat'));
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
        $input = $request->all();

        SubCategory::findOrFail($id)->update([

            'name' => $input['name'],

        ]);

        Session::flash('insert', 'Successfully Edited!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::findOrFail($id)->delete();

        Session::flash('insert', 'Successfully Deleted!');

        return redirect()->back();
    }
    
    
     public function facilities(Request $request, $id = null)
    {
        $request->validate([
            'subcategory_id' => 'required|numeric',
            'facilities.*' => 'required|string|max:255',
            'facility_id.*' => 'sometimes|nullable|numeric' 
        ]);
    
        if ($id) {
            // Retrieve existing facilities to handle deletions
            $existingFacilities = Facility::where('sub_category_id', $id)->get()->keyBy('id');
            
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
                        'sub_category_id' => $request->subcategory_id,
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
                    'sub_category_id' => $request->subcategory_id,
                ]);
            }
        }
    
        return response()->json(['success' => 'Facilities updated successfully!']);
    }
    
    
    
    public function services(Request $request, $id = null)
    {
        // Validate the request
        $request->validate([
            'subcategory_id' => 'required|numeric',
            'services.*' => 'required|string|max:255',
            'service_id.*' => 'sometimes|nullable|numeric' // For existing services
        ]);
    
        // If $id is provided, handle update or create
        if ($id) {
            // Retrieve existing services to handle deletions
            $existingServices = Service::where('sub_category_id', $id)->get()->keyBy('id');
            
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
                        'sub_category_id' => $request->subcategory_id,
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
                    'sub_category_id' => $request->subcategory_id,
                ]);
            }
        }
    
        return response()->json(['success' => 'Services updated successfully!']);
    }
    
    
    public function childSubCategory(Request $request,$id = null){
        // dd($request->all());
        
        // Validate the request
        $request->validate([
            'dropdown.*' => 'required|string|max:255',
            'service_id.*' => 'sometimes|nullable|numeric' // For existing services
        ]);
        
        if(isset($request->category_id)){
            $request->validate([
              'category_id' => 'required|numeric',
            ]);
        }else{
            $request->validate([
              'subcategory_id' => 'required|numeric',
            ]);
        }

        // If $id is provided, handle update or create
        if ($id) {
            
             if(isset($request->category_id)){
                  // Retrieve existing services to handle deletions
                $existingServices = ChildCategory::where('category_id', $id)->get()->keyBy('id');
                
                // Array to keep track of existing service IDs for deletion check
                $existingServiceIds = $existingServices->keys()->toArray();
        
                // Iterate over the incoming services
                foreach ($request->dropdown as $index => $service) {
                    $serviceId = $request->input("service_id.$index"); // Get service ID from the request
                    
                    // Update or create service
                    ChildCategory::updateOrCreate(
                        ['id' => $serviceId], // Unique identifier
                        [
                            'label' => $service, // Field to update/create
                            'category_id' => $request->category_id,
                        ]
                    );
                }
                
                // Check for services that need to be deleted (not in the new request)
                foreach ($existingServiceIds as $existingServiceId) {
                    if (!in_array($existingServiceId, $request->input('service_id', []))) {
                        ChildCategory::destroy($existingServiceId); // Delete service if not in request
                    }
                }
                 
             }else{
                  // Retrieve existing services to handle deletions
                $existingServices = ChildCategory::where('sub_category_id', $id)->get()->keyBy('id');
                
                // Array to keep track of existing service IDs for deletion check
                $existingServiceIds = $existingServices->keys()->toArray();
        
                // Iterate over the incoming services
                foreach ($request->dropdown as $index => $service) {
                    $serviceId = $request->input("service_id.$index"); // Get service ID from the request
                    
                    // Update or create service
                    ChildCategory::updateOrCreate(
                        ['id' => $serviceId], // Unique identifier
                        [
                            'label' => $service, // Field to update/create
                            'sub_category_id' => $request->subcategory_id,
                        ]
                    );
                }
        
                // Check for services that need to be deleted (not in the new request)
                foreach ($existingServiceIds as $existingServiceId) {
                    if (!in_array($existingServiceId, $request->input('service_id', []))) {
                        ChildCategory::destroy($existingServiceId); // Delete service if not in request
                    }
                }
             }
          
        } else {
            
            if(isset($request->category_id)){
                 // Create new services when no ID is provided
                foreach ($request->dropdown as $service) {
                    ChildCategory::create([
                        'label' => $service, 
                        'category_id' => $request->category_id,
                    ]);
                }
                
            }else{
                // Create new services when no ID is provided
                foreach ($request->dropdown as $service) {
                    ChildCategory::create([
                        'label' => $service, 
                        'sub_category_id' => $request->subcategory_id,
                    ]);
                }
            }
            
        }
    
        return response()->json(['success' => 'Services updated successfully!']);
        
    }
    
    // public function childSubCategory(Request $request, $id = null)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'dropdown.*' => 'required|string|max:255',
    //         'service_id.*' => 'sometimes|nullable|numeric', // For existing services
    //     ]);
    
    //     if (isset($request->category_id)) {
    //         $request->validate([
    //             'category_id' => 'required|numeric',
    //         ]);
    //     } else {
    //         $request->validate([
    //             'subcategory_id' => 'required|numeric',
    //         ]);
    //     }
    
    //     // If $id is provided, handle update or create
    //     if ($id) {
    //         // Determine if category_id or subcategory_id is set
    //         $identifierField = isset($request->category_id) ? 'category_id' : 'sub_category_id';
    //         $identifierValue = isset($request->category_id) ? $request->category_id : $request->subcategory_id;
    
    //         // Iterate over the incoming services and update or create them
    //         foreach ($request->dropdown as $index => $service) {
    //             $serviceId = $request->input("service_id.$index"); // Get service ID from the request
                
    //             // Update or create the service based on the identifier
    //             ChildCategory::updateOrCreate(
    //                 ['id' => $serviceId], // Unique identifier
    //                 [
    //                     'label' => $service, // Field to update/create
    //                     $identifierField => $identifierValue,
    //                 ]
    //             );
    //         }
    //     } else {
    //         // Create new services when no ID is provided
    //         foreach ($request->dropdown as $service) {
    //             ChildCategory::create([
    //                 'label' => $service,
    //                 isset($request->category_id) ? 'category_id' : 'sub_category_id' => isset($request->category_id) ? $request->category_id : $request->subcategory_id,
    //             ]);
    //         }
    //     }
    //     return response()->json(['success' => 'Services updated successfully!']);
    // }

    
    public function childSubCategoryList($id,$status = null){
        if($status){
            $categories = ChildCategory::with('parentcat')->where('category_id',$id)->get();
        }else{
            $categories = ChildCategory::with('parentcat')->where('sub_category_id',$id)->get();
        }
        return view('admin.category.subcategory.ChildCategoryList',compact('categories'));
    }
    
    public function childSubCategoryUpdate(Request $request,$id){
        $cat = ChildCategory::with('parentcat')->findorfail($id);
        return view('admin.category.subcategory.childcategory',compact('cat'));
    }
    
    public function value(Request $request,$id = null){
        // dd($request->all());
        // Validate the request
        $request->validate([
            'category_id' => 'required|numeric',
            'value.*' => 'required|string|max:255',
            'service_id.*' => 'sometimes|nullable|numeric' // For existing services
        ]);

        // If $id is provided, handle update or create
        if ($id) {
            // Retrieve existing services to handle deletions
            $existingServices = ChildCategory::where('parent', $id)->get()->keyBy('id');
            
            // Array to keep track of existing service IDs for deletion check
            $existingServiceIds = $existingServices->keys()->toArray();
    
            // Iterate over the incoming services
            foreach ($request->value as $index => $service) {
                $serviceId = $request->input("service_id.$index"); // Get service ID from the request
                // Update or create service
                ChildCategory::updateOrCreate(
                    ['id' => $serviceId], // Unique identifier
                    [
                        'value' => $service, // Field to update/create
                        'parent' => $request->category_id,
                    ]
                );
            }
    
            // Check for services that need to be deleted (not in the new request)
            foreach ($existingServiceIds as $existingServiceId) {
                if (!in_array($existingServiceId, $request->input('service_id', []))) {
                    ChildCategory::destroy($existingServiceId); // Delete service if not in request
                }
            }
        }else {
            // Create new services when no ID is provided
            foreach ($request->value as $service) {
                ChildCategory::create([
                    'value' => $service, 
                    'parent' => $request->category_id,
                ]);
            }
        }
        return response()->json(['success' => 'Value updated successfully!']);
    }
    
}
