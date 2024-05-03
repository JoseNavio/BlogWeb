<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showForm()
    {
        return view('post-form');
    }

    public function storePost(Request $request)
    {

        $incomingFields = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
        ]);
        //Drop any PHP or HTML tags from text...
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);
        $incomingFields['user_id'] = auth()->id();

        Post::create($incomingFields);

        return redirect('/')->with('success', 'Post created successfully!');
    }
}
