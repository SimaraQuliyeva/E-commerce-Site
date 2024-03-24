<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function contactSave(ContactFormRequest $request){
//        $validationData= $request->validate([
//            'c_name'=>'required|string',
//            'c_email'=>'required|email',
//            'c_subject'=>'required',
//            'c_message'=>'required'
//        ],[
//            'c_name.required'=>'Fill your Name'
//            ]);

           $data= $request->all();
           $data['ip']=request()->ip();
         $lastsaved= Contact::create($data);
         return back()->with(['message'=>'Your message has been delivered!']);

    }

    public function logOut(){
        Auth::logout();
        return redirect()->route('front.index');
    }
}
