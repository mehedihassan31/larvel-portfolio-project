<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    function termsIndex(){

        return view('terms');
    }
}
