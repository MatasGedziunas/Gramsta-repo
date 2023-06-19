<x-header/>
<head>
    <link rel="stylesheet" href="{{asset('cssStyles/createUserProfile.css')}}">
</head>
<body>
    <span id="root" style="display:flex;justify-content:center;align-items:center">
        <section class="section-all" id="section" style="display:flex;justify-content:center;align-items:stretch">

        <!-- 1-Role Main -->
        <main id="main" class="main" role="main">
          <div class="wrapper" id="div">
            <article class="article" id="article">
              <div class="content" id ="div">
                <div class="login-box" id ="div">
                  <div class="header" id ="div">
                    <img class="logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1200px-Instagram_logo.svg.png" alt="Instagram">
                  </div><!-- Header end -->
                  <div class="form-wrap"  id ="div">
                    <form class="form" method="POST" action="/user/authenticate">
                        @csrf
                          <div class="input-box"  id ="div">
                            <input type="text" id = "email" value="{{old('email')}}" name="email" aria-describedby="" placeholder="Email" aria-required="true" maxlength="30" autocapitalize="off" autocorrect="off" value="" required>
                            @error('email')
                            <p class="error-message">{{$message}}</p>
                          @enderror
                        </div>

                          <div class="input-box"  id ="div">
                            <input type="password" name="password" id="password" value="{{old('password')}}" placeholder="Password" aria-describedby="" maxlength="30" aria-required="true" autocapitalize="off" autocorrect="off" required>
                            @error('password')
                            <p class="error-message">{{$message}}</p>
                          @enderror
                        </div>
                        <span class="button-box">
                            <button class="btn" type="submit" name="submit">Log in</button>
                          </span>
                      <a class="forgot" href="">Forgot password?</a>
                    </form>
                  </div> <!-- Form-wrap end -->
                </div> <!-- Login-box end -->

                <div class="login-box"  id ="div">
                  <p class="text">Don't have an account?<a href="/user/create">Sign up</a></p>
                </div> <!-- Signup-box end -->
              </div> <!-- Content end -->
            </article>
          </div> <!-- Wrapper end -->
        </main>

        <!-- 2-Role Footer -->


      </section>
    </span> <!-- Root -->

    <!-- Select Link -->
    <script type="text/javascript">
      function la(src) {
        window.location=src;
      }
    </script>
  </body>
