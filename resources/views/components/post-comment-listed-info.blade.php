<li style="margin-bottom: 5px;">
    <div style="display: flex">
        <a href="/user/profile/{{$user->id}}">
            <img src="{{asset('storage/'.$user->profilePicture)}}" alt="img8" style="width: 20px; height: 20px;">
        </a>
        <a href="/user/profile/{{$user->id}}"><p style="margin-left: 2px; font-size:12px"> {{$user->name}}</p></a>
    </div>
    <p style="font-size: 12px">{{$text}}</p>
</li>
