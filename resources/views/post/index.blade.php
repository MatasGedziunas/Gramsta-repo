<x-header>
    <main>
        <div class="container">


                @if(!$posts->isEmpty())
                <div class ="col-9">
                    @auth
                    <x-notifications-modal :events="\App\Models\User::getEvents(auth()->id())"/>
                    @endauth
                @foreach ($posts as $post)
                @php
                    $user = \App\Models\User::findOrFail($post->user);
                @endphp
                    <x-post-card :post="$post" :user="$user"/>
                @endforeach

                </div>
                @else

                <div style="align-items:center; justify-content:center">
                    <h5 style="font-size:32px; text-align:center; padding-top:40px">Considering following:</h5>
                    @foreach($users as $user)
                        <x-profile-section :user="$user"/>
                    @endforeach
                </div>

                @endif

            </div>
            <x-create-post-modal/>

    </main>
</x-header>

