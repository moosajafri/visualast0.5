<?php

namespace App\Http\Controllers;


use App\Message;
use App\Role;
use App\RoleUser;

class DashBoardController extends Controller
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
     * Show the application dashboard.
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

    public function getMessages(){
        $messages = Message::where('to_user_id',auth()->id())
            ->orderBy('updated_at','desc')
            ->get();
        return $messages;
    }


    public function index()
    {
        $messages = $this->getMessages();
        $role = $this->checkRole();
        $data = array(
            'role'  => $role,
            'messages' => $messages,
        );
        return view('dashboard')->with($data);
    }
}
