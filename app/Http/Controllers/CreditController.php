<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreditApp;

class CreditController extends Controller
{
    // Grabbing the view for the credit application page
    public function index(){
        return view('credit.index');
    }

    public function postCreditApp(Request $request){
        Mail::to(env('MAIL_RECIPIENT_ACCOUNT'))->send(new CreditApp($request));

        return back()->with('success', 'Thanks for filling in our credit application form.');
    }
}
