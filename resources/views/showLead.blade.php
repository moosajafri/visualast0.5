@extends('layouts.app')

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Visualast - Dashboard</title>

@section('content')
    <div style="margin-left:5%;margin-top: 6%" id="showLead">
        @if($role=='admin')
            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">User Details</div>
                <div class="panel-body">
                    @if(!empty($user))
                        <label class="control-label col-xs-offset-1" for="email">User ID: {{$id}} </label>
                        <label class="control-label col-xs-offset-1" for="email">E-mail: {{$user->email}} </label>
                        <label class="control-label col-xs-offset-1" for="email">Account Created: {{$user->created_at}} </label>
                    @else
                        <p>User not found</p>
                    @endif
                </div>
            </div>

            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">Profile Summary</div>
                <div class="panel-body">
                    @if(!empty($profilesummary))
                        <label class="control-label col-xs-offset-1" for="email">First Name: {{$profilesummary->fname}} </label>
                        <label class="control-label col-xs-offset-1" for="email">Last Name: {{$profilesummary->lname}}</label>
                        <label class="control-label col-xs-offset-1" for="email">Title: {{$profilesummary->title}}</label>
                        <label class="control-label col-xs-offset-1" for="email">Location: {{$profilesummary->location}}</label><br><br>
                        <label class="control-label col-xs-offset-1" for="email">Profile Summary: {{$profilesummary->profile_summary}}</label>
                    @else
                        <p>User has entered no details</p>
                    @endif
                </div>
            </div>

            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">Work Experience</div>
                <div class="panel-body">

                    <table class="table">
                        <thead>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Start Month</th>
                        <th>Start Year</th>
                        <th>End Month</th>
                        <th>End Year</th>
                        <th>Location</th>
                        <th>Summary</th>
                        </thead>
                        <tbody>
                        @if(!empty($workexperiences))
                            @foreach($workexperiences as $workexperience)
                                <tr>
                                    <td>{{$workexperience->title}}</td>
                                    <td>{{$workexperience->company}}</td>
                                    <td>{{$workexperience->startmonth}}</td>
                                    <td>{{$workexperience->startyear}}</td>
                                    <td>{{$workexperience->endmonth}}</td>
                                    <td>{{$workexperience->endyear}}</td>
                                    <td>{{$workexperience->location}}</td>
                                    <td>{{$workexperience->summary}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>User has entered no details</p>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">Education</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <th>School</th>
                        <th>Degree</th>
                        <th>Program of Study</th>
                        <th>Start Month</th>
                        <th>Start Year</th>
                        <th>End Month</th>
                        <th>End Year</th>
                        <th>Location</th>
                        <th>Activities</th>
                        </thead>
                        <tbody>
                        @if(!empty($educations))
                            @foreach($educations as $education)
                                <tr>
                                    <td>{{$education->school}}</td>
                                    <td>{{$education->degree}}</td>
                                    <td>{{$education->programofstudy}}</td>
                                    <td>{{$education->startmonth}}</td>
                                    <td>{{$education->startyear}}</td>
                                    <td>{{$education->endmonth}}</td>
                                    <td>{{$education->endyear}}</td>
                                    <td>{{$education->location}}</td>
                                    <td>{{$education->activities}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>User has entered no details</p>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>

            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">My Links</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <th>Category</th>
                        <th>URL</th>
                        </thead>
                        <tbody>
                        @if(!empty($links))
                            @foreach($links as $link)
                                <tr>
                                    <td>{{$link->category}}</td>
                                    <td>{{$link->url}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>User has entered no details</p>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">Skills</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <th>Skill</th>
                        <th>Years of Experience</th>
                        <th>Proficiency</th>
                        </thead>
                        <tbody>
                        @if(!empty($skills))
                            @foreach($skills as $skill)
                                <tr>
                                    <td>{{$skill->skill}}</td>
                                    <td>{{$skill->years}}</td>
                                    <td>{{$skill->proficiency}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>User has entered no details</p>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>

            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">Interests</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <th>Interest</th>
                        <th>Level of Interest</th>
                        </thead>
                        <tbody>
                        @if(!empty($interests))
                            @foreach($interests as $interest)
                                <tr>
                                    <td>{{$interest->interest}}</td>
                                    <td>{{$interest->levelofinterest}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>User has entered no details</p>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>

            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">Languages</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <th>Language</th>
                        <th>Proficiency</th>
                        </thead>
                        <tbody>
                        @if(!empty($languages))
                            @foreach($languages as $language)
                                <tr>
                                    <td>{{$language->language}}</td>
                                    <td>{{$language->proficiency}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>User has entered no details</p>
                        @endif
                        </tbody>
                    </table>


                </div>
            </div>

            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize panel-heading">Awards &amp; Honors</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <th>Title</th>
                        <th>Year Received</th>
                        <th>Importance</th>
                        </thead>
                        <tbody>
                        @if(!empty($awardsandhonors))
                            @foreach($awardsandhonors as $awardandhonor)
                                <tr>
                                    <td>{{$awardandhonor->title}}</td>
                                    <td>{{$awardandhonor->yearreceived}}</td>
                                    <td>{{$awardandhonor->importance}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>User has entered no details</p>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        @endif
        @if($role!='admin')
            {{abort(404)}}
        @endif
    </div>

@endsection