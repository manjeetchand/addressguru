<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Plan;

class PlanController extends Controller
{
    public function index(){
        $plans = Plan::with('features')->get();
        if($plans){
            return response()->json([
                'success' => true,
                'message' => 'Plans retrieved successfully',
                'data' => $plans
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No plans found',
                'data' => []
            ], 404);
        }
    }
}