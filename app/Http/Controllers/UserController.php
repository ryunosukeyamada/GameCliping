<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ユーザー情報
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        $clips = $user->clips()->orderBy('created_at', 'desc')->paginate(8);
        return view('users.show', ['user' => $user,'clips' => $clips]);
    }
    // ユーザーいいね
    public function likes(String $name) {
        $user = User::where('name', $name)->first();
        $clips= $user->likes()->orderBy('created_at','desc')->paginate(8);

        return view('users.likes', ['user' => $user,'clips'=>$clips]);
    }

    // プロフィール画像編集
    public function edit(ImageRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $originalImg = $request->profile_image;
        // dd($originalImg);
        if ($originalImg->isValid()) {
            $filePath = $originalImg->store('public/profiles');
            // profile_imageカラムにpublic/profilesが入らないように削除↓
            $user->profile_image = str_replace('public/profiles/', '', $filePath);
            $user->save();
            return redirect()->route('users.show', ['name' => $user->name]);
        }
    }

    // フォロー
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
        if ($user->id === $request->user()->id) {
            return abort('404', '自分自身をフォローする事はできません');
        }
        $request->user()->follows()->detach($user);
        $request->user()->follows()->attach($user);
    }
    // フォロー解除
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
        if ($user->id === $request->user()->id) {
            return abort('404', '自分自身をフォローする事はできません');
        }
        $request->user()->follows()->detach($user);
    }
}
