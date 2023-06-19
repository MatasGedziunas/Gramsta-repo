<header>

    <div class="container">

      <div class="profile" style="padding-top:10rem">

        <div class="profile-image">

            <img src="{{ $user->profilePicture ? asset('storage/'.$user->profilePicture) : asset('images/GramstaLogo.png') }}" alt="Profile Picture" style="width: 300px; height: 200px;margin-left:180px">

        </div>

        <div class="profile-user-settings">

          <h1 class="profile-user-name">{{$user->name}}</h1>
            @if(auth()->id() == $user->id)
          <button class="btn profile-edit-btn" onclick="showEditProfileModal()">Edit Profile</button>

          <button class="btn profile-settings-btn" aria-label="profile settings" onclick="showEditProfileModal()"><i class="fas fa-cog" aria-hidden="true"></i></button>

          @else
          @guest
          <a class="btn profile-edit-btn" href="/user/login">Follow</a>
        @endguest
        @auth
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
        @endauth
        @endif

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
