<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
    see https://laravel.com/docs/5.5/routing#basic-routing
    see https://laravel.com/docs/5.8/controllers#resource-controllers
 */

// Route::get('/', function() {
//     return response()->json([
//      'stuff' => phpinfo()
//     ]);
//  })

/*Route::get('/', function () {
     return view('home'); //loads welcome template i.e welcome.blade.php
     //return view('auth.login');
     //return view('companies.index');
 });*/
Route::get('/', 'CompaniesController@index')->name('home');

Route::post('/viewcheck', 'HomeController@viewchecker');

Route::post('/companies/{company_id}', 'CompaniesController@showCompany');

Route::get('/companies/mycompanies', 'CompaniesController@my_companies');

// Route::post('/users/delete/user_id', 'UsersController@destroy');
Route::post('/users/delete', 'UsersController@delete');

// Route::get('/roles/delete', 'RolesController@show');

Route::get('/logIn', 'PmLoginController@show');

Route::post('/logIn', 'PmLoginController@authenticate');

Route::get('find', 'SearchController@find');

// Route::get('/roles', 'RolesController@index');

// Route::get('/guest-admin', 'UsersController@guestAdmin');
// Route::get('/login/guest-admin', 'UsersController@guestAdmin');

// Route::get('/guest-contrib', 'UsersController@guestContrib');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

// Route::get('projects/create/{company_id?}', 'ProjectsController@create'); 
// /*  
//     ? after company_id indicates that this filter is optional, note that id alone would work
//     but company_id is used for convention and code coherence/comprehension
// */

// Route::resource('companies', 'CompaniesController'); /*see https://laravel.com/docs/5.7/controllers */
// Route::resource('projects', 'ProjectsController');
// Route::resource('roles', 'RolesController');
// Route::resource('tasks', 'TasksController');
// Route::resource('users', 'UsersController');
Route::resource('companies', 'CompaniesController');
Route::resource('roles', 'RolesController');
Route::resource('users', 'UsersController');


Route::middleware(['auth'])->group(function () { //makes routes accessible to logged in users only
//auth middleware must execute before a user can access the following group of funtions
    Route::get('projects/create/{company_id?}', 'ProjectsController@create'); 

    Route::get('/users/changepassword/{user_id}', 'UsersController@showChangePasswordForm');

    Route::post('/users/changepassword/{user_id}', 'UsersController@changepassword')->name('changepassword');
    /*  
        ? after company_id indicates that this filter is optional, note that id alone would work
        but company_id is used for convention and code coherence/comprehension
    */

    // Route::resource('companies', 'CompaniesController'); /*see https://laravel.com/docs/5.7/controllers */
    Route::resource('projects', 'ProjectsController');
    // Route::resource('roles', 'RolesController');
    Route::resource('tasks', 'TasksController');
    // Route::resource('users', 'UsersController');
    Route::resource('comments', 'CommentsController');

    // Route::get('find', 'SearchController@find');
    Route::get('projectfind', 'SearchController@projectfind');
    Route::get('userfind', 'SearchController@userfind');
    Route::get('findmycompanies', 'SearchController@findmycompanies');

    /* Route::get('user/profile', function () { do something})->name('profile');
       this is named route i.e the name or alias for the route user/profile is profile 
       as specified by the name method
    */
});