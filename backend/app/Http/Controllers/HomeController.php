<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Personal;
use App\Coaching;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $cat = Coaching::where('status', '=', 1)->pluck('category_id'); 

        $check = collect($cat);   

        $cate = $check->unique()->values()->all();

        $category = Category::findOrFail($cate);

        $check = Personal::where('status', '=', 1)->pluck('city'); 

        $check1 = collect($check);   

        $uniques = $check1->unique()->values()->all();

        $ads = Coaching::where('status', '=', 1)->orderBy('id', 'DESC')->limit(20)->get();

        return view('welcome', compact('user', 'category', 'uniques', 'ads'));
    }
}
