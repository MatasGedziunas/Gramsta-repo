<div id="comments-{{ $post->id }}" style="display: none">
    <div style="background-color: inherit; border: 1px solid #ccc; padding: 20px; border-radius: 5px; width: 800px; max-width: 100%;">
        <div>
        <h3 style="font-size: 18px; margin-bottom: 10px;">Comments</h3>
        <x-post-comments-listed :comments="\App\Models\Post::getComments($post->id)"/>
        </div>
        <button onclick="closeCommentsModal()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; cursor: pointer;">
            <span style="font-size: 18px;">&times;</span>
        </button>
    </div>
</div>
