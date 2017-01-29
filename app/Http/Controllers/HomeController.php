<?php

namespace App\Http\Controllers;

use App\Awardsandhonor;
use App\Education;
use App\Interest;
use App\Langauge;
use App\Language;
use App\MyLink;
use App\Skill;
use App\User;

use App\Profilesummary;
use App\Workexperience;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function insertProfileSummary(Request $request)
    {
        $method = $request->method();
        $fname = $request["fname"];
        $lname = $request["lname"];
        $title = $request["title"];
        $location = $request["location"];
        $psummary = $request["psummary"];
        $userid = Auth::id();
        $email =  $request["profileSummaryEmail"];
        $website=$request["profileSummaryWebsite"];
        $phoneno=$request["profileSummaryPhoneNo"];
        $deleted = DB::delete('delete from profilesummaries');
        DB::insert('INSERT INTO profilesummaries (fname,lname,title,location,profile_summary,user_id,email,website,phoneno) VALUES(?,?,?,?,?,?,?,?,?)',
        [$fname,$lname,$title,$location,$psummary,$userid,$email,$website,$phoneno]);
        return response()->json(['status' => "1" ]);
    }

    public function insertWorkExperience(Request $request)
    {
        $Workexperience = new Workexperience;
        $userid = Auth::id();
        
        $Workexperience->userid = $userid;
        $Workexperience->title = $request["title"];
        $Workexperience->company = $request["company"];
        $Workexperience->startmonth = $request["startmonth"];
        $Workexperience->startyear = $request["startyear"];
        $Workexperience->endmonth  = $request["endmonth"];
        $Workexperience->endyear = $request["endyear"];
        $Workexperience->location = $request["location"];
        $Workexperience->summary = $request["summary"];

        $Workexperience->save();
    }

    public function insertEducation(Request $request)
    {
        $education = new Education();
        $userid = Auth::id();

        $education->userid = $userid;
        $education->school = $request["school"];
        $education->programofstudy = $request["programofstudy"];
        $education->degree = $request["degree"];
        $education->startmonth = $request["startmonth"];
        $education->startyear = $request["startyear"];
        $education->endmonth = $request["endmonth"];
        $education->endyear = $request["endyear"];
        $education->location = $request["location"];
        $education->activities = $request["activities"];

        $education->save();
    }


    public function insertMyLinks(Request $request)
    {
        $mylinks = new MyLink();
        $userid = Auth::id();

        $mylinks->userid = $userid;
        $mylinks->category = $request["category"];
        $mylinks->url = $request["url"];

        $mylinks->save();
    }

    public function insertSkills(Request $request)
    {
        $skills = new Skill();
        $userid = Auth::id();

        $skills->userid = $userid;
        $skills->skill = $request["skill"];
        $skills->years = $request["years"];
        $skills->proficiency = $request["proficiency"];

        $skills->save();
    }

    public function insertInterests(Request $request)
    {
        $interests = new Interest();
        $userid = Auth::id();

        $interests->userid = $userid;
        $interests->interest = $request["interest"];
        $interests->levelofinterest = $request["levelofinterest"];

        $interests->save();
    }

    public function insertLanguages(Request $request)
    {
        $langauges = new Language();
        $userid = Auth::id();

        $langauges->userid = $userid;
        $langauges->language = $request["language"];
        $langauges->proficiency = $request["proficiency"];

        $langauges->save();
    }

    public function insertAwardsAndHonors(Request $request)
    {
        $awardsandhonors = new Awardsandhonor();
        $userid = Auth::id();

        $awardsandhonors->userid = $userid;
        $awardsandhonors->title = $request["title"];
        $awardsandhonors->importance = $request["importance"];
        $awardsandhonors->yearreceived = $request["yearreceived"];
        $awardsandhonors->save();
    }


    public function getProfileSummary(Request $request){
        $userid = Auth::id();


        $profilesummaryRS = Profilesummary::all()->where('user_id', '=', $userid)->first();
        if( isset($profilesummaryRS)){
            return response()->json($profilesummaryRS);    
        }else{
            return "-1";
        }
        //return response()->json($profilesummaryRS[0]);
    
    }

    public function getWorkExperience(Request $request){
        $userid = Auth::id();

        $workEsperienceRS = Workexperience::where('userid', '=', $userid)->orderBy('id', 'desc')->get();
        if( isset($workEsperienceRS)){
            return response()->json($workEsperienceRS);    
        }else{
            return "-1";
        }
        //return response()->json($profilesummaryRS[0]);
    }

    public function getEducation(Request $request){
        $userid = Auth::id();

        $educationRS = Education::where('userid', '=', $userid)->orderBy('id', 'desc')->get();
        if( isset($educationRS)){
            return response()->json($educationRS);
        }else{
            return "-1";
        }
        //return response()->json($profilesummaryRS[0]);
    }

    public function getMylinks(Request $request){
        $userid = Auth::id();

        $myLinksRS = Mylink::where('userid', '=', $userid)->orderBy('id', 'desc')->get();
        if( isset($myLinksRS)){
            return response()->json($myLinksRS);
        }else{
            return "-1";
        }
        //return response()->json($profilesummaryRS[0]);
    }

    public function editWorkExperiencePopulateForm(Request $request){
        $userid = Auth::id();
        $Workexperience_id = $request["id"];
        $workEsperienceRS = DB::table('Workexperiences')->where([
            ['userid', '=', $userid],
            ['id', '=', $Workexperience_id],
        ])->get();
        if( isset($workEsperienceRS)){
            return response()->json($workEsperienceRS);    
        }else{
            return "-1";
        }
    }

    public function editEducationPopulateForm(Request $request){
        $userid = Auth::id();
        $education_id = $request["id"];
        $educationRS = DB::table('education')->where([
            ['userid', '=', $userid],
            ['id', '=', $education_id],
        ])->get();
        if( isset($educationRS)){
            return response()->json($educationRS);    
        }else{
            return "-1";
        }
    }

