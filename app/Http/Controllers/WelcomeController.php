<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the view leads page.
     *
     * @return \Illuminate\Http\Response
     */

    public function showPrivacy(){
        return view('privacy');
    }


    public function showTermsOfServices(){
        return view('termsofservices');
    }
}
