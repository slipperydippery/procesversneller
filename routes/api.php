<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Refactor these:
// Route::resource('user.group', 'ApiUserGroupsController')->middleware('auth:api');
Route::get('/group/user/{user}', 'ApiGroupsController@index')->middleware('auth:api');
// Route::resource('group.user', 'ApiGroupUsersController')->middleware('auth:api');
Route::get('/group/{group}/users', 'ApiGroupsController@indexusers')->middleware('auth:api');
// Route::resource('group.district', 'ApiGroupDistrictsController')->middleware('auth:api');
Route::post('/group/{group}/updatedistricts', 'ApiGroupsController@updatedistricts')->middleware('auth:api');
// Route::resource('group.scan', 'ApiGroupScansController')->middleware('auth:api');
Route::post('/group/{group}/storescan', 'ApiGroupsController@storescan')->middleware('auth:api');
Route::get('/group/{group}/removescan/{scan}', 'ApiGroupsController@removescan')->middleware('auth:api');
Route::get('/group/{group}/broadcastupdate', 'ApiGroupsController@broadcastupdate')->middleware('auth:api');

// Route::resource('group', 'ApiGroupsController')->middleware('auth:api');
Route::post('/group', 'ApiGroupsController@store')->middleware('auth:api');
Route::patch('/group/{group}', 'ApiGroupsController@update')->middleware('auth:api');
Route::get('/group/{group}', 'ApiGroupsController@show')->middleware('auth:api');

Route::get('/grouprequest/{group}', 'ApiGrouprequestsController@index')->middleware('auth:api');
Route::get('/grouprequest/{grouprequest}/accept', 'ApiGrouprequestsController@accept')->middleware('auth:api');
Route::get('/grouprequest/{grouprequest}/deny', 'ApiGrouprequestsController@deny')->middleware('auth:api');

Route::get('/dashmessage/user/{user}/', 'ApiDashmessagesController@index')->middleware('auth:api');
Route::delete('/dashmessage/{dashmessage}', 'ApiDashmessagesController@delete')->middleware('auth:api');

Route::get('/scan/user/{user}', 'ApiScansController@indexuser')->middleware('auth:api');
Route::get('/scan', 'ApiScansController@index')->middleware('auth:api');
Route::post('/scan/', 'ApiScansController@store')->middleware('auth:api');
Route::get('/scan/{scan}', 'ApiScansController@show')->middleware('auth:api');
Route::post('/scan/{scan}', 'ApiScansController@update')->middleware('auth:api');
Route::get('/scan/{scan}/getdistricts', 'ApiScansController@getdistricts')->middleware('auth:api');
Route::post('/scan/{scan}/updatedistricts', 'ApiScansController@updatedistricts')->middleware('auth:api');
Route::post('/scan/{scan}/withanswers', 'ApiScansController@storewithanswers')->middleware('auth:api');
Route::get('/scan/{scan}/themes', 'ApiScansController@indexthemes')->middleware('auth:api');
Route::get('/scan/{scan}/answers', 'ApiScansController@indexanswers')->middleware('auth:api');
Route::post('/scan/{scan}/answers/{answer}', 'ApiScansController@postanswer')->middleware('auth:api');
Route::post('/answer/{answer}', 'ApiAnswersController@update')->middleware('auth:api');
Route::get('/scan/{scan}/theme/{theme}/questions', 'ApiScansController@indexquestions')->middleware('auth:api');
Route::get('/scan/{scan}/user/', 'ApiScansController@getuser')->middleware('auth:api');
Route::post('/scan/{scan}/scandate', 'ApiScandateController@update')->middleware('auth:api');

Route::resource('measure', 'ApiMeasuresController')->middleware('auth:api');
Route::resource('district', 'ApiDistrictsController')->middleware('auth:api');
Route::resource('theme', 'ApiThemesController');
Route::resource('scan.comparison', 'ApiScanComparisonsController')->middleware('auth:api');
Route::resource('comparison', 'ApiComparisonsController')->middleware('auth:api');
Route::resource('instrument', 'ApiInstrumentsController');
Route::resource('programma', 'ApiProgrammasController');
Route::resource('praktijkvoorbeeld', 'ApiPraktijkvoorbeeldsController');
Route::resource('pdf', 'ApiPdfsController');
Route::resource('link', 'ApiLinksController');



Route::post('/measure/{measure}/user/{user}', 'ApiMeasuresController@adduser')->middleware('auth:api');
Route::get('/measure/{measure}/user/{user}/removeuser', 'ApiMeasuresController@removeuser')->middleware('auth:api');

Route::get('/user/{user}/nomorehints', 'ApiUsersController@nomorehints')->middleware('auth:api');
Route::get('/user/{user}/turnonhints', 'ApiUsersController@turnonhints')->middleware('auth:api');
