<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showForm()
    {
        //In case you are not using the auth middleware
        // if (!auth()->check()) {
        //     return redirect('/');
        // }
        return view('post-form');
    }

    public function storePost(Request $request)
    {

        $incomingFields = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required'
        ]);
        //Drop any PHP or HTML tags from text... Avoid XSS attacks...
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('success', 'Post successfully created.');
    }
    //Should be more or less the same than storePost...
    public function updatePost(Request $request, Post $post)
    {
        $incomingFields = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);

        $post->update($incomingFields);

        //return back()->with('success', 'Post successfully updated.');
        return redirect("/post/{$post->id}")->with('success', 'Post successfully updated.');
    }

    //It has to be called the same than in the web route "post" , and if you add the Post model, it will automatically get the post with that id
    public function showPost(Post $post)
    {
        //Markdown support
        //$post["content"] =  Str::markdown($post->content);

        //In case you dont't want links... Allowed tags...
        $post["content"] = strip_tags(Str::markdown($post->content), '<p><h1><h2><h3><h4><h5><h6><strong><em><ul><ol><li><blockquote><code><pre><img><br><hr>');

        return view('post', ['post' => $post]);
    }

 
    public function deletePost(Post $post)
    {
        // if(auth()->user()->cannot('delete', $post)){
        //     //You can check this using browser inspector and changing the id of the post to be deleted...
        //     return 'You are not allowed to delete this post.';
        // }
        $post->delete();
        return redirect('/profile/' . auth()->user()->username)->with('success', 'Post successfully deleted.');
    }

    public function showEditForm(Post $post)
    {
        return view('edit-post', ['post' => $post]);
    }

}
