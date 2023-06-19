<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $users = User::all();
        return view('post/index')->with(['posts' => $posts, 'users' => $users]);
    }
    public function feed()
    {
        //dd(Post::all());
        $user = Auth::User();

        $followingUserId = DB::table('follows')
        ->where('follower_id', $user->id)
        ->pluck('follows_id')
        ->toArray();

        $posts = DB::table('posts')
        ->whereIn('user', $followingUserId)
        ->get();
        //dd($posts);
        $users = User::whereNotIn('id', $followingUserId)
        ->whereNot('id', $user->id)
        ->get();
        return view('post/index')->with(['posts' => $posts, 'users' => $users]);
    }
    public function store(Request $request)
    {
        //dd($request->user()->id);
        $formFields = $request->validate([
            'picture' => 'required',
            'description' => '',
            'location' => '',
        ]);
        $formFields['picture'] = $request->file('picture')->store('images', 'public');
        $formFields['user'] = $request->user()->id;
        $formFields['like_count'] = 0;
        //dd($formFields);
        Post::create($formFields);

        return redirect('/')->with('message', 'Post created successfully!');
    }
    public function like(Post $post)
    {
        $user = Auth::user();
        DB::table('likes')->insert(
            [
                'post_id' => $post->id,
                'user_id' => $user->id,
                'created_at' => now()
            ]
            );
        return back()->with('likedPostId', $post->id);;
    }
    public function unlike(Post $post)
    {
        $user = Auth::user();
        DB::table('likes')->
        where('post_id', $post->id)->
        where('user_id', $user->id)->
        delete();

        return back()->with('likedPostId', $post->id);
    }
    public function comment(Post $post, Request $request)
    {
        $user = Auth::user();
        DB::table('comments')->insert(
            [
                'post_id' => $post->id,
                'user_id' => $user->id,
                'comment' => $request->comment,
                'created_at' => now()
            ]
            );
        return back()->with('likedPostId', $post->id);;
    }
}
