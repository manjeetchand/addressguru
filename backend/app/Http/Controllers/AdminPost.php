<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use App\Coaching;
use App\Personal;
use App\SubCategory;
use App\Query;
use App\Claim;
use App\SEO;
use App\Category;
use App\Http\Requests;

class AdminPost extends Controller
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
    public function create()
    {
        
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

        if (request()->has('a')) 
        {
            $sub = SubCategory::where('category_id', '=', $input['a'])->get();

            foreach ($sub as $value) 
            {
                echo "<option value='".$value->id."'>".$value->name."</option>";
            }
        }
        else
        {

            if (request()->has('claim')) 
            {
                $user = Claim::findOrFail($input['claim']);
            }
            elseif(request()->has('query'))
            {
                $user = Query::findOrFail($input['query']);
            }
        
            $to = $user->email;
            $subject = $input['subject'];
            $htmlContent = $input['message'];
            $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
              'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $htmlContent, $headers);

            Session::flash('insert', 'Successfully Sent Email!');

            return redirect()->back();
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Coaching::where('user_id', '=', $id)->where('post_status', '=', 1)->orderBy('id', 'DESC')->paginate(50);

        $user = User::findOrFail($id);

        return view('admin.listing.index', compact('data', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Coaching::findOrFail($id);

        $seo = SEO::where('post_id', '=', $post->id)->get();

        $local = Personal::where('post_id', '=', $id)->get();

        $cat = Category::orderBy('name', 'ASC')->get();

        $sub = SubCategory::where('category_id', '=', $post->category_id)->get();

        return view('admin.listing.edit', compact('post', 'seo', 'local', 'cat', 'sub'));
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
        $this->validate($request, [
            'business_name' => 'required',
            'business_address' => 'required',
            'ad_description' => 'required',
            's_description' => 'required',
            'keywords' => 'required',
        ]);

        $input = $request->all();

        Coaching::findOrFail($id)->update([

            'business_name' => $input['business_name'],
            'business_address' => $input['business_address'],
            'map' => $input['map'],
            'web_link' => $input['web_link'],
            'service' => json_encode($input['service']),
            'facility' => json_encode($input['facility']),
            'payment' => json_encode($input['payment']),
            'course' => json_encode($input['course']),
            'video' => $input['video'],
            'ad_description' => $input['ad_description'],
            'category_id' => $input['category_id'],
            'subcategory_id' => isset($input['subcategory_id']) ? $input['subcategory_id'] : null,

        ]);
 
        SEO::where('post_id', '=', $id)->update([

            's_description' => $input['s_description'],
            'keywords' => $input['keywords'],

        ]);

        Personal::where('post_id', '=', $id)->update([
            'location'=>$input['location'], 
            'state'=>$input['state'], 
            'city'=>$input['city'],
            'email' => $input['email'],
            'category_id' => $input['category_id'],
            'subcategory_id' => isset($input['subcategory_id']) ? $input['subcategory_id'] : null,

        ]);

        Session::flash('update', 'Successfully Updated ');

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
         $cat = Coaching::findOrFail($id);

        Personal::where('post_id', '=', $cat->id)->delete();

        Query::where('post_id', '=', $cat->id)->delete();
        
        SEO::where('post_id', '=', $cat->id)->delete();

        $cat->delete();

        return redirect()->back();
    }

    public function change(Request $request, $id)
    {
        $this->validate($request, [
           'photo' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $input = $request->all();

        $file = $request->file('photo');

        $name = rand() . '.' . $file->getClientOriginalExtension();

        $file->move('images', $name);

        Coaching::findOrFail($id)->update(['photo'=> $name]);

        return redirect()->back();
    }
}
