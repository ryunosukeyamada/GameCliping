<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
// アカウント機能
Auth::routes();
// Google
Route::prefix('login')->name('login')->group(function() {
  Route::get('/google','Auth\LoginController@redirectToGoogle')->name('.google');
  Route::get('/google/callback', 'Auth\LoginController@handleGoogleCallback')->name('.google.callback');
});
Route::prefix('register')->name('register')->group(function () {
  Route::get('/google', 'Auth\RegisterController@showGoogleUserRegistrationForm')->name('.google');
  Route::post('/google', 'Auth\RegisterController@registerGoogleUser')->name('.google');
});

// Top画面
Route::get('/', 'TopController@show')->name('top');


Route::prefix('home')->name('clips')->group(function(){
  // 投稿一覧
  Route::get('', 'ClipController@index')->name('.index');
  // 投稿一覧自分の投稿
  Route::get('/myclip', 'ClipController@myClip')->name('.index.myclip');
  // 投稿一覧いいね順
  Route::get('/likes', 'ClipController@indexLikes')->name('.index.likes');
  // 投稿一覧フォローしているユーザーの投稿
  Route::get('/followclips', 'ClipController@followClips')->name('.index.followClips');
});

// 投稿一覧タグ別
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');



Route::resource('/clips', 'ClipController', ['except' => ['index', 'show']])->middleware('auth');
Route::resource('/clips', 'ClipController', ['only' => ['show']]);

// いいねルート
Route::prefix('clips')->middleware('auth')->group(function () {
  Route::put('/{clip}/like', 'ClipController@like')->name('like');
  Route::delete('/{clip}/like', 'ClipController@unlike');
});


// ユーザー情報
Route::prefix('users')->name('users')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('.show');
  Route::get('/{name}/likes', 'USerController@likes')->name('.likes');
  Route::get('/{name}/follow','UserController@follows')->name('.follows');
  Route::get('/{name}/followers', 'UserController@followers')->name('.followers');

  Route::post('/serch', 'UserController@serch')->name('.serch');

  // フォロー イメージ変更
  Route::middleware('auth')->group(function() {
    // イメージ変更
    Route::post('{name}/edit', 'UserController@edit')->name('.edit');
    // コメント変更
    Route::put('{name}/edit', 'UserController@editCaption');


    Route::put('/{name}/follow', 'UserController@follow')->name('.follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('.unfollow');
  });
});
