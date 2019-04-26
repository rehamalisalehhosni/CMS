<?php
Auth::routes();
//
//
// Route::get('/home', 'HomeController@index')->name('home');
//
//
// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles','RoleController');
//     Route::resource('users','UserController');
//     Route::resource('products','ProductController');
// });

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

// Route::get('/', function () {
//     return view('welcome');
// });
//
// Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/key', function() {
    $exitCode = Artisan::call('key:generate');
    return '<h1>Cache facade value cleared</h1>';
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

// return what you want
/*Route::get('setlocale/{locale}', function ($locale) {
  if (in_array($locale, \Config::get('app.locales'))) {
    Session::put('locale', $locale);
  }
  return redirect()->back();
});*/
// Route::group(['prefix' => '{lang}', 'where' => ['lang' => '(ar|en)'],'middleware' => 'language'],function(){
//   //Route::group(['prefix' => 'adminControl',  'middleware' => 'auth'], function()
//   Route::get('/', ['as' => 'index', 'uses' => 'front\HomeController@index']);
//   Route::get('contactUs', ['as' => 'contactUs.index', 'uses' => 'front\ContactUsController@index']);
//   Route::get('aboutUs', ['as' => 'aboutUs.index', 'uses' => 'front\AboutUsController@index']);
//   Route::post('contactUs', ['as' => 'contactUs.store', 'uses' => 'front\ContactUsController@store']);
//   Route::get('ourServices', ['as' => 'ourServices.index', 'uses' => 'front\OurServicesController@index']);
//   Route::get('ourProcessing', ['as' => 'ourProcessing.index', 'uses' => 'front\OurProcessingController@index']);
//   Route::get('ourCustomers', ['as' => 'ourCustomers.index', 'uses' => 'front\OurCustomersController@index']);
//   Route::post('subscribe/add', ['as' => 'subscribe.add', 'uses' => 'front\SubscribeController@add']);
// });

Route::auth();
Route::group(['prefix' => 'adminControl',  'middleware' => 'auth'], function()
{
  Route::resource('roles','admin\RoleController');
  Route::resource('users','admin\UserController');
  Route::resource('languages','admin\LanguagesController');

  //////////////Users///////////////////
  Route::get('/', ['as' => 'statistic.index', 'uses' => 'admin\StatisticController@index']);
  Route::get('/dashbard', ['as' => 'statistic.index', 'uses' => 'admin\StatisticController@index']);
  Route::get('users', ['as' => 'users.index', 'uses' => 'admin\UserController@index']);
  Route::get('users/create', ['as' => 'users.create', 'uses' => 'admin\UserController@create']);
  Route::post('users/create', ['as' => 'users.store', 'uses' => 'admin\UserController@store']);
  Route::get('users/{id}', ['as' => 'users.show', 'uses' => 'admin\UserController@show']);
  Route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'admin\UserController@edit']);
  Route::patch('users/{id}', ['as' => 'users.update', 'uses' => 'admin\UserController@update']);
  Route::delete('users/{id}', ['as' => 'users.destroy', 'uses' => 'admin\UserController@destroy']);
  Route::post('uploadImage/store', ['as' => 'uploadImage.store', 'uses' => 'admin\UploadImageController@store']);
  //////////////Setting///////////////////
  Route::get('setting/{id}/edit', ['as' => 'setting.edit', 'uses' => 'admin\SettingController@edit']);
  Route::patch('setting/{id}', ['as' => 'setting.update', 'uses' => 'admin\SettingController@update']);
  //////////////Setting///////////////////
  /////////socialMedia ///////////
  Route::get('socialMedia', ['as' => 'socialMedia.index', 'uses' => 'admin\SocialMediaController@index']);
  Route::get('socialMedia/create', ['as' => 'socialMedia.create', 'uses' => 'admin\SocialMediaController@create']);
  Route::post('socialMedia/create', ['as' => 'socialMedia.store', 'uses' => 'admin\SocialMediaController@store']);
  Route::get('socialMedia/{id}', ['as' => 'socialMedia.show', 'uses' => 'admin\SocialMediaController@show']);
  Route::get('socialMedia/{id}/edit', ['as' => 'socialMedia.edit', 'uses' => 'admin\SocialMediaController@edit']);
  Route::patch('socialMedia/{id}', ['as' => 'socialMedia.update', 'uses' => 'admin\SocialMediaController@update']);
  Route::delete('socialMedia/{id}', ['as' => 'socialMedia.destroy', 'uses' => 'admin\SocialMediaController@destroy']);

  /////////Contact us ///////////
  Route::get('contactRequest', ['as' => 'contactRequest.index', 'uses' => 'admin\ContactRequestController@index']);
  Route::get('newsletter', ['as' => 'newsletter.index', 'uses' => 'admin\NewsletterController@index']);
  Route::get('sendMsg', ['as' => 'newsletter.message', 'uses' => 'admin\NewsletterController@message']);
  Route::post('sendMsg/send', ['as' => 'newsletter.send', 'uses' => 'admin\NewsletterController@send']);

});
