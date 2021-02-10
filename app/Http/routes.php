<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//FRONTEND ROUTES
Route::get('/home', ['uses' => 'UserController@getHome']);
Route::controller('/auth', 'Auth\AuthController');
Route::controller('/password', 'Auth\PasswordController');

Route::get('/user/home', ['uses' => 'UserController@getHome']);
Route::controller('user', 'Auth\UserController');
Route::controller('/user/password', 'Auth\UserPasswordController');

Route::get('/', 'FrontController@index');
Route::get('/detail/{id}', 'FrontController@getDetail');
Route::get('/newsletter', 'NewsletterController@index');
Route::get('/detail-newsletter/{id}', 'NewsletterController@getDetail');
Route::get('/project', 'ProjectController@index');
Route::get('/client', 'ClientController@index');
Route::get('client-home', 'ClientController@home');
Route::get('wedding-data', 'ClientController@weddingData');
Route::post('post-wedding-data', 'ClientController@postWeddingData');
Route::get('wedding-data-bestmen', 'ClientController@weddingDataBestmen');
Route::post('post-bestmen', 'ClientController@postDataBestmen');
Route::get('wedding-data-famcoord', 'ClientController@weddingDataFamcoord');
Route::post('post-famcoord', 'ClientController@postDataFamcoord');
Route::get('wedding-data-guest-welcoming', 'ClientController@weddingDataGuestwelcoming');
Route::post('post-guestwelcoming', 'ClientController@postDataGuestwelcoming');
Route::get('wedding-data-guestbookangpao', 'ClientController@weddingDataGuestbookAngpao');
Route::post('post-guestbookangpao', 'ClientController@postDataGuestbookAngpao');
Route::get('wedding-data-teapay', 'ClientController@weddingDataTeaPay');
Route::post('post-teapay', 'ClientController@postDataTeaPay');
Route::get('wedding-data-corsagelist', 'ClientController@weddingDataCorsageList');
Route::post('post-corsagelist', 'ClientController@postDataCorsageList');
Route::get('wedding-data-familyphotolist', 'ClientController@weddingDataFamilyPhotoList');
Route::post('post-familyphotolist', 'ClientController@postDataFamilyPhotoList');
Route::get('wedding-data-friendphotolist', 'ClientController@weddingDataFriendPhotoList');
Route::post('post-friendphotolist', 'ClientController@postDataFriendPhotoList');
Route::get('/about', 'FrontController@getAbout');
Route::get('/contact', 'FrontController@getContact');
Route::post('post-contact', 'FrontController@doSend');
Route::post('contact', ['as' => 'front.post_contact', 'uses' => 'FrontController@post_contact']);

Route::resource('project', 'ProjectController');
Route::controller('project', 'ProjectController');


Route::resource('/packages', 'PackageController');
Route::controller('packages', 'PackageController');
Route::get('packages-del/{id}', 'PackageController@destroy');
Route::post('datatable/packages', 'PackageController@datatable');

Route::get('register', [
    'as' => 'register', 'uses' => 'ClientController@register'
]);

Route::get('/register/activate/{code}', 'Auth\AuthController@getActivate');
Route::post('post-register', 'ClientController@doRegister');

Route::get('user-logout', 'ClientController@logout');
Route::post('user-login', 'ClientController@login');


// Authentication routes
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
// end ori

// Registration routes (tidak digunakan)
//Route::get('register', 'Auth\AuthController@getRegister');
//Route::post('register', 'Auth\AuthController@postCreate');


/* Datatable */





Route::group(['middleware' => 'auth'], function () {

    Route::resource('banners', 'BannerController');
    Route::controller('banners', 'BannerController');

    //BACKEND ROUTES
    Route::resource('users', 'UserController');
    Route::controller('users', 'UserController');
    Route::post('datatable/users', 'UserController@datatable');

    Route::get('/couple/image/{id}', 'CoupleController@getPreviewImage');
    Route::post('resizeImagePost', ['as' => 'resizeImagePost', 'uses' => 'CoupleController@resizeImagePost']);

    Route::resource('couple', 'CoupleController');
    Route::controller('couple', 'CoupleController');
    Route::post('datatable/couples', 'CoupleController@datatable');

    Route::model('project', 'App\Project');
    Route::model('package-taken', 'App\PackageTaken');


    // Route::post('datatable/couples', 'CoupleController@datatable');

    Route::get('/package-takens/{id}', 'PackageTakenController@destroy');
    Route::get('/package-taken/{id}/create', 'PackageTakenController@create');
    Route::resource('package-taken', 'PackageTakenController');
    Route::controller('package-taken', 'PackageTakenController');
    // Route::resource('/package_taken', 'PackageTakenController');
    Route::get('/package_taken/{id}', 'PackageTakenController@getIndex');
    Route::post('datatable/package-taken/', 'PackageTakenController@getIndex');


    Route::resource('vendors', 'VendorController');
    Route::controller('vendors', 'VendorController');
    Route::post('datatable/vendors', 'VendorController@datatable');

    Route::get('/event/{id}', 'EventController@destroy');
    Route::resource('events', 'EventController');
    Route::controller('events', 'EventController');
    Route::post('datatable/events', 'EventController@datatable');

    Route::resource('contacts', 'ContactController');
    Route::controller('contacts', 'ContactController');
    Route::post('datatable/contacts', 'ContactController@datatable');

    Route::post('NewsController/upload', 'NewsController@upload')->name('NewsController.upload');
    Route::resource('news-letter', 'NewsController');
    Route::controller('news-letter', 'NewsController');
    Route::post('datatable/news-letter', 'NewsController@datatable');





    Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');

    /* Dashboard sebagai halaman pertama setelah login */
    Route::get('home', 'DashboardController@getIndex');


    // my account
    // Route::get('/account', 'AccountController@index');
    // Route::post('/account/update-profile', 'AccountController@updateProfile');
    // Route::post('/account/update-password', 'AccountController@updatePassword');

    Route::get('/system', 'SystemController@index');

    // system - role
    Route::get('/system/role', 'SystemController@indexRole');
    Route::get('/system/role/list', 'SystemController@datatablesRole');
    Route::get('/system/role/add', 'SystemController@addRole');
    Route::get('/system/role/edit/{id}', 'SystemController@editRole');
    Route::post('/system/role/save', 'SystemController@saveRole');
    Route::post('/system/role/update/{id}', 'SystemController@updateRole');
    Route::post('/system/role/delete/{id}', 'SystemController@deleteRole');
    Route::get('/system/role/detail/{id}', 'SystemController@detailRole');

    // system - user
    Route::get('/system/user', 'SystemController@indexUser');
    Route::get('/system/user/list', 'SystemController@datatablesUser');
    Route::get('/system/user/add', 'SystemController@addUser');
    Route::get('/system/user/edit/{id}', 'SystemController@editUser');
    Route::post('/system/user/save', 'SystemController@saveUser');
    Route::post('/system/user/update/{id}', 'SystemController@updateUser');
    Route::post('/system/user/delete/{id}', 'SystemController@deleteUser');
});
