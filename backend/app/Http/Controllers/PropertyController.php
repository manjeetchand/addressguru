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

class PropertyController extends Controller
{
    public function index (){
        return view('property.index');
    }
}