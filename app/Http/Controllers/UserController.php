<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaptionRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Storage;

use App\User;


class UserController extends Controller
{
    // ユーザー情報
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        $clips = $user->clips()->with(['likes', 'tags', 'user'])->orderBy('created_at', 'desc')->paginate(8);
        return view('users.show', ['user' => $user, 'clips' => $clips]);
    }
    // ユーザーいいね一覧
    public function likes(string $name)
    {
        $user = User::where('name', $name)->first();
        $clips = $user->likes()->with(['tags', 'user', 'likes'])->orderBy('created_at', 'desc')->paginate(8);

        return view('users.likes', ['user' => $user, 'clips' => $clips]);
    }
    // ユーザーフォロー一覧
    public function follows(string $name)
    {
        $user = User::where('name', $name)->first();
        $followUsers = $user->follows()->with('followers')->orderBy('created_at', 'desc')->paginate(12);
        return view('users.follows', ['user' => $user, 'followUsers' => $followUsers]);
    }
    // ユーザーフォロワー一覧
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();
        $followerUsers = $user->followers()->with('followers.followers')->orderBy('created_at', 'desc')->paginate(12);
        return view('users.followers', ['user' => $user, 'followerUsers' => $followerUsers]);
    }

    // プロフィール画像編集
    public function edit(ImageRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $uploadImg = $user->profile_image = $request->file('profile_image');
        $path = Storage::disk('s3')->putFile('/', $uploadImg, 'public');
        $user->profile_image = Storage::disk('s3')->url($path);
        
        $user->save();
        return redirect()->route('users.show', ['name' => $user->name]);
    }

    // コメント編集
    public function editCaption(CaptionRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();
        $user->caption = $request->caption;
        $user->save();
        return redirect()->route('users.show', ['name' => $user->name]);
    }

    // ユーザー検索
    public function serch(Request $request)
    {
        $this->validate($request, ['keyword' => 'required|string|alpha_dash']);
        $query = User::query();
        $keyword = $request->keyword;
        $users = $query->with(['followers'])->where('name', 'like', '%' . $keyword . '%')->get();

        return view('users.serch', ['users' => $users, 'keyword' => $keyword]);
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
