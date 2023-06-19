<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // $table->id();
    //         $table->string('name');
    //         $table->string('email')->unique();
    //         $table->timestamp('email_verified_at')->nullable();
    //         $table->string('password');
    //         $table->rememberToken();
    //         $table->timestamps();
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFeedPosts($id)
    {
        $followingUserId = DB::table('follows')
        ->where('follower_id', $id)
        ->pluck('follows_id')
        ->toArray();

        $posts = DB::table('posts')
        ->whereIn('user', $followingUserId)
        ->get();
        dd($this->id);
        return $posts;
    }
    public function  follows(User $user, User $followed)
    {
        $follows = DB::table('follows')
        ->where('follower_id', $user->id)
        ->where('follows_id', $followed->id)
        ->first();

        return $follows !== null;
    }
    public function followerCount()
    {
        $count = DB::table('follows')
        ->where('follows_id', $this->id)
        ->count();

        return $count;
    }
    public function followingCount()
    {
        $count = DB::table('follows')
        ->where('follower_id', $this->id)
        ->count();

        return $count;
    }
    public function postCount()
    {
        $count = DB::table('posts')
        ->where('user', $this->id)
        ->count();

        return $count;
    }
    public static function getEvents($id)
    {
        $follow = DB::table('follows')
        ->where('follows_id', $id)
        ->join('users', 'follows.follower_id', '=', 'users.id')
        ->select('follows.*', 'users.name as followedName')
        ->get();
        $comment = DB::table('posts')
        ->where('user', $id)
        ->join('comments', 'posts.id', '=', 'comments.post_id')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->select('posts.picture', 'users.name as commentUserId', 'comments.created_at', 'comments.comment')
        ->get();
        $like = DB::table('posts')
        ->where('user', $id)
        ->join('likes', 'likes.post_id', '=', 'posts.id')
        ->join('users', 'likes.user_id', '=', 'users.id')
        ->select('posts.picture', 'users.name as likeUserId', 'likes.created_at')
        ->get();
        $events = collect($follow)->concat($comment)->concat($like); // Combine follow, comment, and like events into a single collection
        $sortedEvents = $events->sortBy('created_at');
        return $sortedEvents;
    }
}
