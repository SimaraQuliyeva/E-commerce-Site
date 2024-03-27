<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts=Contact::paginate('10');
        return view('back.pages.contact.index',compact('contacts'));
    }

    public function edit($id)
    {
        $contact = Contact::where('id', $id)->firstOrFail();
        return view('back.pages.contact.edit',compact('contact'));

    }

    public function update(Request $request,$id)
    {
        $update = $request->status;
        $status = $update == 'true' ? true : false;
        Contact::where('id', $id)->update(['status' => $status]);
        return back()->with('success', 'Contact updated successfully!');
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