public function editMyLinkPopulateForm(Request $request){
        $userid = Auth::id();
        $mylink_id = $request["id"];
        $mylinksRS = DB::table('my_links')->where([
            ['userid', '=', $userid],
            ['id', '=', $mylink_id],
        ])->get();
        if( isset($mylinksRS)){
            return response()->json($mylinksRS);    
        }else{
            return "-1";
        }
    }


     public function editWorkExperience(Request $request){
        $Workexperience = new Workexperience;
        $userid = Auth::id();
        
        $userid = $userid;
        $id = $request["id"];
        $title = $request["title"];
        $company = $request["company"];
        $startmonth = $request["startmonth"];
        $startyear = $request["startyear"];
        $endmonth  = $request["endmonth"];
        $endyear = $request["endyear"];
        $location = $request["location"];
        $summary = $request["summary"];
        $Workexperience->where('id',$id)->where('userid',$userid)
        ->update(['title' => $title,'company' => $company,'startmonth' => $startmonth,'startyear' => $startyear,'endmonth' => $endmonth,'endyear' => $endyear,'location' => $location ,'summary' => $summary]);
                
    }

 public function editEducation(Request $request){
        $education = new Education;
        $userid = Auth::id();
        

$school=$request["school"];
$degree=$request["degree"];
$programofstudy=$request["programofstudy"];
$startmonth=$request["startmonth"];
$startyear=$request["startyear"];
$endmonth=$request["endmonth"];
$endyear=$request["endyear"];
$location=$request["location"];
$activities=$request["activities"];
$id = $request["id"];
        $Workexperience->where('id',$id)->where('userid',$userid)
        ->update(['school' => $school,
'degree' => $degree,
'programofstudy' => $programofstudy,
'startmonth' => $startmonth,
'startyear' => $startyear,
'endmonth' => $endmonth,
'endyear' => $endyear,
'location' => $location,
'activities' => $activities,
         ]);
                
    }

    public function deleteWorkExperience(Request $request){
        $userid = Auth::id();
        $Workexperience_id = $request["id"];
        DB::table('Workexperiences')->where([
            ['userid', '=', $userid],
            ['id', '=', $Workexperience_id],
        ])->delete();

        if( isset($workEsperienceRS)){
            return response()->json($workEsperienceRS);    
        }else{
            return "-1";
        }
    }

    public function deleteEducation(Request $request){
        $userid = Auth::id();
        $Education_id = $request["id"];
        DB::table('education')->where([
            ['userid', '=', $userid],
            ['id', '=', $Education_id],
        ])->delete();

        if( isset($educationRS)){
            return response()->json($educationRS);
        }else{
            return "-1";
        }
    }

    public function deleteMyLinks(Request $request){
        $userid = Auth::id();
        $MyLinks_id = $request["id"];
        DB::table('my_links')->where([
            ['userid', '=', $userid],
            ['id', '=', $MyLinks_id],
        ])->delete();

        if( isset($myLinksRS)){
            return response()->json($myLinksRS);
        }else{
            return "-1";
        }
    }

    public function deleteSkills(Request $request){
        $userid = Auth::id();
        $Skills_id = $request["id"];
        DB::table('skills')->where([
            ['userid', '=', $userid],
            ['id', '=', $Skills_id],
        ])->delete();

        if( isset($skillsRS)){
            return response()->json($skillsRS);
        }else{
            return "-1";
        }
    }

    public function deleteInterests(Request $request){
        $userid = Auth::id();
        $Interests_id = $request["id"];
        DB::table('interests')->where([
            ['userid', '=', $userid],
            ['id', '=', $Interests_id],
        ])->delete();

        if( isset($interestsRS)){
            return response()->json($interestsRS);
        }else{
            return "-1";
        }
    }

    public function deleteLanguages(Request $request){
        $userid = Auth::id();
        $Languages_id = $request["id"];
        DB::table('languages')->where([
            ['userid', '=', $userid],
            ['id', '=', $Languages_id],
        ])->delete();

        if( isset($languagesRS)){
            return response()->json($languagesRS);
        }else{
            return "-1";
        }
    }

    public function deleteAwardsAndHonors(Request $request){
        $userid = Auth::id();
        $AwardsAndHonors_id = $request["id"];
        DB::table('awardsandhonors')->where([
            ['userid', '=', $userid],
            ['id', '=', $AwardsAndHonors_id],
        ])->delete();

        if( isset($awardsandhonorsRS)){
            return response()->json($awardsandhonorsRS);
        }else{
            return "-1";
        }
    }
    

}
