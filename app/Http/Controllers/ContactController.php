<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Contact;
use App\Mail\ContactUs;

class ContactController extends Controller
{
    // Grabbing the view for the contact page
    public function index(){
        return view('contact.index');
    }
    
    public function postContactUs(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        Mail::to('robert@lsi.co.uk')->send(new ContactUs($request));
        // return new ContactUs($request);

        Contact::create($request->all());

        return back()->with('success', 'Thanks for contacting us!');
    }
}
