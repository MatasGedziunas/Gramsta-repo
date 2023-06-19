@props(['user', 'posts'])
<x-header>
 <x-profile-section :user="$user"/>
 <style>
    .galerry-item {
      flex-basis: calc(33.33% - 20px);
      margin-bottom: 20px;
      /* Adjust the flex-basis percentage and margin as needed */
    }

    .edit-profile-modal {
      flex-basis: 100%;
      /* Adjust the flex-basis percentage as needed */
    }
  </style>
    <main>

      <div class="container">

        <div class="gallery" style="display: flex; flex-wrap: wrap; justify-content: space-between; width: 70%">
            @foreach($posts as $post)
              <x-profile-post-card :post="$post" class="post-card" />
            @endforeach

            <x-edit-profile-modal :user="$user" class="edit-profile-modal" />
          </div>



        </div>
        <!-- End of gallery -->

      </div>
      <!-- End of container -->
    </div>
</x-header>


