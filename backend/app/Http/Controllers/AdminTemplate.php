<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surl;
use App\Template;
use App\Http\Requests;

class AdminTemplate extends Controller
{
    
    public function index(){
        $templates =  Template::orderBy('title','asc')->get();
        return view('admin.template.index',compact('templates'));
    }
    
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'message' => 'required|string',
        ]);
        
        if($request->type == "email"){
            $request->validate([
            'subject' => 'required|string',
            ]);  
        }
        
        $template = new Template();
        $template->title = $request->title;
        $template->type = $request->type;
        $template->subject = $request->subject;
        $template->message = $request->message;
        $template->save();
        return back()->with('message','Template add Successfully !!'); 
    }
    
    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'message' => 'required|string',
        ]);
                
        if($request->type == "email"){
            $request->validate([
            'subject' => 'required|string',
            ]);  
        }
        
        $template = Template::findorfail($id);
        $template->title = $request->title;
        $template->type = $request->type;
        $template->subject = $request->subject;
        $template->message = $request->message;
        $template->save();
        return back()->with('message','Template Update Successfully !!');
    }
    
    public function destroy($id){
        $template = Template::findorfail($id);
        $template->delete();
        return back()->with('message','Template Delete Successfully !!'); 
    }
}