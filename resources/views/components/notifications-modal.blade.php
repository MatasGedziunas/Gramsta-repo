<div style="position: absolute; margin-top: 50px; margin-left:850px;">
    <div style="background-color: inherit; border: 1px solid #ccc; padding: 20px; border-radius: 5px; width: 300px; max-width: 100%;">
        <div>
        <h3 style="font-size: 18px; margin-bottom: 10px;">Notifications</h3>
            @foreach($events as $event)
                @if (isset($event->commentUserId))
                <!-- This is a comment event -->
                    <div style="margin-bottom:10px">
                        <p>Comment: {{ $event->comment }}</p>
                        <p>Posted by: <a style="cursor: pointer; font-size:12px; font-weight:bold" href="/user/profile/{{$event->commentUserId}}">{{ $event->commentUserName }}</a></p>
                        <p>Posted at: {{ $event->created_at }}</p>
                    </div>
                @elseif (isset($event->follower_id))
                <!-- This is a follow event -->
                <div style="margin-bottom:10px">
                    <p><a style="cursor: pointer; font-size:12px; font-weight:bold" href="/user/profile/{{$event->followedNameID}}">{{ $event->followedName}}</a> started following you.</p>
                    <p>Followed at: {{ $event->created_at }}</p>
                </div>
                @elseif (isset($event->likeUserId))
                <!-- This is a like event -->
                <div style="margin-bottom:10px">
                    <p><a style="cursor: pointer; font-size:12px; font-weight:bold" href="/user/profile/{{$event->likeUserId}}">{{ $event->likeUserName}}</a> liked your post.</p>
                    <p>Liked at: {{ $event->created_at }}</p>
                </div>

                @endif
            @endforeach
        </div>
    </div>
</div>
