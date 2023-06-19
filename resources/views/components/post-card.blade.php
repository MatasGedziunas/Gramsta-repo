<div class="card" id = "post-{{$post->id}}">
    <div class="top">
        <div class="userDetails">
            <div class="profilepic">
                <div class="profile_img">
                    <div class="image">
                        <a href="/user/profile/{{$user->id}}">
                            <img src="{{$user->profilePicture}}" alt="img8" style="width: 25px; height: 25px;">
                        </a>
                    </div>
                </div>
            </div>
            <a href="/user/profile/{{$user->id}}">
            <h3>{{$user->name}}
                  <br>
                  <span>{{$user->location}}</span>
          </h3>
            </a>
        </div>
        <div>
            <span class="dot">
                <i class="fas fa-ellipsis-h"></i>
            </span>
        </div>
    </div>
    <div class="imgBx">
        <img src=
"{{asset("storage/".$post->picture)}}"
            alt="post-1" class="cover">
    </div>
    <div class="bottom">
        <div class="actionBtns" style="display:flex">
            <div class="left" style="display:inherit">
                @auth
                @if(App\Models\Post::hasLiked($post->id, auth()->id()))
                <form action="/post/{{$post->id}}/unlike" method="POST">
                    @csrf
                    <button type="submit" class="heart" style="text-decoration: none; background: none; border: none; padding: 0; cursor: pointer; margin-right:5px">
                        <i class="fa-solid fa-heart" style="font-size: 24px;"></i>
                    </button>
                </form>
                @else
                <form action="/post/{{$post->id}}/like" method="POST">
                    @csrf
                    <button type="submit" class="heart" style="text-decoration: none; background: none; border: none; padding: 0; cursor: pointer; margin-right:5px">
                        <i class="fa-regular fa-heart" style="font-size: 24px;"></i>
                    </button>
                </form>
                @endif

                    <a onclick="showCommentsModal({{$post->id}})" style="cursor: pointer; margin-right:">
                        <i class="fa-regular fa-comment" style="font-size: 24px;"></i>
                    </a>
                    @endauth
                @guest
                <form action="/user/login" method="GET">
                    @csrf
                    <button type="submit" class="heart" style="text-decoration: none; background: none; border: none; padding: 0; cursor: pointer; margin-right:5px">

                        <i class="fa-regular fa-heart" style="font-size: 24px;"></i>
                    </button>
                    <a onclick="showCommentsModal({{$post->id}})" style="cursor: pointer; margin-right: 5px">
                        <i class="fa-regular fa-comment" style="font-size: 24px;"></i>
                    </a>
                    <button type="submit" style="text-decoration: none; background: none; border: none; padding: 0; cursor: pointer; margin-right:5px">
                        <i class="fa-solid fa-arrow-up" style="font-size: 24px"></i>
                    </button>
                </form>
                @endguest
            </div>
            <div class="right">
                <svg aria-label="Save"
                     class="_8-yf5 "
                     color="#262626"
                     fill="#262626"
                     height="24"
                     role="img"
                     viewBox="0 0 48 48"
                     width="24">

                  <!-- Coordinate path  -->
                    <path
                        d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6
                        47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7
                        3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4
                        1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8
                        0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6
                        1.4-.9 2.2-.9z">
                    </path>
                </svg>
            </div>
        </div>
        <a href="#">
            <p class="likes">{{App\Models\Post::likeCount($post->id)}} likes</p>
        </a>
        <a href="#">
            <p class="message">
              <b>{{$user->name}}</b>
            </p>

        </a>
        <a onclick="showCommentsModal({{$post->id}})" style="cursor: pointer; display:block" id = "allComments-{{$post->id}}">
            <h4 class="comments">View all {{\App\Models\Post::getCommentsCount($post->id)}} comments</h4>
        </a>
        <x-post-comments :post="$post"/>

            <h5 class="postTime">{{\Carbon\Carbon::parse($post->created_at)->timezone('Europe/Vilnius')->diffInHours()}}
            hours ago</h5>

        <div class="addComments" style="width:100%">
            <div class="reaction">
                <h3>
                  <i class="far fa-smile"></i>
                </h3>
            </div>
            @auth
            <form action="/post/{{$post->id}}/comment" method="POST" style="display: flex; justify-content: flex-end; width:800px">
                @csrf
                <textarea name="comment" class="text" placeholder="Add a comment..." style="flex: 1; width: 600px; height: auto; resize: none;"></textarea>
                <button type="submit" style="text-decoration: none; background: none; border: none; padding: 0; cursor: pointer; margin-left: 10px;">
                    Post
                </button>
            </form>
            @endauth
            @guest
            <textarea name="comment" class="text" placeholder="Add a comment..." style="flex: 1; width: 100%; height: auto; resize: none;"></textarea>
            <a href="/user/login">
                Post
            </a>
            @endguest



        </div>
    </div>
</div>
