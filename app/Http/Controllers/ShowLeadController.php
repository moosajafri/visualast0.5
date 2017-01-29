<?php

namespace App\Http\Controllers;

use App\Awardsandhonor;
use App\Education;
use App\Interest;
use App\Language;
use App\MyLink;
use App\Profilesummary;
use App\Role;
use App\RoleUser;
use App\Skill;
use App\User;
use App\Workexperience;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ShowLeadController extends Controller
{
    //
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


    public function getProfileSummary($user_id){
        return $profileSummary = Profilesummary::all()->where('user_id',$user_id)->first();
    }

    public function getWorkExperience($user_id){
        return $workExperiences = Workexperience::all()->where('userid',$user_id);
    }

    public function getEducation($user_id){
        return $educations = Education::all()->where('userid',$user_id);
    }

    public function getSkills($user_id){
        return $skills = Skill::all()->where('userid',$user_id);
    }

    public function getInterests($user_id){
        return $interests = Interest::all()->where('userid',$user_id);
    }

    public function getAwardsAndHonors($user_id){
        return $awardsAndHonors = Awardsandhonor::all()->where('userid',$user_id);
    }

    public function getMyLinks($user_id){
        return $myLinks = MyLink::all()->where('userid',$user_id);
    }

    public function getLanguages($user_id){
        return $languages = Language::all()->where('userid',$user_id);
    }

    public function getUser($user_id){
        return $user = User::all()->where('id',$user_id)->first();
    }

    public function index($user_id)
    {
        $user = $this->getUser($user_id);
        $role = $this->checkRole();
        $profileSummary = $this->getProfileSummary($user_id);
        $workExperiences = $this->getWorkExperience($user_id);
        $educations = $this->getEducation($user_id);
        $links = $this->getMyLinks($user_id);
        $skills = $this->getSkills($user_id);
        $interests = $this->getInterests($user_id);
        $languages = $this->getLanguages($user_id);
        $awardsandhonors = $this->getAwardsAndHonors($user_id);
        $data = array(
            'user' => $user,
            'role' => $role,
            'id' => $user_id,
            'profilesummary' => $profileSummary,
            'workexperiences' => $workExperiences,
            'educations' =>$educations,
            'links' => $links,
            'skills' => $skills,
            'interests' => $interests,
            'languages' => $languages,
            'awardsandhonors' => $awardsandhonors
        );
        return view('showLead')->with($data);
    }
}
