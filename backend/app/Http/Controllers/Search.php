<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Personal;
use App\Coaching;
use App\Category;
use App\Surl;
use App\SubCategory;
use App\Banner;
use App\Http\Requests;
use Illuminate\Support\Facades\Http;

class Search extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request ,$category,$city)
        {
        
            $subcategoryId = $request->get('subcategory');
            $category = str_replace('-', ' ', $category); 
            $categories = Category::where('name',$category)->first();
            $eid = $categories->id;
            $data=array();
            if($subcategoryId) {
                $contacts = Personal::where('city', '=', $city)->where('category_id', '=', $eid)->where('subcategory_id',$subcategoryId)->where('status', '=', 1)->where('is_active', '=', 1)->orderBy('paid', 'DESC')->inRandomOrder()->get();
            }else{
                $contacts = Personal::where('city', '=', $city)->where('category_id', '=', $eid)->where('status', '=', 1)->where('is_active', '=', 1)->orderBy('paid', 'DESC')->inRandomOrder()->get();
            }
            foreach ($contacts as $contact){
                $post = Coaching::where('id', '=', $contact->post_id)->where('status', '=', 1)->get();
                array_push($data, $post);  
            }
            $category_id = $eid;
            $category = Category::findOrFail($eid);
            $city = str_replace('-', ' ', $city); 
            $check = Personal::where('category_id', '=', $eid)->where('status', '=', 1)->where('state', '=', isset($contacts[0]) ? $contacts[0]->state : 0)->pluck('city'); 
            $check1 = collect($check);   
            $unique = $check1->unique()->values()->all();
            $ca = Personal::where('city', '=', $city)->where('status', '=', 1)->pluck('category_id');
            $see = collect($ca);   
            $footer_category = $see->unique()->values()->all();
            $name = Coaching::where('category_id', '=', $eid)->where('status', '=', 1)->pluck('business_name'); 
            $name_check = collect($name);   
            $select_name = $name_check->unique()->values()->all();
            $banner = Banner::where('status', '=', 1)->inRandomOrder()->get();
            $sub = SubCategory::where('category_id', '=', $eid)->orderBy('id', 'DESC')->get();
            if ($request->ajax()) {
                $view = view('posts.partials.subcategory-list', compact('subcategories','data','category', 'city', 'category_id', 'select_name', 'contacts', 'unique', 'banner', 'footer_category', 'sub'))->render();
                return response()->json(['view' => $view]);
            }
            return view('posts.search', compact('data','category', 'city', 'category_id', 'select_name', 'contacts', 'unique', 'banner', 'footer_category', 'sub'));
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category, $local, $city, $id)
    {
        $eids = base64_decode($id);
        $data=array();
        $contacts = Personal::where('city', '=', $city)->where('category_id', '=', $eids)->where('status', '=', 1)->where('is_active', '=', 1)->get();
        $contactss = Personal::where('city', '=', $city)->where('category_id', '=', $eids)->where('status', '=', 1)->where('location', 'like', '%' . $local . '%')->orderBy('paid', 'DESC')->inRandomOrder()->get();
        foreach ($contactss as $contact) 
        {
            $contact->post_id; 
            $post = Coaching::where('id', '=', $contact->post_id)->where('status', '=', 1)->get();
            array_push($data, $post);
        }
        $category_id = $eids;
        $category = Category::findOrFail($eids);
        $city = $city;   
        $check = Personal::where('category_id', '=', $eids)->where('status', '=', 1)->where('state', '=', isset($contacts[0]) ? $contacts[0]->state : 0)->pluck('city');
        $check1 = collect($check);   
        $unique = $check1->unique()->values()->all();  
        $ca = Personal::where('city', '=', $city)->where('status', '=', 1)->pluck('category_id');
        $see = collect($ca);   
        $footer_category = $see->unique()->values()->all();
        $name = Coaching::where('category_id', '=', $eids)->where('status', '=', 1)->pluck('business_name'); 
        $name_check = collect($name);   
        $select_name = $name_check->unique()->values()->all();   
        $banner = Banner::where('status', '=', 1)->inRandomOrder()->get();
        $sub = SubCategory::where('category_id', '=', $eids)->orderBy('id', 'DESC')->get();
        return view('posts.search', compact('data', 'category', 'city', 'select_name', 'footer_category', 'category_id', 'contacts', 'unique', 'banner', 'sub'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     dd($request->all());



    //     $input = $request->all();
    //     setcookie('cityname', $input['city']);
    //     if (request()->has('local')) 
    //     {
    //         $request->all();
    //         $cat = Category::findOrFail($input['category']);
    //         $cats = preg_replace("/[\s_]/", "-", $cat->name);
    //         $locals = preg_replace("/[\s_]/", " ", $input['local']);
    //         $did = base64_encode($input['category']);
    //         $u = '/'.$cats.'/'.$locals.'/'.$input['city'].'/'.$did;
    //         $urls = Surl::where('url', '=', $u)->count();
    //         if ($urls == 0) 
    //         {
    //             Surl::create(['url' => $u]);
    //         }
    //         return redirect($u);
    //     }
    //     elseif (request()->has('top')) 
    //     {
    //         $cat = Category::findOrFail($input['category']);
    //         $cats = preg_replace("/[\s_]/", "-", $cat->name);
    //         $did = base64_encode($input['category']);
    //         $u = '/list-of-/'.$input['top'].'/'.$cats.'/'.$input['city'].'/'.$did;
    //         $urls = Surl::where('url', '=', $u)->count();
    //         if ($urls == 0) 
    //         {
    //             Surl::create(['url' => $u]);
    //         }
    //         return redirect($u);
    //     }
    //     elseif (request()->has('title')) 
    //     {
    //         $eid = $input['cat'];
    //         $data=array();
    //         $contacts = Personal::where('city', '=', $input['city'])->where('category_id', '=', $eid)->where('is_active', '=', 1)->orderBy('paid', 'DESC')->inRandomOrder()->get();
    //         foreach ($contacts as $contact) 
    //         {
    //             $contact->post_id; 
    //             $post = Coaching::where('id', '=', $contact->post_id)->where('business_name', 'like', '%' . $input['title'] . '%')->where('status', '=', 1)->get();
    //             array_push($data, $post);
    //         }
    //         $category_id = $eid;
    //         $category = Category::findOrFail($eid);
    //         $city = $input['city'];    
    //         $check = Personal::where('category_id', '=', $eid)->where('state', '=', isset($contacts[0]) ? $contacts[0]->state : 0)->pluck('city'); 
    //         $check1 = collect($check);   
    //         $unique = $check1->unique()->values()->all();
    //         $name = Coaching::where('category_id', '=', $eid)->where('status', '=', 1)->pluck('business_name'); 
    //         $name_check = collect($name);   
    //         $select_name = $name_check->unique()->values()->all();
    //         $banner = Banner::where('status', '=', 1)->inRandomOrder()->get();
    //         $sub = SubCategory::where('category_id', '=', $eid)->orderBy('id', 'DESC')->get();
    //         return view('posts.search', compact('data', 'category', 'city', 'select_name', 'category_id', 'contacts', 'unique', 'banner', 'sub'));
    //     }
    //     elseif(request()->has('namebyname'))
    //     {
    //         $sele = Coaching::where('business_name', 'like', '%' . $input['namebyname'] . '%')->get()->first();
    //         $eid = $sele->category_id ?? '';
    //         $data=array();
    //         $contacts = Personal::where('city', '=', $input['city'])->where('status', '=', 1)->where('category_id', '=', $eid)->where('is_active', '=', 1)->orderBy('paid', 'DESC')->inRandomOrder()->get();
    //         foreach ($contacts as $contact) 
    //         {
    //             $contact->post_id; 
    //             $post = Coaching::where('id', '=', $contact->post_id)->where('business_name', 'like', '%' . $input['namebyname'] . '%')->where('status', '=', 1)->get();
    //             array_push($data, $post);
    //         }
    //         $category_id = $eid;
    //         $category = Category::findOrFail($eid);
    //         $city = $input['city'];    
    //         $check = Personal::where('category_id', '=', $eid)->where('status', '=', 1)->where('state', '=', isset($contacts[0]) ? $contacts[0]->state : 0)->pluck('city'); 
    //         $check1 = collect($check);   
    //         $unique = $check1->unique()->values()->all();
    //         $name = Coaching::where('category_id', '=', $eid)->where('status', '=', 1)->pluck('business_name'); 
    //         $name_check = collect($name);   
    //         $select_name = $name_check->unique()->values()->all();
    //         $banner = Banner::where('status', '=', 1)->inRandomOrder()->get();
    //         $sub = SubCategory::where('category_id', '=', $eid)->orderBy('id', 'DESC')->get();
    //         // dd($data);
    //         return view('posts.search', compact('data', 'category', 'city', 'select_name', 'category_id', 'contacts', 'unique', 'banner', 'sub'));
    //     }
    //     elseif (request()->has('subcategory')) 
    //     {
    //         $cat = Category::findOrFail($input['category']);
    //         $cats = preg_replace("/[\s_]/", "-", $cat->name);
    //         $sub = SubCategory::findOrFail($input['subcategory']);
    //         $subs = preg_replace("/[\s_]/", "-", $sub->name);
    //         $did = base64_encode($input['subcategory']);
    //         $u = '/'.$cats.'/'.$subs.'/in/'.$input['city'].'/'.$did;
    //         $urls = Surl::where('url', '=', $u)->count();
    //         if ($urls == 0) 
    //         {
    //             Surl::create(['url' => $u]);
    //         }
    //         return redirect($u);
    //     }
    //     else
    //     {
    //         $cat = Category::findOrFail($input['path']);
    //         $cats = preg_replace("/[\s_]/", "-", $cat->name);
    //         $did = base64_encode($input['path']);
    //         $u = '/'.$cats.'/'.$input['city'].'/'.$did;
    //         $urls = Surl::where('url', '=', $u)->count();
    //         if ($urls == 0) 
    //         {
    //             Surl::create(['url' => $u]);
    //         }
    //         return redirect($u);
    //     }
    // }


    // public function store(Request $request)
    // {
    //     $query = $request->input('namebyname');
    //     $response = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
    //         'query' => $query,
    //         'key' =>
    //     ]);
    
    //     if ($response->successful()) {
    //         $data = $response->json()['results'];
    //         // return response()->json([
    //         //     'status' => 'success',
    //         //     'data' => $results
    //         // ]);
    //         return view('posts.search-2',compact('data'));
    //     } else {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to fetch data from Google Maps API.'
    //         ], $response->status());
    //     }
    // }


    // public function details(Request $request,$place_id){
    //     $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
    //         'place_id' => $place_id,
    //         'key' =>

    //     if ($response->successful()) {
    //         $data = $response->json();
    //         return response()->json([
    //             'status' => 'success',
    //             'data' => $data
    //         ]);
    //         // return view('posts.search-2',compact('data'));
    //     } else {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to fetch data from Google Maps API.'
    //         ], $response->status());
    //     }
    // }
    
     /* Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($top, $category, $city, $id)
    {
        $eid = base64_decode($id);
        $data=array();
        $contacts = Personal::where('city', '=', $city)->where('status', '=', 1)->where('category_id', '=', $eid)->where('is_active', '=', 1)->orderBy('paid', 'DESC')->limit($top)->inRandomOrder()->get();
        foreach ($contacts as $contact) 
        {
            $contact->post_id; 
            $post = Coaching::where('id', '=', $contact->post_id)->where('status', '=', 1)->get();
            array_push($data, $post);
        }
        $category_id = $eid;
        $category = Category::findOrFail($eid);
        $city = $city;  
        $check = Personal::where('category_id', '=', $eid)->where('status', '=', 1)->where('state', '=', isset($contacts[0]) ? $contacts[0]->state : 0)->pluck('city');
        $check1 = collect($check);   
        $unique = $check1->unique()->values()->all(); 
        $name = Coaching::where('category_id', '=', $eid)->where('status', '=', 1)->pluck('business_name'); 
        $name_check = collect($name);   
        $select_name = $name_check->unique()->values()->all();
        $ca = Personal::where('city', '=', $city)->where('status', '=', 1)->pluck('category_id');
        $see = collect($ca);   
        $footer_category = $see->unique()->values()->all();
        $banner = Banner::where('status', '=', 1)->inRandomOrder()->get();  
        $sub = SubCategory::where('category_id', '=', $eid)->orderBy('id', 'DESC')->get();
        return view('posts.search1', compact('data', 'category', 'sub', 'city', 'select_name', 'footer_category', 'category_id', 'contacts', 'unique', 'banner', 'top'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function sub($category, $subcategory, $city, $id)
    {
        $eid = base64_decode($id);
        $data=array();
        $cate = SubCategory::findOrFail($eid);
        $contacts = Personal::where('city', '=', $city)->where('subcategory_id', '=', $eid)->where('is_active', '=', 1)->orderBy('paid', 'DESC')->where('post_status', '=', 1)->where('status', '=', 1)->inRandomOrder()->get();
        foreach ($contacts as $contact) 
        {
            $contact->post_id; 
            $post = Coaching::where('id', '=', $contact->post_id)->where('status', '=', 1)->where('post_status', '=', 1)->get();
            array_push($data, $post);
        }
        $category_id = $cate->category_id;
        $category = Category::findOrFail($category_id);
        $city = $city;  
        $check = Personal::where('category_id', '=', $category_id)->where('status', '=', 1)->pluck('city'); 
        $check1 = collect($check);   
        $unique = $check1->unique()->values()->all(); 
        $name = Coaching::where('category_id', '=', $category_id)->where('status', '=', 1)->pluck('business_name'); 
        $name_check = collect($name);   
        $select_name = $name_check->unique()->values()->all();
        $banner = Banner::where('status', '=', 1)->inRandomOrder()->get(); 
        $sub = SubCategory::where('category_id', '=', $category_id)->orderBy('id', 'DESC')->get(); 
        return view('posts.search2', compact('data', 'category', 'city', 'select_name', 'category_id', 'contacts', 'unique', 'banner', 'sub', 'cate'));
    }
}