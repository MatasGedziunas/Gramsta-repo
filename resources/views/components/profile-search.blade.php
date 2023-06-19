<header>

    <div class="container">

      <div class="profile" style="padding-top:10rem">

        <div class="profile-image">
            <a href="/user/profile/{{$user->id}}" style="color:inherit; text-decoration:none;">
          <img src="{{$user->profilePicture ? asset("storage/".$user->profilePicture) : asset("images/GramstaLogo.png")}}" alt="Profile Picture">
            </a>
        </div>

        <div class="profile-user-settings">
            <a href="/user/profile/{{$user->id}}">
          <h1 class="profile-user-name">{{$user->name}}</h1>
            </a>
            @auth
            @if($user->id != auth()->id())
            @if($user->follows(auth()->user(), $user))
            <form method="POST" action="/user/{{ auth()->id() }}/unfollow/{{ $user->id }}">
                @csrf
                <button class="btn profile-edit-btn" type="submit">Unfollow</button>
            </form>
            @else
            <form method="POST" action="/user/{{ auth()->id() }}/follow/{{ $user->id }}">
                @csrf
                <button class="btn profile-edit-btn" type="submit">Follow</button>
            </form>
            @endif
            @endif
        @endauth
        </div>

        <div class="profile-stats">

            <x-user-info-list :user="$user"/>

        </div>

        <div class="profile-bio">

          <p><span class="profile-real-name">{{$user->name}}</span> {{$user->description}}</p>

        </div>

      </div>
      <!-- End of profile section -->

    </div>
    <!-- End of container -->

  </header>
