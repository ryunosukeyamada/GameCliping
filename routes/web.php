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

  Route::post('{name}/edit', 'UserController@edit')->name('.edit')->middleware('auth');
});
