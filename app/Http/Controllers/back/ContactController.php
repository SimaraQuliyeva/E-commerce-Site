<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact=Contact::where('id',1)->first();
        return view('back.pages.contact.index',compact('contact'));
    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }

    public function destroy(Request $request)
    {
        $contact = Contact::where('id', $request->id)->firstOrFail();

        $contact->delete();
        return response(['error'=>false, 'message'=>'Slider deleted successfully']);

    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $status = $update == 'true' ? true : false;

        Contact::where('id', $request->id)->update(['status' => $status]);

        return response(['error' => false, 'status' => $status]);
    }


}
