<?php
// Need some better place
Route::get('/comparescans', 'ComparisonsController@index')->name('comparescans');

// Laravel Routes
Auth::routes();
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

// Resources GroupsController & ScanController and some other pages that need a better location
Route::resource('group', 'GroupsController')->middleware('auth');
Route::resource('scan', 'ScansController');
Route::get('/scan/{scan}/selfdestruct', 'ScansController@selfdestruct')->name('scan.selfdestruct');
Route::get('/group/{group}/delete', 'GroupsController@destroy')->middleware('auth');
Route::get('/group/{group}/created', 'GroupsController@created')->name('group.created')->middleware('auth');
Route::get('/group/{group}/createscan/{code}', 'GroupsController@createscan')->name('group.createscan')->middleware('auth');

// ScanPagesController
Route::get('/loggless', 'ScanPagesController@loggless')->name('scan.loggless');
Route::get('/scan/{scan}/startscan', 'ScanPagesController@startscan')->name('scan.startscan');
Route::get('/scan/{scan}/kennismaken', 'ScanPagesController@kennismaken')->name('scan.kennismaken');
Route::get('/scan/{scan}/regioincijfers', 'ScanPagesController@regioincijfers')->name('scan.regioincijfers');
Route::get('/scan/{scan}/algemeenbeeld', 'ScanPagesController@algemeenbeeld')->name('scan.algemeenbeeld');
Route::get('/scan/{scan}/algemeenbeeldresultaten', 'ScanPagesController@algemeenbeeldresultaten')->name('scan.algemeenbeeldresultaten');
Route::get('/scan/{scan}/showscan', 'ScanPagesController@showscan')->name('scan.showscan');
Route::get('/scan/{scan}/showmeasures', 'ScanPagesController@showmeasures')->name('scan.showmeasures');
Route::get('/scan/{scan}/calendar', 'ScanPagesController@calendar')->name('scan.calendar');
Route::get('/scan/{scan}/complete', 'ScanPagesController@scancomplete')->name('scan.complete');
Route::get('/scan/{scan}/emailresults', 'ScanPagesController@emailresults')->name('scan.emailresults');
Route::get('/scan/{scan}/resultsmailed', 'ScanPagesController@resultsmailed')->name('scan.resultsmailed');
Route::get('/scan/{scan}/results', 'ScanPagesController@results')->name('scan.results');
Route::get('/scan/{scan}/measureresults', 'ScanPagesController@measureresults')->name('scan.measureresults');
Route::post('/scan/{scan}/commitdatetime', 'ScanPagesController@commitdatetime')->name('scan.commitdatetime');

// PagesController
Route::get('/', 'PagesController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/startscan', 'PagesController@startscan')->name('startscan');
Route::get('/kennisbank', 'PagesController@kennisbank')->name('kennisbank');
Route::get('/instructiefilms', 'PagesController@instructiefilms')->name('instructiefilms');
Route::get('/pmonitor', 'PagesController@pmonitor')->name('pmonitor');
Route::get('/grouprequested', 'PagesController@grouprequested')->name('grouprequested');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/overzichtresultaten', 'AdminpagesController@overzichtresultaten')->name('overzichtresultaten')->middleware('auth');

