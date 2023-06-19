<ul>
    <li><span class="profile-stat-count">{{$user->postCount()}}</span> posts</li>
    <li><a href="/user/profile/{{$user->id}}/followers" class="profile-stat-count" style="color:inherit; text-decoration:none;">{{$user->followerCount()}} followers</a></li>
    <li><a href="/user/profile/{{$user->id}}/following" class="profile-stat-count" style="color:inherit; text-decoration:none;">{{$user->followingCount()}} following</a></li>
</ul>
