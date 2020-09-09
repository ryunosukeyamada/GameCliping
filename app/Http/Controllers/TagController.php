<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(string $name) {
        $tag = Tag::with('clips')->where('name', $name)->first();
        return view('tags.show', ['tag'=>$tag]);
    }
}
