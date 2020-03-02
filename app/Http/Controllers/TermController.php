<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermController extends Controller
{
    // Return view of the terms and conditions page
    public function index()
    {
        return view('terms.index');
    }
}
