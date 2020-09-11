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

// Top画面
Route::get('/', 'TopController@show')->name('top');

// 投稿一覧
Route::get('/home', 'ClipController@index')->name('clips.index');
// 投稿一覧自分の投稿
Route::get('/home/myclip', 'ClipController@myClip')->name('clips.index.myclip');
// 投稿一覧いいね順
Route::get('/home/likes', 'ClipController@indexLikes')->name('clips.index.likes');
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
