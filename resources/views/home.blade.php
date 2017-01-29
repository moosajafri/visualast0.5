@extends('layouts.app')

@section('content')
    <style type="text/css">
        .borderless td, .borderless th {
            border: none;
        }
    </style>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />



    <script>
        if(window.jQuery)
        {
            $( document ).ready(function() {
                getProfileSummaryAjax();
                getWorkExperienceAjax();
                getEducationAjax();
                getMyLinksAjax();
                //$("#testbtn").click();
//ADd your Ajax GET functions here!


//Dropdowns Year Population Code. 
                var current_year= (new Date().getFullYear()).toString();
                current_year=parseInt(current_year);
                var x=current_year;

                for(x=current_year;x>1949;x--){
                    $('.StartYear').append($('<option>', {
                        value: x,
                        text: x
                    }));

                    $('.EndYear').append($('<option>', {
                        value: x,
                        text: x
                    }));

                }

//insert work experience to DB
                $("#btnSubmitWorkExperience").click(function(event){
                    if($("#workExperienceForm")[0].checkValidity()) {
                        //If New Mode
                        if($("#workExperienceAddOrEdit").val()=="-1"){
                            var paramaters = "title=" + $("#workExperienceTitle").val()
                                +"&company=" + encodeURIComponent($("#workExperienceCompany").val())
                                + "&startmonth=" + encodeURIComponent($("#workExperienceStartMonth").val())
                                + "&startyear=" + encodeURIComponent($("#workExperienceStartYear").val());
                                if( $("#chkBoxIsCurrent").attr("checked",true) ){
                                      paramaters=paramaters   + "&endmonth="+ encodeURIComponent("-1")
                                    + "&endyear=" + encodeURIComponent("-1");
                                }else{
                                    paramaters= paramaters+ "&endmonth="+ encodeURIComponent($("#workExperienceEndMonth").val())
                                    + "&endyear=" + encodeURIComponent($("#workExperienceEndYear").val());  
                                }
                                paramaters=paramaters + "&location=" + encodeURIComponent($("#workExperienceLocation").val())
                                + "&summary=" + encodeURIComponent($("#workExperienceSummary").val());
                        $.ajax({
                            url: "HomeController/insertWorkExperience?" + paramaters,
                            type: 'GET',
                            success: function(data) {
                                getWorkExperienceAjax();
                            },
                            error: function(xhr, status, error) {
                            }
                        });
                        }else{
                            //If Edit Mode
                                var paramaters = "title=" + $("#workExperienceTitle").val()
                                +"&company=" + encodeURIComponent($("#workExperienceCompany").val())
                                + "&startmonth=" + encodeURIComponent($("#workExperienceStartMonth").val())
                                + "&startyear=" + encodeURIComponent($("#workExperienceStartYear").val());
                                
                                if( $("#chkBoxIsCurrent").attr("checked",true) ){
                                      paramaters=paramaters   + "&endmonth="+ encodeURIComponent("-1")
                                    + "&endyear=" + encodeURIComponent("-1");
                                    
                                }else{
                                    paramaters= paramaters+ "&endmonth="+ encodeURIComponent($("#workExperienceEndMonth").val())
                                    + "&endyear=" + encodeURIComponent($("#workExperienceEndYear").val());  
                                }
                                paramaters=paramaters + "&location=" + encodeURIComponent($("#workExperienceLocation").val())
                                + "&summary=" + encodeURIComponent($("#workExperienceSummary").val());
                        
                        $.ajax({
                            url: "HomeController/editWorkExperience?" + paramaters,
                            type: 'GET',
                            success: function(data) {
                                //alert("success" + data.status);
                                getWorkExperienceAjax();
                            },
                            error: function(xhr, status, error) {
                                //alert(xhr.responseText);
                            }
                        });
                        }
                    }else{
                        console.log("invalid form");
                        alert("Missing/ Wrong information, please correct.");
                    }
                });
                
                //insert Education to DB
                $("#btnSubmitEducation").click(function(event){
                    if($("#educationForm")[0].checkValidity()) {
                        //If New Mode
                        if($("#educationAddOrEdit").val()=="-1"){
                            var paramaters = "?school=" + $("#educationSchool").val()
                                +"&degree=" + $("#educationDegree").val()
                                + "&programofstudy=" + $("#educationProgramOfStudy").val()
                                + "&startmonth=" + $("#educationStartMonth").val()
                                + "&startyear=" + $("#educationStartYear").val()
                                + "&endmonth="+ $("#educationEndMonth").val()
                                + "&endyear=" + $("#educationEndYear").val()
                                + "&location=" + $("#educationLocation").val()
                                + "&activities=" + $("#educationActivities").val();

                            $.ajax({
                            url: "HomeController/insertEducation" + paramaters,
                            type: 'GET',
                            success: function(data) {
                                //alert("success" + data.status);
                                getEducationAjax();
                            },
                            error: function(xhr, status, error) {
                            }
                            });
                           }else{
                            //If Edit Mode
                                var paramaters = "?school=" + $("#educationSchool").val()
                                +"&degree=" + $("#educationDegree").val()
                                + "&programofstudy=" + $("#educationProgramOfStudy").val()
                                + "&startmonth=" + $("#educationStartMonth").val()
                                + "&startyear=" + $("#educationStartYear").val()
                                + "&endmonth="+ $("#educationEndMonth").val()
                                + "&endyear=" + $("#educationEndYear").val()
                                + "&location=" + $("#educationLocation").val()
                                + "&activities=" + $("#educationActivities").val();
                        
                                $.ajax({
                                    url: "HomeController/editEducation?" + paramaters,
                                    type: 'GET',
                                    success: function(data) {
                                        getEducationAjax();
                                    },
                                    error: function(xhr, status, error) {
                                        //alert(xhr.responseText);
                                    }
                                });
                            }
                        }else{
                            console.log("invalid form");
                            alert("Missing/ Wrong information, please correct.");
                        }
                });
                     

//inserting My Link to DB
                $("#btnSubmitMyLinks").click(function(event){

                    if($("#myLinksForm")[0].checkValidity()) {
             
if($("#educationAddOrEdit").val()=="-1"){
                        var paramaters = "?category=" + $("#myLinksCategory").val()+"&url=" + $("#myLinksURL").val();
                        $.ajax({
                            url: "HomeController/insertMyLinks" + paramaters,
                            type: 'GET',
                            success: function(data) {
                                // alert("success" + data.status);
                                getMyLinksAjax();
                            },
                            error: function(xhr, status, error) {
                            }
                        });
                        }else{
                              var paramaters = "?category=" + $("#myLinksCategory").val()+"&url=" + $("#myLinksURL").val();
                                                $.ajax({
                                                    url: "HomeController/editMyLink" + paramaters,
                                                    type: 'GET',
                                                    success: function(data) {
                                                        // alert("success" + data.status);
                                                        getMyLinksAjax();
                                                    },
                                                    error: function(xhr, status, error) {
                                                    }
                                                });
                        }
                    }else{
                        console.log("invalid form");
                        alert("Missing/ Wrong information, please correct.");
                    }
                });

//inserting Skills in DB
                $("#btnSubmitSkills").click(function(event){

                    if($("#skillsForm")[0].checkValidity()) {

                        //your form execution code
                        var paramaters = "?skill=" + $("#skillsSkill").val()
                                +"&years=" + $("#skillsYears").val()
                                +"&proficiency=" + $("#skillsProficiency").val();
                        $.ajax({
                            url: "HomeController/insertSkills" + paramaters,
                            type: 'GET',
                            success: function(data) {
                                getSkillsAjax();
                            },
                            error: function(xhr, status, error) {
                            }
                        });
                    }else{
                        console.log("invalid form");
                        alert("Missing/ Wrong information, please correct.");
                    }
                });

//inserting interests in DB
                $("#btnSubmitInterests").click(function(event){

                    if($("#interestsForm")[0].checkValidity()) {

                        //your form execution code
                        var paramaters = "?interest=" + $("#interestsInterest").val()
                                +"&levelofinterest=" + $("#interestsLevelOfInterest").val();
                        $.ajax({
                            url: "HomeController/insertInterests" + paramaters,
                            type: 'GET',
                            success: function(data) {
                                //alert("success" + data.status);
                                getInterestsAjax();
                            },
                            error: function(xhr, status, error) {
                            }
                        });
                    }else{
                        console.log("invalid form");
                        alert("Missing/ Wrong information, please correct.");
                    }
                });

//inserting languages into DB
                $("#btnSubmitLanguages").click(function(event){

                    if($("#languagesForm")[0].checkValidity()) {

                        //your form execution code
                        var paramaters = "?language=" + $("#languagesLanguage").val()
                                +"&proficiency=" + $("#languagesProficiency").val();
                        $.ajax({
                            url: "HomeController/insertLanguages" + paramaters,
                            type: 'GET',
                            success: function(data) {
                                //alert("success" + data.status);
                                getLanguagesAjax();
                            },
                            error: function(xhr, status, error) {
                                //  
                                //  alert('error');
                            }
                        });
                    }else{
                        console.log("invalid form");
                        alert("Missing/ Wrong information, please correct.");
                    }
                });

//inserting awardsandhonors in DB
                $("#btnSubmitAwardsAndHonors").click(function(event){

                    if($("#awardsAndHonorsForm")[0].checkValidity()) {

                        //your form execution code
                        var paramaters = "?title=" + $("#awardsAndHonorsTitle").val()
                                +"&importance=" + $("#awardsAndHonorsRankOfImportance").val()
                                +"&yearreceived=" + $("#awardsAndHonorsYearReceived").val();
                        $.ajax({
                            url: "HomeController/insertAwardsAndHonors" + paramaters,
                            type: 'GET',
                            success: function(data) {
                                //alert("success" + data.status);
                                getAwardsAndHonorsAjax();
                            },
                            error: function(xhr, status, error) {
                                //
                                //alert('error');
                            }
                        });
                    }else{
                        console.log("invalid form");
                        alert("Missing/ Wrong information, please correct.");
                    }
                });
            });



            function downloadasimage(){
                html2canvas($('#downloaddiv'),
                        {
                            onrendered: function (canvas) {
                                //  canvas.setAttribute('width', 100);
                                //  canvas.setAttribute('height', 100);
                                var a = document.createElement('a');
                                // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
                                a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
                                a.download = 'somefilename.jpg';
                                a.click();
                            }
                        });
            }


            function toggleMenu(){
                if(window.minimized == false){
                    var elem = document.getElementById("menu-toggle");
                    elem.style.left = 0;
                    elem.style.outline="none";
                    document.getElementById("menu-toggle").innerHTML=">>";
                    window.minimized=true;
                }
                else{
                    var elem = document.getElementById("menu-toggle");
                    var pos = 0;
                    var id = setInterval(frame,5);
                    function frame() {
                        if (pos == 24.5 ) {
                            clearInterval(id);
                        } else {
                            pos+=0.5;
                            elem.style.left = pos + '%';
                        }
                    }
                    document.getElementById("menu-toggle").innerHTML="<<";
                    window.minimized=false;
                }
                //e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            }



            function addNewWorkExperience(){
                $("#btnSubmitWorkExperience").html("Add");
                $("#workExperienceAddOrEdit").val("-1");
                $("#workExperienceForm")[0].reset();
                show(workExperienceForm);
                $('#workExperience').animate({ scrollTop: 0 }, 'slow');
                //$('#workExperienceForm:third *:input[type!=hidden]:third').focus();
                $('#workExperienceForm input:text:visible:first').focus();
            }

           function addNewEducation(){
                $("#btnSubmitEducation").html("Add");
                $("#educationAddOrEdit").val("-1");
                $("#educationForm")[0].reset();
                show(educationForm);
                $('#Education').animate({ scrollTop: 0 }, 'slow');
                //$('#workExperienceForm:third *:input[type!=hidden]:third').focus();
                $('#educationForm input:text:visible:first').focus();
            }


           function addNewMyLink(){
                $("#btnSubmitMyLinks").html("Add");
                $("#myLinksAddOrEdit").val("-1");
                $("#myLinksForm")[0].reset();
                show(myLinksForm);
                $('#myLinks').animate({ scrollTop: 0 }, 'slow');
                //$('#workExperienceForm:third *:input[type!=hidden]:third').focus();
                $('#myLinksForm input:text:visible:first').focus();
            }



            function chkboxIsCurentClick(obj){
                if(obj.checked) {
                    $("#workExperienceEndYear").val("-1").change();
                    $("#workExperienceEndYear").attr("disabled", true);
                    $("#workExperienceEndMonth").val("-1").change();
                    $("#workExperienceEndMonth").attr("disabled", true);
                }else{
                    $("#workExperienceEndYear").attr("disabled", false);
                    $("#workExperienceEndMonth").attr("disabled", false);
                }
            }


            function getProfileSummaryAjax(){
                var paramaters="";
                $.ajax({
                    url: "HomeController/getProfileSummary?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                         var fname="First Name",lname="Last Name",title="Title",location="Location",profilesummary="Profile Summary",email="example@example.com",website="www.example.com",phoneno="111-1111-1111";
                        if(data.fname!= undefined){
                            fname=data.fname;
                            //$("#username").text(data.title +" "+data.fname+ " " + data.lname);
                        }
                        if(data.lname!= undefined){
                            lname=data.lname;
                        }
                        if(data.title!= undefined){
                            title=data.title;
                        }
                        if(data.location!= undefined){
                            location=data.location;
                        }
                        if(data.profile_summary!= undefined){
                            profilesummary=data.profile_summary;
                        }
                        if(data.email!= undefined){
                            email=data.email;
                        }
                        if(data.website!= undefined){
                            website=data.website;
                        }
                        if(data.phoneno!= undefined){
                            phoneno=data.phoneno;
                        }


                        //populate resume template fields
                        $("#userprofileSummary").text(data.profile_summary);
                        $("#username").text(title + " " + fname + " " + lname);
                        $("#userEmail").text(email);
                        $("#userWebsite").text(website);
                        $("#userPhoneNo").text(phoneno);


                        //populate side bar fields
                        $("#profileSummaryFirstName").val(fname);
                        $("#profileSummaryLastName").val(lname);
                        $("#profileSummaryTitle").val(title);
                        $("#profileSummaryLocation").val(location);
                        $("#profileSummaryProfileSummary").val(profilesummary);
                        $("#profileSummaryEmail").val(email);
                        $("#profileSummaryWebsite").val(website);
                        $("#profileSummaryPhoneNo").val(phoneno);

                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            function deleteWorkExperienceAjax(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/deleteWorkExperience?" + paramaters,
                    type: 'GET',
                    success: function(data) {

                        //load data in modal.

                        getWorkExperienceAjax();
                        //updateWorkExperienceAjax(data[0].id);
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            //delete Education
            function deleteEducationAjax(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/deleteEducation?" + paramaters,
                    type: 'GET',
                    success: function(data) {

                        //load data in modal.
                        getEducationAjax();
                        //updateWorkExperienceAjax(data[0].id);
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            //delete My Links
            function deleteMyLinkAjax(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/deleteMyLinks?" + paramaters,
                    type: 'GET',
                    success: function(data) {

                        //load data in modal.
                        getMyLinksAjax();
                        //updateWorkExperienceAjax(data[0].id);
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            //delete Skills
            function deleteSkillsAjax(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/deleteSkills?" + paramaters,
                    type: 'GET',
                    success: function(data) {

                        //load data in modal.
                        getSkillsAjax();
                        //updateWorkExperienceAjax(data[0].id);
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            //delete Interests
            function deleteInterestsAjax(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/deleteInterests?" + paramaters,
                    type: 'GET',
                    success: function(data) {

                        //load data in modal.
                        getInterestsAjax();
                        //updateWorkExperienceAjax(data[0].id);
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            //delete Languages
            function deleteLanguagesAjax(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/deleteLanguages?" + paramaters,
                    type: 'GET',
                    success: function(data) {

                        //load data in modal.
                        getLanguagesAjax();
                        //updateWorkExperienceAjax(data[0].id);
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            //delete awards and honors
            function deleteAwardsAndHonorsAjax(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/deleteAwardsAndHonors?" + paramaters,
                    type: 'GET',
                    success: function(data) {

                        //load data in modal.
                        getAwardsAndHonorsAjax();
                        //updateWorkExperienceAjax(data[0].id);
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }




            function editWorkExperiencePopulateForm(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/editWorkExperiencePopulateForm?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        //load data in modal.
                        $("#workExperienceTitle").val(data[0].title);
                        $("#workExperienceCompany").val(data[0].company);
                        $("#workExperienceStartMonth").val(data[0].startmonth);
                        $("#workExperienceStartYear").val(data[0].startyear);
                        
                        if(data[0].endmonth!= undefined){
                                if(data[0].endmonth == "-1"){
                                    $('#chkBoxIsCurrent').prop('checked', true);
                                    $("#chkBoxIsCurrent").click();
                                }else{
                                    $("#workExperienceEndMonth").val(data[0].endmonth);
                                    $("#workExperienceEndYear").val(data[0].endyear);            
                                }
                                 
                            }
                                
                        $("#workExperienceLocation").val(data[0].location);
                        $("#workExperienceSummary").val(data[0].summary);
                        $("#workExperienceAddOrEdit").val(data[0].id);
                        show(workExperienceForm);
                        $('#workExperienceForm input:text:visible:first').focus();
                        $("#btnSubmitWorkExperience").html("Update");
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            function editEducationPopulateForm(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/editEducationPopulateForm?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        //load data in modal.
                        $("#educationSchool").val(data[0].school);
                        $("#educationDegree").val(data[0].degree);
                        $("#educationProgramOfStudy").val(data[0].programofstudy);
                        $("#educationStartMonth").val(data[0].startmonth);
                        $("#educationStartYear").val(data[0].startyear);
                        $("#educationEndMonth").val(data[0].endmonth);
                        $("#educationEndYear").val(data[0].endyear);
                        $("#educationLocation").val(data[0].location);
                        $("#educationActivities").val(data[0].activities);

                        if(data[0].endmonth!= undefined){
                                if(data[0].endmonth == "-1"){
                                    $('#chkBoxIsCurrent').prop('checked', true);
                                    $("#chkBoxIsCurrent").click();
                                }else{
                                    $("#workExperienceEndMonth").val(data[0].endmonth);
                                    $("#workExperienceEndYear").val(data[0].endyear);
                                }
                                 
                            }
                                
                        show(educationForm);
                        $('#educationForm input:text:visible:first').focus();
                        $("#btnSubmitEducation").html("Update");
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }


function editMyLinkPopulateForm(exp_id){
                var id=exp_id;
                var paramaters = "id=" + id;
                $.ajax({
                    url: "HomeController/editMYLinkPopulateForm?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        //load data in modal.
                        $("#myLinksURL").val(data[0].url);
                        $("#myLinksCategory").val(data[0].category);
                        show(myLinksForm);
                        $('#myLinksForm input:text:visible:first').focus();
                        $("#btnSubmitMyLinks").html("Update");
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }





            function getWorkExperienceAjax(){
                var paramaters="";
                $.ajax({
                    url: "HomeController/getWorkExperience?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        //Empty everything before repopulating
                        $("#workExperienceDiv").html(""); //TEmplate Div
                        $("#workExperienceModalTable").find('tbody').html(""); //Modal Div
                        var i=0;
                        for(i=0;i<data.length;i++){
                            var title,company,startmonth,startyear,endmonth,endyear,location,summary;
                            if(data[i].title!= undefined){
                                title=data[i].title;
                                //this is the Table population code present in modal.
                                var rowToAppend= '<tr id="workexperience_'+data[i].id+'">'+
                                        '<td style="width:20%">'+ data[i].title + ' at ' + data[i].company +'</td>'+
                                        '<td style="width:20%" onclick=editWorkExperiencePopulateForm("'+data[i].id+'")><span class="glyphicon glyphicon-pencil"></span></td>'+
                                        '<td style="width:20%" onclick=deleteWorkExperienceAjax("'+data[i].id+'")><span class="glyphicon glyphicon-trash"></span></td></tr>';
                                $("#workExperienceModalTable").find('tbody').prepend(rowToAppend);
                            }
                            if(data[i].company!= undefined){
                                company=data[i].company;
                            }
                            if(data[i].startmonth!= undefined){
                                startmonth=data[i].startmonth;
                            }
                            if(data[i].startyear!= undefined){
                                startyear=data[i].startyear;
                            }
                            if(data[i].endmonth!= undefined){
                                if(data[i].endmonth== "-1" && $("#workExperienceAddOrEdit").val() != "-1"){
                                    $('#chkBoxIsCurrent').prop('checked', true);
                                    $("#chkBoxIsCurrent").click();
                                }
                                if(data[i].endmonth== "-1"){
                                    var d = new Date();
                                    switch (new Date().getMonth()) {
                                        case 0:
                                            endmonth = "January";
                                            break;
                                        case 1:
                                            endmonth = "February";
                                            break;
                                        case 2:
                                            endmonth = "March";
                                            break;
                                        case 3:
                                            endmonth = "April";
                                            break;
                                        case 4:
                                            endmonth = "May";
                                            break;
                                        case 5:
                                            endmonth = "June";
                                            break;
                                        case 6:
                                            endmonth = "July";
                                            break;
                                        case 6:
                                            endmonth = "August";
                                            break;
                                        case 6:
                                            endmonth = "September";
                                            break;
                                        case 6:
                                            endmonth = "October";
                                            break;
                                        case 6:
                                            endmonth = "November";
                                            break;
                                        case 6:
                                            endmonth = "December";
                                            break;
                                        default:
                                            break; 
                                    }
                                    
                                }else{
                                    endmonth=data[i].endmonth;    
                                }
                                 
                            }
                            if(data[i].endyear!= undefined){
                                  if(data[i].endyear== "-1"){
                                    var d = new Date();
                                    endyear = d.getFullYear();
                                }else{
                                    endyear=data[i].endyear;    
                                }
                                
                            }
                            if(data[i].location!= undefined){
                                location=data[i].location;
                            }
                            if(data[i].summary!= undefined){
                                summary=data[i].summary;
                            }

                            //To append in resume.
                            var toAppendHTMLResume='<article id="resumeWorkExperience_'+data[i].id+'">'+
                                    '<h2>'+title+' at '+company+ ', '+location + '</h2>'+
                                    '<p class="subDetails">'+startmonth +" " + startyear +' - '+ endmonth +" " + endyear  +'</p>'+
                                    '<p>'+summary+'</p>'+
                                    '</article>'
                            $("#workExperienceDiv").append(toAppendHTMLResume);

                            var toAppendHTMLModal = "";

                        }


                        $('#workExperience').animate({ scrollTop: 0 }, 'slow');

                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }


            function getEducationAjax(){
                var paramaters="";
                $.ajax({
                    url: "HomeController/getEducation?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        //Empty everything before repopulating
                        $("#educationDiv").html(""); //TEmplate Div
                        $("#educationModalTable").find('tbody').html(""); //Modal Div
                        var i=0;
                        for(i=0;i<data.length;i++){
                            var school,degree,programofstudy,startmonth,startyear,endmonth,endyear,location,activities;
                            if(data[i].school!= undefined){
                                school=data[i].school;
                                //this is the Table population code present in modal.
                                var rowToAppend= '<tr id="education_'+data[i].id+'">'+
                                        '<td style="width:20%">'+ data[i].degree + ' at ' + data[i].school +'</td>'+
                                        '<td style="width:20%" onclick=editEducationPopulateForm("'+data[i].id+'")><span class="glyphicon glyphicon-pencil"></span></td>'+
                                        '<td style="width:20%" onclick=deleteEducationAjax("'+data[i].id+'")><span class="glyphicon glyphicon-trash"></span></td></tr>';
                                $("#educationModalTable").find('tbody').prepend(rowToAppend);
                            }
                            if(data[i].degree!= undefined){
                                degree=data[i].degree;
                            }
                            if(data[i].programofstudy!= undefined){
                                programofstudy=data[i].programofstudy;
                            }
                            if(data[i].startmonth!= undefined){
                                startmonth=data[i].startmonth;
                            }
                            if(data[i].startyear!= undefined){
                                startyear=data[i].startyear;
                            }
                            if(data[i].endmonth!= undefined){
                                endmonth=data[i].endmonth;
                            }
                            if(data[i].endyear!= undefined){
                                endyear=data[i].endyear;
                            }
                            if(data[i].location!= undefined){
                                location=data[i].location;
                            }
                            if(data[i].activities!= undefined){
                                activities=data[i].activities;
                            }
                            //To append in resume.
                            var toAppendHTMLResume='<article id="resumeEducation_'+data[i].id+'">'+
                                    '<h2>'+degree+' - '+school+ ', '+location + '</h2>'+
                                    '<p class="subDetails">'+startmonth +" " + startyear +' - '+ endmonth +" " + endyear  +'</p>'+
                                    '<p>'+activities+'</p>'+
                                    '</article>'
                            $("#educationDiv").append(toAppendHTMLResume);
                            var toAppendHTMLModal = "";
                        }
                        $('#education').animate({ scrollTop: 0 }, 'slow');
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
                }


 function getMyLinksAjax(){
                var paramaters="";
                $.ajax({
                    url: "HomeController/getMyLinks?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        
                        //Empty everything before repopulating
                        $("#myLinksResumeTable").find('tbody').html(""); //TEmplate Div
                        $("#myLinksModalTable").find('tbody').html(""); //Modal Div
                        var i=0;
                        for(i=0;i<data.length;i++){
                          var url,category;
                            if(data[i].url!= undefined){
                                url=data[i].url;
                                //this is the Table population code present in modal.
                                var rowToAppend= '<tr id="mylink_'+data[i].id+'">'+
                                        '<td style="width:20%">'+ data[i].category + ' : ' + data[i].url +'</td>'+
                                        '<td style="width:20%" onclick=editMyLinkPopulateForm("'+data[i].id+'")><span class="glyphicon glyphicon-pencil"></span></td>'+
                                        '<td style="width:20%" onclick=deleteMyLinkAjax("'+data[i].id+'")><span class="glyphicon glyphicon-trash"></span></td></tr>';
                                $("#myLinksModalTable").find('tbody').prepend(rowToAppend);
                            }
                            if(data[i].category!= undefined){
                                category=data[i].category;
                            }
                            if(data[i].url!= undefined){
                                url=data[i].url;
                            }
                            //To append in resume.
                               
                            //resume from here.

                            var toAppendHTMLResume='<tr id=url_'+data[i].id+'>'+
                            '<td>'+category+'</td>'+
                            '<td><a href="'+url+'">'+url+'</a></td>'+
                            '</tr>';

                       $("#myLinksResumeTable").find('tbody').prepend(toAppendHTMLResume);
                            var toAppendHTMLModal = "";
                        }
                        $('#education').animate({ scrollTop: 0 }, 'slow');
                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
                }


            function setProfileSummary(){

                var paramaters = "fname=" + $("#profileSummaryFirstName").val()
                        +"&lname=" + $("#profileSummaryLastName").val()
                        + "&title=" + $("#profileSummaryTitle").val()
                        + "&location=" + $("#profileSummaryLocation").val()
                        + "&psummary="+ $("#profileSummaryProfileSummary").val()
                        + "&profileSummaryEmail=" + $("#profileSummaryEmail").val()
                        + "&profileSummaryWebsite=" + $("#profileSummaryWebsite").val()
                        + "&profileSummaryPhoneNo=" + $("#profileSummaryPhoneNo").val();

                $.ajax({
                    url: "HomeController/insertProfileSummary?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        //alert("success" + data.status);
                        getProfileSummaryAjax();

                    },
                    error: function(xhr, status, error) {
                        //alert(xhr.responseText);
                    }
                });
            }

            window.minimized = false;
            $("#menu-toggle").click(function(e) {

                if(window.minimized == false){
                    var elem = document.getElementById("menu-toggle");
                    elem.style.left = 0;
                    elem.style.outline="none";
                    document.getElementById("menu-toggle").innerHTML=">>";
                    window.minimized=true;
                }
                else{
                    var elem = document.getElementById("menu-toggle");
                    var pos = 0;
                    var id = setInterval(frame,5);
                    function frame() {
                        if (pos == 24.5 ) {
                            clearInterval(id);
                        } else {
                            pos+=0.5;
                            elem.style.left = pos + '%';
                        }
                    }
                    document.getElementById("menu-toggle").innerHTML="<<";
                    window.minimized=false;
                }

                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            function showProfile() {
                document.getElementById("profilebanner").style.transition = "display 3s";
                document.getElementById("themesBtn").style.color="#999999";
                // document.getElementById("stylesBtn").style.color="#999999";
                // document.getElementById("topicsBtn").style.color="#999999";
                document.getElementById("profileBtn").style.color="white";
                document.getElementById("profilebanner").style.display="block";
                document.getElementById("themebanner").style.display="none";
                //document.getElementById("stylebanner").style.display="none";
                // document.getElementById("topicbanner").style.display="none";
            }

            function showThemes() {
                document.getElementById("themesBtn").style.color="white";
                // document.getElementById("stylesBtn").style.color="#999999";
                // document.getElementById("topicsBtn").style.color="#999999";
                document.getElementById("profileBtn").style.color="#999999";
                document.getElementById("profilebanner").style.display="none";
                document.getElementById("themebanner").style.display="block";
                // document.getElementById("stylebanner").style.display="none";
                // document.getElementById("topicbanner").style.display="none";

            }

//    function showStyles() {
//        document.getElementById("themesBtn").style.color="#999999";
//        document.getElementById("stylesBtn").style.color="white";
//        document.getElementById("topicsBtn").style.color="#999999";
//        document.getElementById("profileBtn").style.color="#999999";
//        document.getElementById("profilebanner").style.display="none";
//        document.getElementById("themebanner").style.display="none";
//        document.getElementById("stylebanner").style.display="block";
//        document.getElementById("topicbanner").style.display="none";
//    }
//
//    function showTopics() {
//        document.getElementById("themesBtn").style.color="#999999";
//        document.getElementById("stylesBtn").style.color="#999999";
//        document.getElementById("topicsBtn").style.color="white";
//        document.getElementById("profileBtn").style.color="#999999";
//        document.getElementById("profilebanner").style.display="none";
//        document.getElementById("themebanner").style.display="none";
//        document.getElementById("stylebanner").style.display="none";
//        document.getElementById("topicbanner").style.display="block";
//    }

            function show(idOfElement){
                idOfElement.style.display="block";
            }

            function hide(idOfElement){
                idOfElement.style.display="none";
            }


        }
    </script>
    <div style="margin-top: 4%;" id="wrapper">
        <!-- Sidebar -->
        <button style="z-index:10;position:absolute;left:330px;,margin:20px;top:50px;" onclick="javascript:toggleMenu();" class="grad" id="menu-toggle"><<</button>
        <div class="sidebar-wrapper">

            <ul style="margin-left: 20px;" class="sidebar-nav">
                <li style="margin-left: -55px" class="sidebar-brand">
                    <a id="profileBtn" style="color:white;display: inline-block" href="#" onclick="showProfile()">
                        Profile
                    </a>
                    <a id="themesBtn" style="display: inline-block" href="#" onclick="showThemes()">
                        Themes
                    </a>
                    <!-- NOT INCLUDING THESE AS OF NOW
                    <a id="stylesBtn" style="display: inline-block" href="#" onclick="showStyles()">
                        Styles
                    </a>
                    <a id="topicsBtn" style="display: inline-block" href="#" onclick="showTopics()">
                        Topics
                    </a>
                    -->
                </li>
            </ul>
            <ul id="profilebanner" style="margin-top:50px;margin-left: 20px;" class="sidebar-nav">
                <h2 style="color: white">My Profile</h2>
                <h5 style="color: whitesmoke">Edit your data</h5>
                <h4 style="color: navajowhite">My Data</h4>
                <li>
                    <div>
                        <span>Profile Summary<button data-toggle="modal" data-target="#profileSummary" data-backdrop="static" style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                    </div>
                </li>
                <li>
                    <div>
                        <span>Work Experience<button data-toggle="modal" data-target="#workExperience" data-backdrop="static" style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                    </div>
                </li>
                <li>
                    <div>
                        <span>Education<button data-toggle="modal" data-target="#education" data-backdrop="static" style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                    </div>
                </li>
                <li>
                    <div>
                        <span>My Links<button data-toggle="modal" data-target="#myLinks" data-backdrop="static" style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                    </div>
                </li>
                <li>
                    <div>
                        <input style="margin-right: 10px;" type="checkbox"><span>Skills<button data-toggle="modal" data-target="#skills" data-backdrop="static" style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                    </div>
                </li>
                <li>
                    <div>
                        <input style="margin-right: 10px;" type="checkbox"><span>Interests<button data-toggle="modal" data-target="#interests" data-backdrop="static" style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                    </div>
                </li>
                <li>
                    <div>
                        <input style="margin-right: 10px;" type="checkbox"><span>Languages<button data-toggle="modal" data-target="#languages" data-backdrop="static" style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                    </div>
                </li>
                <li>
                    <div>
                        <input style="margin-right: 10px;" type="checkbox"><span>Awards & Honors<button data-toggle="modal" data-target="#awardsAndHonors" data-backdrop="static" style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                    </div>
                </li>
                <li style="float: bottom;">
                    <button class="grad btn" style="width:120px;margin-left:20px;float: left"><b>Save</b></button>
                    <button class="grad btn" style="width:120px;margin-right:50px;float: right"><b>Cancel</b></button>
                </li>
            </ul>

            <ul id="themebanner" style="display:none;margin-top:50px;margin-left: 20px;" class="sidebar-nav">
                <h2 style="color: white">Themes</h2>
                <h5 style="color: whitesmoke">Click on a theme to preview . . . </h5>
                <li>
                    <div style="position:relative;margin-bottom:10px;width: 150px;height: 150px;">
                        Hello i am theme
                        <div style="position: absolute;bottom:0px;">Theme name</div>
                    </div>
                </li>

                <li>
                    <div style="position:relative;margin-bottom:10px;width: 150px;height: 150px;">
                        Hello i am theme
                        <div style="position: absolute;bottom:0px;">Theme name</div>
                    </div>
                </li>

                <li style="margin-bottom: 100px;">
                    <button class="grad btn" style="width:120px;margin-left:20px;float: left"><b>Save</b></button>
                    <button class="grad btn" style="width:120px;margin-right:50px;float: right"><b>Cancel</b></button>

                </li>
                </li>
            </ul>
            <!-- NOT INCLUDING THIS AS OF NOW
                <ul id="stylebanner" style="display:none;margin-top:50px;margin-left: 20px;" class="sidebar-nav">
                    <button>Colors</button>
                    <button>Fonts</button>
                    <button>Background</button>
                </ul>

                <ul id="topicbanner" style="display:none;margin-top:50px;margin-left: 20px;" class="sidebar-nav">
                    <h2 style="color: white">My Profile</h2>
                    <h5 style="color: whitesmoke">Edit your data</h5>
                    <h4 style="color: navajowhite">My Data</h4>
                    <li>
                        <div>
                            <span>Profile Summary<button style="height:40px;float: right" class="grad btn"><b style="color: black">Edit</b></button></span>
                        </div>
                    </li>
                </ul>
                -->
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div style="color: white;margin-left: 10%;margin-right: 10%">
                    <label>This theme is premium. Pay to access</label><br>
                    <a href="/buy/23" style="margin-top:1%;width:40%" class="btn btn-default">Buy This Theme For { {theme price here} }</a>
                    <button style="float: right" onclick="downloadasimage()" class="btn btn-info center-block" id="dlimg">Download Resume As Image</button>
                </div>
                <div class="row">
                    <div class="col-lg-12" id="downloaddiv">
                        <!--theme starts here-->
                        <div id="cv" class="instaFade">
                            <div class="mainDetails">
                                <div id="headshot" class="quickFade">
                                    <img    src="{!! URL::to('/images/moosa.jpg') !!}" alt="Display Photo" />
                                </div>

                                <div >
                                    <h1 class="quickFade delayTwo" id="username">Joe Bloggs</h1><br>
                                    <h2 class="quickFade delayThree" id="userprofileSummary"> Job Title</h2>
                                </div>

                                <div id="contactDetails" class="quickFade delayFour">
                                    <ul>
                                        <li id="userEmail"></li>
                                        <li id="userWebsite"></li>
                                        <li id="userPhoneNo"></li>
                                    </ul>
                                </div>
                                <div class="clear"></div>
                            </div>


                            <div id="mainArea" class="quickFade delayFive">



                                <section>
                                    <div class="sectionTitle">
                                        <h1>Work Experience</h1>
                                    </div>

                                    <div class="sectionContent" id="workExperienceDiv">

                                    </div>
                                    <div class="clear"></div>
                                </section>

                                <section>
                                    <div class="sectionTitle">
                                        <h1>Education</h1>
                                    </div>

                                    <div class="sectionContent" id="educationDiv">
                                        <article>
                                            <h2>College/University</h2>
                                            <p class="subDetails">Qualification</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim.</p>
                                        </article>

                                        <article>
                                            <h2>College/University</h2>
                                            <p class="subDetails">Qualification</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim.</p>
                                        </article>
                                    </div>
                                    <div class="clear"></div>
                                </section>

                                   <section>
                                    <div class="sectionTitle">
                                        <h1>Key Skills</h1>
                                    </div>

                                    <div class="sectionContent" id="skillsDiv">
                                        <ul class="keySkills">
                                            <li>A Key Skill</li>
                                            <li>A Key Skill</li>
                                            <li>A Key Skill</li>
                                            <li>A Key Skill</li>
                                            <li>A Key Skill</li>
                                            <li>A Key Skill</li>
                                            <li>A Key Skill</li>
                                            <li>A Key Skill</li>
                                        </ul>
                                    </div>
                                    <div class="clear"></div>
                                </section>

                                <section>
                                    <div class="sectionTitle">
                                        <h1>Links</h1>
                                    </div>

                                    <div class="sectionContent" id="myLinksDiv">
                                    <article>
                                        
                                    
                                        <div class="container" style="width:100%;" id="myLinksResumeTable">
                                            <table class="table table-hover">
                                            <thead>
                                            <tr>
                                            <th style="width:70%">Category</th>
                                            <th style="width:30%">Link </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            </table>
                                            </div>
                                    </article>

                                    </div>
                                    <div class="clear"></div>
                                </section>


                             

                                <section>
                                    <div class="sectionTitle">
                                        <h1>Interests</h1>
                                    </div>

                                    <div class="sectionContent" id="InterestsDiv">
                                        <article>
                                            <div class="container" style="width:100%;">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th style="width:70%">Interest</th>
                                                        <th style="width:30%">Level </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>John</td>
                                                        <td>Doe</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mary</td>
                                                        <td>Moe</td>
                                                    </tr>
                                                    <tr>
                                                        <td>July</td>
                                                        <td>Dooley</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </article>
                                    </div>
                                    <div class="clear"></div>
                                </section>


                                <section>
                                    <div class="sectionTitle">
                                        <h1>Languages</h1>
                                    </div>

                                    <div class="sectionContent" id="languagesDiv">
                                        <article>
                                            <div class="container" style="width:100%;">
                                                <table class="table table-hover borderless">
                                                    <thead>
                                                    <tr>
                                                        <th style="width:70%">Language</th>
                                                        <th style="width:30%">Proficiency</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>John</td>
                                                        <td>Doe</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mary</td>
                                                        <td>Moe</td>
                                                    </tr>
                                                    <tr>
                                                        <td>July</td>
                                                        <td>Dooley</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </article>
                                    </div>
                                    <div class="clear"></div>
                                </section>


                            </div>
                        </div>
                        <script type="text/javascript">
                            //var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
                            //document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
                        </script>
                        <script type="text/javascript">
                            /*var pageTracker = _gat._getTracker("UA-3753241-1");
                             pageTracker._initData();
                             pageTracker._trackPageview();
                             */
                        </script>
                        <!--theme ends here-->
                    </div>
                </div>
            </div>
        </div><!-- /#page-content-wrapper -->

        <!-- PROFILE SUMMARY MODAL START-->
        <div id="profileSummary" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Profile Summary</h4>
                        <h5>Edit your basic information</h5>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group">
                                <label class="small" for="profileSummaryFirstName">First Name: *  </label>
                                <input type="text" class="input-sm form-control" id="profileSummaryFirstName" value="" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="profileSummaryLastName">Last Name: *</label>
                                <input type="text" class="input-sm form-control" id="profileSummaryLastName" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="profileSummaryTitle">Title: *</label>
                                <input type="text" class="input-sm form-control" id="profileSummaryTitle" required>
                            </div>

                            <div class="form-group">
                                <label class="small" for="profileSummaryLocation">Location: </label>
                                <input type="text" class="input-sm form-control" id="profileSummaryLocation">
                            </div>

                            <div class="form-group">
                                <label class="small" for="profileSummaryEmail">Email: </label>
                                <input type="email" class="input-sm form-control" id="profileSummaryEmail">
                            </div>

                            <div class="form-group">
                                <label class="small" for="profileSummaryWebsite">Website: </label>
                                <input type="email" class="input-sm form-control" id="profileSummaryWebsite">
                            </div>

                            <div class="form-group">
                                <label class="small" for="profileSummaryMobile">Mobile: </label>
                                <input type="email" class="input-sm form-control" id="profileSummaryPhoneNo">
                            </div>








                            <div class="form-group">
                                <label class="small" for="profileSummaryProfileSummary">Profile Summary:</label>
                                <textarea class="form-control" rows="3" id="profileSummaryProfileSummary"></textarea>
                            </div>
                            <button id="btnSubmitProfileSummary" onclick="setProfileSummary()" type="submit" class="btn btn-default" data-dismiss="modal">Submit</button>
                            <button id="btnCloseProfileSummary" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </form>
                        <p class="small"><a href="#">Delete my account?</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- PROFILE SUMMARY MODAL END -->

        <!-- WORK EXPERIENCE MODAL START-->
        <div id="workExperience" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Work Experience</h4>
                        <h5>Edit your work experience to be displayed on your timeline.</h5>
                        <br>
                                                <button onclick="addNewWorkExperience()" class="btn">+ Add New</button>
                        <table class="table table-hover" id="workExperienceModalTable">
                            <thead>
                            <tr>
                                <th style="width:80%">Title at Company</th>
                                <th style="width:10%">Edit</th>
                                <th style="width:10%">Delete</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-body">

                        <form style="display: none;" id="workExperienceForm">

                            <div id="workExperienceNode">
                                   <button type="button"  ID="btnSubmitWorkExperience"  class="btn btn-default">Add</button>
                            <button onclick="hide(workExperienceForm)" type="button" class="btn btn-default">Cancel</button>

                                <div class="form-group">
                                    <label class="small" for="workExperienceTitle">Title: *</label>
                                    <input type="text" class="input-sm form-control" id="workExperienceTitle" required>
                                </div>
                                <div class="form-group">
                                    <label class="small" for="workExperienceCompany">Company: *</label>
                                    <input type="text" class="input-sm form-control" id="workExperienceCompany" required>
                                </div>
                                <div class="form-group">
                                    <label class="small" for="workExperienceStartMonth">Start Month: *</label>
                                    <select class="input-sm form-control" id="workExperienceStartMonth" required>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small" for="workExperienceStartYear">Start Year: *</label>
                                    <select id="workExperienceStartYear" class="date-own form-control StartYear"  type="text"></select>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="chkBoxIsCurrent"  onclick="chkboxIsCurentClick(this)" value="">Is Current</label>
                                </div>
                                <div class="form-group">
                                    <label class="small" for="workExperienceEndMonth">End Month: *</label>
                                    <select class="input-sm form-control" id="workExperienceEndMonth" required>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small" for="workExperienceEndYear" value="-1">End Year: *</label>

                                    <select id="workExperienceEndYear" class="date-own form-control EndYear"  type="text"></select>

                                </div>
                                <div class="form-group">
                                    <label class="small" for="workExperienceLocation">Location: </label>
                                    <input type="text" class="input-sm form-control" id="workExperienceLocation" required>
                                </div>
                                <div class="form-group">
                                    <label class="small" for="workExperienceSummary">Summary:</label>
                                    <textarea class="form-control" rows="3" id="workExperienceSummary"></textarea>
                                </div>
                            </div>
                         
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- WORK EXPERIENCE MODAL END -->

        <!-- EDUCATION MODAL START-->
        <div id="education" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Education</h4>
                        <h5>Edit your academic history to be displayed on your timeline.</h5>
                    <button onclick="addNewEducation()" class="btn">+ Add New</button>
                    </div>

                    <table class="table table-hover" id="educationModalTable">
                        <thead>
                        <tr>
                            <th style="width:80%">Degree - School</th>
                            <th style="width:10%">Edit</th>
                            <th style="width:10%">Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="modal-body">
                        
                        <form style="display: none;" id="educationForm">
                            <button id="btnSubmitEducation" type="button" class="btn btn-default">Add</button>
                            <button onclick="hide(educationForm)" type="button" class="btn btn-default">Cancel</button>
                        
                            <div class="form-group">
                                <label class="small" for="educationSchool">School: *</label>
                                <input type="text" class="input-sm form-control" id="educationSchool" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="educationDegree">Degree: *</label>
                                <input type="text" class="input-sm form-control" id="educationDegree" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="educationProgramOfStudy">Program of Study: </label>
                                <input type="text" class="input-sm form-control" id="educationProgramOfStudy">
                            </div>
                            <div class="form-group">
                                <label class="small" for="educationStartMonth">Start Month: *</label>
                                <select class="input-sm form-control" id="educationStartMonth" required>
                                  <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small" for="educationStartYear">Start Year: *</label>
                                <select id="educationStartYear"  class="date-own form-control StartYear"  type="text">
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="small" for="educationEndMonth">End Month: *</label>
                                <select class="input-sm form-control" id="educationEndMonth" required>
                                 <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small" for="educationStartYear">End Year: *</label>
                                <select id="educationEndYear"  class="date-own form-control EndYear"  type="text">
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small" for="educationLocation">Location: </label>
                                <input type="text" class="input-sm form-control" id="educationLocation" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="educationActivities">Activities:</label>
                                <textarea class="form-control" rows="3" id="educationActivities"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- EDUCATION MODAL END -->

        <!--MY LINKS MODAL START -->
        <div id="myLinks" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">My Links</h4>
                        <h5>Add your personal and professional URL's.</h5>
                    
                        <button onclick="addNewMyLink()" class="btn">+ Add New</button>
                    </div>
                    <table class="table table-hover" id="myLinksModalTable">
                        <thead>
                        <tr>
                            <th style="width:80%">URL</th>
                            <th style="width:10%">Edit</th>
                            <th style="width:10%">Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="modal-body">
                        <form style="display: none;" id="myLinksForm">
                            <button type="button" id="btnSubmitMyLinks" class="btn btn-default">Add</button>
                            <button onclick="hide(myLinksForm)" type="button" class="btn btn-default">Cancel</button>
                            <div class="form-group">
                                <label class="small" for="myLinksCategory">Category: *</label>
                                <select class="input-sm form-control" id="myLinksCategory" required>
                                    <option selected disabled>--Select--</option>
                                    <option>Personal Site</option>
                                    <option>Company Site</option>
                                    <option>Blog</option>
                                    <option>RSS</option>
                                    <option>Twitter</option>
                                    <option>Facebook</option>
                                    <option>LinkedIn</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small" for="myLinksURL">URL: *</label>
                                <input type="url" class="input-sm form-control" id="myLinksURL" required>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MY LINKS MODAL END -->

        <!--SKILLS MODAL START -->
        <div id="skills" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Skills</h4>
                        <h5>Populate your viz with kickass skills. Maximum 5 skills are displayed.</h5>
                    </div>
                    <table class="table table-hover" id="skillsModalTable">
                        <thead>
                        <tr>
                            <th style="width:80%">Skill</th>
                            <th style="width:10%">Edit</th>
                            <th style="width:10%">Delete</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="modal-body">
                        <button onclick="show(skillsForm)" class="btn">+ Add New</button>
                        <form style="display: none;" id="skillsForm">
                            <div class="form-group">
                                <label class="small" for="skillsSkill">Skill: *</label>
                                <input type="text" class="input-sm form-control" id="skillsSkill" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="skillsYears">Years: *</label>
                                <select class="input-sm form-control" id="skillsYears" required>
                                    <option selected disabled>--Select--</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>18</option>
                                    <option>19</option>
                                    <option>20+</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small" for="skillsProficiency">Proficiency: *</label>
                                <select class="input-sm form-control" id="skillsProficiency" required>
                                    <option selected disabled>--Select--</option>
                                    <option>Beginner</option>
                                    <option>Intermediate</option>
                                    <option>Advanced</option>
                                    <option>Expert</option>
                                </select>
                            </div>
                            <button type="button" id="btnSubmitSkills" class="btn btn-default">Add</button>
                            <button onclick="hide(skillsForm)" type="button" class="btn btn-default">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- SKILLS MODAL END -->

        <!-- INTERESTS MODAL START-->
        <div id="interests" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Interests</h4>
                        <h5>Add some interests to your viz. Maximum 6 interests are displayed.</h5>
                    </div>
                    <table class="table table-hover" id="interestsModalTable">
                        <thead>
                        <tr>
                            <th style="width:80%">Interest</th>
                            <th style="width:10%">Edit</th>
                            <th style="width:10%">Delete</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="modal-body">
                        <button onclick="show(interestsForm)" class="btn">+ Add New</button>
                        <form style="display: none;" id="interestsForm">
                            <div class="form-group">
                                <label class="small" for="interestsInterest">Interest: *</label>
                                <input type="text" class="input-sm form-control" id="interestsInterest" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="interestsLevelOfInterest">Level Of Interest: *</label>
                                <select class="input-sm form-control" id="interestsLevelOfInterest" required>
                                    <option selected disabled>--Select--</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                                <p class="small">10 is the highest.</p>
                            </div>
                            <button type="button" id="btnSubmitInterests" class="btn btn-default">Add</button>
                            <button onclick="hide(interestsForm)" type="button" class="btn btn-default">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- INTERESTS MODAL END -->

        <!-- LANGUAGES MODAL START-->
        <div id="languages" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Languages</h4>
                        <h5>Tell us about the languages you speak.</h5>
                    </div>
                    <table class="table table-hover" id="languagesModalTable">
                        <thead>
                        <tr>
                            <th style="width:80%">Language</th>
                            <th style="width:10%">Edit</th>
                            <th style="width:10%">Delete</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="modal-body">
                        <button onclick="show(languagesForm)" class="btn">+ Add New</button>
                        <form style="display: none;" id="languagesForm">
                            <div class="form-group">
                                <label class="small" for="languagesLanguage">Language: *</label>
                                <input type="text" class="input-sm form-control" id="languagesLanguage" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="languagesProficiency">Proficiency: *</label>
                                <select class="input-sm form-control" id="languagesProficiency" required>
                                    <option selected disabled>--Select--</option>
                                    <option>Elementary</option>
                                    <option>Limited</option>
                                    <option>Professional</option>
                                    <option>Full Professional</option>
                                    <option>Native</option>
                                </select>
                            </div>
                            <button type="button" id="btnSubmitLanguages" class="btn btn-default">Add</button>
                            <button onclick="hide(languagesForm)" type="button" class="btn btn-default">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- LANGUAGES MODAL END -->

        <!-- AWARDS & HONORS MODAL START-->
        <div id="awardsAndHonors" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Awards And Honors</h4>
                        <h5>Tell us about the languages you speak.</h5>
                    </div>
                    <table class="table table-hover" id="awardsAndHonorsModalTable">
                        <thead>
                        <tr>
                            <th style="width:80%">Title</th>
                            <th style="width:10%">Edit</th>
                            <th style="width:10%">Delete</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="modal-body">
                        <button onclick="show(awardsAndHonorsForm)" class="btn">+ Add New</button>
                        <form style="display: none;" id="awardsAndHonorsForm">
                            <div class="form-group">
                                <label class="small" for="awardsAndHonorsTitle">Title of Award or Honor: *</label>
                                <input type="text" class="input-sm form-control" id="awardsAndHonorsTitle" required>
                            </div>
                            <div class="form-group">
                                <label class="small" for="awardsAndHonorsYearReceived">Year Received: *</label>
                                <select id="awardsAndHonorsYearReceived"  class="date-own form-control StartYear"  type="text">
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small" for="awardsAndHonorsRankOfImportance">Rank Of Importance : *</label>
                                <select class="input-sm form-control" id="awardsAndHonorsRankOfImportance" required>
                                    <option selected disabled>--Select--</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                            </div>
                            <button type="button" id="btnSubmitAwardsAndHonors" class="btn btn-default">Add</button>
                            <button onclick="hide(awardsAndHonorsForm)" type="button" class="btn btn-default">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- AWARDS & HONORS MODAL END -->
    </div> <!-- /#wrapper -->






    <div id="Nodes" style="display:none">





    </div>

    </html>

@endsection

