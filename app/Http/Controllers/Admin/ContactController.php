<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactStoreRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        return view('backend.admin.contact.index');
    }

    public function getContact(Request $request)
    {
        $Contact = Contact::latest()->paginate(5);
        return response()->json($Contact);
    }
    public function changeContactRead(Request $request)
    {
        $Contact = Contact::find($request->id);
        $Contact->read = !$Contact->read;
        $Contact->update();
        return response()->json($Contact);
    }

    public function saveContact(ContactStoreRequest $request){
        $contact = new Contact();
        $contact->fill($request->all());
        $contact->save();
        return response()->json('success');
    }
}
