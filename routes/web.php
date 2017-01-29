<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard', 'DashboardController@index');

Route::post('HomeController/insertProfileSummary', 'HomeController@insertProfileSummary');
Route::get('HomeController/insertProfileSummary', 'HomeController@insertProfileSummary');
Route::get('HomeController/getProfileSummary', 'HomeController@getProfileSummary');

Route::get('HomeController/insertWorkExperience', 'HomeController@insertWorkExperience');
Route::get('HomeController/getWorkExperience', 'HomeController@getWorkExperience');
Route::get('HomeController/deleteWorkExperience', 'HomeController@deleteWorkExperience');
Route::get('HomeController/editWorkExperiencePopulateForm', 'HomeController@editWorkExperiencePopulateForm');
Route::get('HomeController/editWorkExperience', 'HomeController@editWorkExperience');


Route::get('HomeController/insertEducation', 'HomeController@insertEducation');
Route::get('HomeController/deleteEducation', 'HomeController@deleteEducation');
Route::get('HomeController/getEducation', 'HomeController@getEducation');
Route::get('HomeController/editEducationPopulateForm', 'HomeController@editEducationPopulateForm');
Route::get('HomeController/editEducation', 'HomeController@editEducation');


Route::get('HomeController/insertMyLinks', 'HomeController@insertMyLinks');
Route::get('HomeController/deleteMyLinks', 'HomeController@deleteMyLinks');
Route::get('HomeController/getMyLinks', 'HomeController@getMyLinks');
Route::get('HomeController/editMYLinkPopulateForm', 'HomeController@editMYLinkPopulateForm');
Route::get('HomeController/editMyLink', 'HomeController@editMyLink');



Route::get('HomeController/insertSkills', 'HomeController@insertSkills');
Route::get('HomeController/deleteSkills', 'HomeController@deleteSkills');

Route::get('HomeController/insertInterests', 'HomeController@insertInterests');
Route::get('HomeController/deleteInterest', 'HomeController@deleteInterests');

Route::get('HomeController/insertLangauges', 'HomeController@insertLanguages');
Route::get('HomeController/deleteLanguages', 'HomeController@deleteLanguages');

Route::get('HomeController/insertAwardsAndHonors', 'HomeController@insertAwardsAndHonors');
Route::get('HomeController/deleteAwardsAndHonors', 'HomeController@deleteAwardsAndHonors');

Route::get('HomeController/setInfoFlag', 'HomeController@setInfoFlag');
Route::get('HomeController/sendMessageAll', 'HomeController@sendMessageAll');
Route::get('HomeController/setMessagesRead', 'HomeController@setMessagesRead');

Route::get('/dashboard/viewLeads','ViewLeadsController@index');
Route::get('/dashboard/showLead/{user_id}','ShowLeadController@index');
Route::get('/buy/{theme_id}','BrainTreeController@index');
Route::post('/payPaypal','BrainTreeController@makePaypalPayment');
Route::post('/payCard','BrainTreeController@makeCardPayment');

Route::get('/privacy','WelcomeController@showPrivacy');
Route::get('/terms_of_services','WelcomeController@showTermsOfServices');
