<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function about()
    {
        return view('About');
    }
    public function contact()
    {
        return view('Contact');
    }
}
