<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;

class ViewLeadsController extends Controller
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

    public function checkRole(){
        $id = auth()->id();
        $user_role = RoleUser::all()->where('user_id',$id)->first();
        $role_id = $user_role->role_id;
        $role = Role::all()->where('id',$role_id)->first();
        return $role->name;
    }

    public function getLeads(){
        return User::all()->where('infoFlag',true);
    }

    public function index()
    {
        $leads = $this->getLeads();
        $role = $this->checkRole();
        $data = array(
            'role'  => $role,
            'leads' => $leads,
            'count' => 1,
        );
        return view('viewLeads')->with($data);
    }
}
