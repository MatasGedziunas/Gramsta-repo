<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/7da298f918.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('cssStyles/profile-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('cssStyles/header.css') }}">
    <link rel="stylesheet" href="{{ asset('cssStyles/createPost.css') }}">

    <link rel="icon" href="{{ asset('images/GramstaLogo_32x32.png') }}" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Gramsta</title>
</head>
<style>
    .logout-button {
      background: none;
      border: none;
      cursor: pointer;
    }
  </style>
  <script>
    // JavaScript code to scroll down to the liked post
    window.onload = function() {
        // Get the post ID from the PHP response
        const likedPostId = "{{ session('likedPostId') }}";

        // Scroll to the liked post if the ID is present
        if (likedPostId) {
            const postElement = document.getElementById("post-" + likedPostId);
            if (postElement) {
                postElement.scrollIntoView({ behavior: 'auto' });
            }
        }
    };
    function showCreatePostModal()
    {
        let CreatePostModal = document.querySelector('#popUpCreateModal');
        CreatePostModal.show();
    }

    function hideCreatePostModal()
    {
        let CreatePostModal = document.querySelector('#popUpCreateModal');
        CreatePostModal.close();
    }
    function showEditProfileModal()
    {
        let EditProfileModalPostModal = document.querySelector('#popUpEditProfileModal');

        EditProfileModalPostModal.show();
    }
    function hideEditProfileModal()
    {
        let EditProfileModalPostModal = document.querySelector('#popUpEditProfileModal');

        EditProfileModalPostModal.close();
    }
    function addlike(postId)
    {
        window.location.href = '/post/'+postId+'/like';
    }
    function showCommentsModal(postId)
    {
        let commentsSection = document.querySelector('#comments-' + postId);
        let allComments  = document.querySelector('#allComments-' + postId);
        if(commentsSection.style.display == 'block')
        {
            commentsSection.style.display = 'none';
            allComments.style.display = 'block';
        }
        else{
            commentsSection.style.display = 'block';
            allComments.style.display = 'none';
        }
    }
    function redirectToHomePage() {
        const mainPageUrl = '/user'; // Replace with the URL of your main page
        const currentUrl = window.location.href;

        if (!currentUrl.includes(mainPageUrl)) {
            // Redirect to the main page
            window.location.href = mainPageUrl;
        } else {
            // Wait for the redirect to complete, then show the create post modal
            showCreatePostModal();
        }
    }
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

</script>
<body>
<header>
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                @guest
                <a href="/">
                  <img src=
"{{asset("images/GramstaLogo_32x32.png")}}" width = "50px" style="margin-left:0px"
                    alt="img1">
                @endguest
                @auth
                <a href="/user">
                    <img src=
  "{{asset("images/GramstaLogo_32x32.png")}}" width = "50px" style="margin-left:0px"
                      alt="img1">
                @endauth
                </a>
            </div>
            <div class="searchbar">
                <form action="/search" method="GET">
                    @csrf
                    <div style="display: flex; align-items: center;">
                        <input type="text" name="search" placeholder="Search" style="margin-top: 15px;" />
                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                          <i class="fa-solid fa-magnifying-glass" style="font-size: 15px; margin-left:10px"></i>
                        </button>
                      </div>

                </form>
            </div>
            <div class="nav-links">
                <ul class="nav-group" style = "list-style:none">
                    @auth
                    <li class="nav-item">
                        <a onclick="redirectToHomePage()" style="cursor: pointer">
                           <i class="fa-solid fa-plus"></i>POST
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/user">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/chatify">
                            <i class="fab fa-facebook-messenger"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/">
                            <i class="far fa-compass"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="scrollToTop()" style="cursor: pointer">
                            <i class="far fa-heart"></i>
                        </a>
                    </li>
                    @endauth

                        @guest
                        <li class="nav-item">
                            <a href="/user">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                        <a href="/user/login">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                        <a href="/user/profile/{{auth()->id()}}">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>
                        @endauth

                    @auth
                    <form class="inline" method="POST" action="/user/logout">
                        @csrf
                        <li class="nav-item">
                          <button type="submit" name="submit" class="logout-button">
                            <i class="fa-solid fa-right-from-bracket" style="font-size:18px"></i>
                          </button>
                        </li>
                      </form>
                    @endauth


                    @guest
                    <li class="nav-item">
                        <a href="/user/create">
                            <i class="fa-solid fa-user-plus"></i>
                        </a>
                    </li>
                    @endguest
                    <li>
                        <div class="footer" style="margin-left: 20px">
                            {{-- <a class="footer-section" href="#">About</a>
                            <a class="footer-section" href="#">Help</a>
                            <a class="footer-section" href="#">API</a>
                            <a class="footer-section" href="#">Jobs</a>
                            <a class="footer-section" href="#">Privacy</a>
                            <a class="footer-section" href="#">Terms</a>
                            <a class="footer-section" href="#">Locations</a>
                            <br>
                            <a class="footer-section" href="#">Top Accounts</a>
                            <a class="footer-section" href="#">Hashtag</a>
                            <a class="footer-section" href="#">Language</a>
                            <br><br> --}}
                            <span class="footer-section">
                                © 2023 INSTAGRAM FROM FACEBOOK
                            </span>
                        </div>
                    </li>
                </ul>

            </div>

        </div>
        <hr>
    </nav>
</header>
    {{$slot}}

</body>
</html>
