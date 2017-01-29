<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DAL extends Controller
{
    
    public function insertProfileSummary(Request $request)
    {
		$method = $request->method();
		$fname = $request["fname"];
		$lname = $request["lname"];
		$title = $request["title"];
		$location = $request["location"];
		$psummary = $request["psummary"];
		$userid = Auth::id();

		$deleted = DB::delete('delete from profilesummary');
		DB::insert('INSERT INTO profilesummary (fname,lname,title,location,profile_summary,user_id) VALUES(?,?,?,?,?,?)', [$fname,$lname,$title,$location,$psummary,$userid]);
		return response()->json(['status' => "1" ]);
    }

    public function getProfileSummary(Request $request){
    	$userid = Auth::id();
    	$profilesummaryRS = DB::select('select * from profilesummary where user_id = ?', [$userid]);
		return response()->json($profilesummaryRS[0]);
    }

    public function setInfoFlag(Request $request){
        $option=false;
        if ($request["value"]=='true'){
            $option=true;
        }
        DB::table('users')->where('id',AUTH::id())
            ->update(['infoFlag'=>$option]);
       return response()->json(['status' => "1" ]);
    }

    public function sendMessageAll(Request $request){
        $message = $request["message"];
        $subject = $request["subject"];
        $from_user_id = auth()->id();
        $time = Carbon::now();//returns current timestamp
        $users = User::all();
        foreach ($users as $user){//send message to all users
            $to_user_id = $user->id;
            DB::insert('INSERT INTO messages (subject,message,to_user_id,from_user_id,is_read,created_at,updated_at) VALUES(?,?,?,?,?,?,?)',[$subject,$message,$to_user_id,$from_user_id,false,$time,$time]);
        }
         return response()->json(['status' => "1" ]);
    }

    public function setMessagesRead(){
        DB::table('messages')->where('to_user_id',AUTH::id())
            ->update(['is_read'=>true]);
        return response()->json(['status' => "1" ]);
    }
}


