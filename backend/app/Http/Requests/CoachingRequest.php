<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
class CoachingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if (Auth::user()->role->name == 'Agent') 
        {
            return [
        
            'business_name'        => 'required|max:100',
            'business_address'     => 'required',
            'ad_description'       => 'required|max:1800|min:200',
            'payment'              => 'required',
            
           
            ];
        }
        else
        {
        return [
            
            'business_name'        => 'required|max:100',
            'business_address'     => 'required',
            'ad_description'       => 'required|max:1800|min:200',
            'payment'              => 'required',

        ];
    }
    }
}
