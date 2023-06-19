<dialog id="popUpEditProfileModal">
    <form action="/user/profile/{{$user->id}}/edit" method = "POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class ="create_post_popUp" style = "justify-content: center; align-items:center">
            <div class="popupContainer" style="justify-content: center; align-items: center; width: 70%; height: fit-content; display: flex; flex-direction: column; background-color: #e5dcdc;">
                <div style="position: absolute; top:0%; left:67%">
                <a onclick="hideEditProfileModal()" style="cursor: pointer; position: absolute; top: 0%; right: 3%;"><i class="fa-solid fa-x"></i>
                </a>
            </div>
            <h2 class="createHeading">Edit your profile</h2>
            <div class = "addElement">
                <label for="picture">Add a profile picture: </label>
                <input
                    type="file"
                    name="picture"
                    value="{{ $user->profilePicture ? asset('storage/'.$user->profilePicture) : '' }}"
                />
                <img src="{{ $user->profilePicture ? asset('storage/'.$user->profilePicture) : asset('images/GramstaLogo.png') }}" alt="Profile Picture" style="width: 200px; height: 200px; margin-right: 6px; margin-bottom: 6px;">
                @error('picture')
                <script>
                    window.addEventListener('DOMContentLoaded', function() {
                        showCreatePostModal();
                    });
                </script>
                        <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class= "addElement">
                <label for="description">Write a description: </label>
                <input
                    type ="text"
                    name = "description"
                    value = "{{$user->description}}"
                />
                @error('description')
                <script>
                    showCreatePostModal();
                </script>
                        <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class= "addElement">
                <label for="name">Change your name</label>
                <input
                    type ="text"
                    name = "name"
                    value = "{{$user->name}}"
                />
                @error('name')
                <script>
                    showCreatePostModal();
                </script>
                        <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="addElement">
            <button type="submit">Post</button>
        </div>
        </div>
    </div>
    </form>
</dialog>
