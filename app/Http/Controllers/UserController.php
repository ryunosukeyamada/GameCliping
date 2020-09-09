<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(string $name) {
        $user = User::where('name', $name)->first();
        return view('users.show', ['user' => $user]);
    }

    // プロフィール画像編集
    public function edit(ImageRequest $request,string $name) {
        $user = User::where('name', $name)->first();
        
        $originalImg= $request ->profile_image;
        // dd($originalImg);
        if($originalImg -> isValid()){
            $filePath = $originalImg -> store('public/profiles');
            // profile_imageカラムにpublic/profilesが入らないように削除↓
            $user->profile_image=str_replace('public/profiles/','', $filePath);
            $user->save();  
            return redirect()->route('users.show',['name' => $user->name]);
        }
    }
}
