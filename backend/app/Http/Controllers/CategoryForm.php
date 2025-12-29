<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use App\Coaching;
use App\Query;
use App\SEO;
use App\Personal;
use App\Category;
use App\Categoryforms;
use App\Http\Requests;

class CategoryForm extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'DESC')->where('role_id', '!=', 1)->where('role_id', '!=', 4)->paginate(50);

        $todayuser = User::orderBy('updated_at', 'DESC')->where('role_id', '!=', 1)->where('role_id', '!=', 4)->where('created_at', 'LIKE', '%' . Date('Y-m-d') . '%')->count();

        return view('admin.user.index', compact('user', 'todayuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category_id,$id = null)
    {
        if($id == 1){
            
        }else{
            $forms = Categoryforms::orderBy('column_label','asc')->get();
        }
        
        return view('admin.category.subcategory.form.create',compact('category_id','forms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$category_id)
    {
        dd(1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        Auth::login($user);

        if ($user->isAgent()) 
        {
            return redirect()->route('Partner Dashboard.index');
        }
        elseif ($user->isUser()) 
        {
            return redirect()->route('Dashboard.index');
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $role = Role::all();

        return view('admin.user.edit', compact('user', 'role'));
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
    dd($request->all());
    // Validate the request data
    // $request->validate([
    //     'category_id' => 'required|exists:categories,id',
    //     'column_label' => 'required|array',
    //     'column_label.*' => 'required|string',
    //     'column_name' => 'required|array',
    //     'column_name.*' => 'required|string',
    //     'column_placeholder' => 'nullable|array',
    //     'column_placeholder.*' => 'nullable|string',
    //     'column_type' => 'required|array',
    //     'column_type.*' => 'required|string',
    //     'column_value' => 'nullable|array',
    //     'column_value.*' => 'nullable|string',
    // ]);
    // dd($request->all());
    // Loop through each column label to build the array of column data



    // Loop through each column label to build the array of column data
    foreach ($request->column_label as $index => $label) {
        $columnValues = [
            'category_id' => $request->category_id,
            'column_label' => $label,
            'column_name' => $request->column_name[$index],
            'column_placeholder' => $request->column_placeholder[$index] ?? null,
            'column_type' => $request->column_type[$index],
            // If column_value is an array, convert it to a string (JSON format or CSV)
            'column_value' => isset($request->column_value[$index]) && is_array($request->column_value[$index])
                ? json_encode($request->column_value[$index]) // Convert array to JSON string
                : $request->column_value[$index] ?? null,
        ];

        // Update or create the category form entry
        Categoryforms::updateOrCreate(
            ['category_id' => $columnValues['category_id'], 'column_name' => $columnValues['column_name']],
            $columnValues
        );
    }

    // Return a success message after updating
    return redirect()->back()->with('success', 'Category columns updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        Coaching::where('user_id', '=', $user->id)->delete();
       
        Personal::where('email', '=', $user->email)->delete();

        Query::where('user_id', '=', $user->id)->delete();

        SEO::where('user_id', '=', $user->id)->delete();
    
        $user->delete();

       return redirect('admin-user');
    }

}
