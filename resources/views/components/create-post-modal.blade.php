<dialog id="popUpCreateModal">
    <form action="/post" method = "POST" enctype="multipart/form-data">
        @csrf
    <div class ="create_post_popUp" style = "justify-content: center; align-items:center">
        <div class="popupContainer" style="justify-content: center; align-items: center; width: 70%; height: fit-content; display: flex; flex-direction: column; background-color: #e5dcdc;">
            <!-- Content goes here -->
            <div style="position: absolute; top:0%; left:67%">
                <a onclick="hideCreatePostModal()" style="cursor: pointer; position: absolute; top: 0%; right: 3%;"><i class="fa-solid fa-x"></i>
                </a>
            </div>
            <h2 class="createHeading">Create a post</h2>
            <div class = "addElement">
                <label for="picture">Add a picture: </label>
                <input
                    type="file"
                    name="picture"
                    value= "{{old('picture')}}"
                />
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
                    value = "{{old('description')}}"
                />
                @error('description')
                <script>
                    showCreatePostModal();
                </script>
                        <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class= "addElement">
                <label for="location">Display your location:</label>
                <input
                    type ="text"
                    name = "location"
                    value = "{{old('location')}}"
                />
                @error('location')
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
