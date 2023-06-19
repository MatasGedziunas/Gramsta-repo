<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'picture',
        'description',
        'location',
        'user',
        'like_count'
    ];

    public static function hasLiked($post_id, $user_id)
    {
        $return = DB::table('likes')
        ->where('post_id', $post_id)
        ->where('user_id', $user_id)
        ->first();
        return $return != null;
    }

    public static function likeCount($post_id)
    {
        $return = DB::table('likes')
        ->where('post_id', $post_id)
        ->count();

        return $return;
    }

    public static function getComments($post_id)
    {
        $data = DB::table('comments')
        ->where('post_id', $post_id)
        ->get();
        return $data;
    }

    public static function getCommentsCount($post_id)
    {
        $data = DB::table('comments')
        ->where('post_id', $post_id)
        ->count();
        return $data;
    }
}
