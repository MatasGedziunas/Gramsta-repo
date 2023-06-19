<ul style="list-style-type: none; padding: 0; margin: 0;">
    @foreach($comments as $comment)
        <x-post-comment-listed-info :user="\App\Models\User::findOrFail($comment->user_id)" text="{{ $comment->comment }}" />
    @endforeach
</ul>
