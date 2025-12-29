<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Media;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    function uploadImage($type,$image,$id){
        
        if($type == 1){ //marketplace
            $module = "marketplace";
            $coloum = "product_id";
        }elseif($type == 2){ //jobs
            $module = "jobs";
            $coloum = "product_id";
        }elseif($type == 3){ //business listing
            $module = "business";
            $coloum = "post_id";
        }else{
            die('please select module type first!');
        }
        
        // Get the current year and month
        $year = now()->format('Y');
        $month = now()->format('m');
    
        // Generate a unique filename for the image
        $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
    
        // Define the path where the image should be stored
        $path = "{$module}/{$year}/{$month}/";
        
        // Store the image in the specified path
        Storage::putFileAs('public', $image, $path);
        
        $result = Media::create([ 
            $coloum => $id,
            'name' => $filename,
            'path' => $path
        ]);
        
        // Return the path of the uploaded image
        return ($result) ? TRUE : FALSE;
        
    }
}
