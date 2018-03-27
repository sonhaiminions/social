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
Route::get('tet', function () {
//	$a = App\Status::find(19)->user;
	$a = App\User::find(2)->statuses;
//	dd($a->id);
	foreach($a as $key){
	    echo $key->id.'<br>';
    }
});
Route::get('/', 'HomeController@index')->name('home');
Route::get('alert', function () {
	Session::put('key', 'value');
	Session::flash('message', 'Mật khẩu được cập nhật thành công!');
	return redirect()->route('home')->with('info', 'you have signed');
});
Route::get('signup', 'AuthController@getSignUp');
Route::post('signup', 'AuthController@postSignUp');
Route::get('signin', 'AuthController@getSignIn')->name('signin');
Route::post('signin', 'AuthController@postSignIn');
Route::get('logout', 'AuthController@logout');
Route::post('searchresult', 'SearchController@getresult')->name('result');
Route::get('getprofile/{id}', 'ProfileController@getprofile')->name('getprofile');
Route::get('geteditprofile/{id}', 'ProfileController@geteditprofile');
Route::post('posteditprofile/{id}', 'ProfileController@posteditprofile');
//timeline
Route::get('timeline','StatusController@index')->name('timeline');
Route::post('poststatus','StatusController@poststatus');
Route::post('replypost/{id}','StatusController@replypost');
Route::get('like/{id}','StatusController@like');
// friend
Route::get('friend/{id}','FriendsController@getfriend')->name('friend');
Route::get('getadd/{id}','FriendsController@getadd');
Route::get('getaccept/{id}','FriendsController@getaccept');