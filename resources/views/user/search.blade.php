<x-header>
    @if(count($users) > 0)
    @foreach($users as $user)
    <x-profile-search :user="$user"/>
    @endforeach
    @else
    <div class="profile">
        <H5>NO USERS FOUND</H5>
    </div>
    @endif
</x-header>
