<div class="gallery-item" tabindex="0" style="position:relative flex-basis: calc(33.33% - 20px);
margin-bottom: 200px;">

            <img src="{{asset('storage/'.$post->picture)}}" class="gallery-image" alt="IMAGE" style="width:200px; height:200px;">

            <div class="gallery-item-info" style="position:absolute;">

              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> {{$post->like_count}}</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
              </ul>

            </div>
</div>
