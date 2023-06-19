<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Validation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('user/login');
    }
    public function create()
    {
        return view('user/create');
    }
    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6'],
        ]);
        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['profilePicture'] = "https://static.wikia.nocookie.net/villainsfanon/images/4/4e/Troll-Face-Meme-PNG.png/revision/latest/scale-to-width-down/1200?cb=20190104124219";
        $user = User::create($formFields);
        auth()->login($user);
        return redirect("/");
    }

    public function authenticate(Request $request)
    {
        //dd($request);
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);
        if(auth()->attempt($formFields))
        {
            $request->session()->regenerate();
            return redirect('/user');
        }
        else{
            return back()->withErrors(['email' => "invalid credentials"])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where('user', $id)->get();
        //dd($user);
        return view('/user/profile', ['user' => $user, 'posts' => $posts]);
    }

    public function search(Request $request)
{
    $searchTerm = $request->input('search');
    //dd($request->all());
    $users = User::where('name', 'like', '%' . $searchTerm . '%')
             ->get();
    //dd($users);
    return view('/user/search')->with('users', $users);
}
    public function edit(Request $request, $id)
    {
        // Make sure logged in user is owner
        if($id != auth()->id())
        {
            abort(403, 'Unauthorized action');
        }
        else{
            $user = User::findOrFail($id);
            //dd($request);
        if($request->hasFile('picture'))
        {
            $user['profilePicture'] = $request->file('picture')->store('images', 'public');
        }
        $user['name'] = $request->name;
        $user['description'] = $request->description;
        $user->save();
        }

        return redirect('/user/profile/'.$id);

    }
    public function follow(User $user, User $follow)
    {
        DB::table('follows')->insert([
            'follower_id' => $user->id,
            'follows_id' => $follow->id,
            'created_at' => now()
        ]);
        return redirect()->back();
    }
    public function unfollow(User $user, User $follow)
    {
        DB::table('follows')
        ->where('follower_id', $user->id)
        ->where('follows_id', $follow->id)
        ->delete();

        return redirect()->back();
    }
    public function following(User $user)
    {
        $following = DB::table('follows')
        ->where('follower_id', $user->id)
        ->pluck('follows_id')
        ->toArray();
        $users = User::WhereIn('id', $following)
        ->get();
        return view('/user/search')->with('users', $users);
    }
    public function followers(User $user)
    {
        $following = DB::table('follows')
        ->where('follows_id', $user->id)
        ->pluck('follower_id')
        ->toArray();
        $users = User::WhereIn('id', $following)
        ->get();
        return view('/user/search')->with('users', $users);
    }

}
