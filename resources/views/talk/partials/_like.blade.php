<button
    type="button"
    id="like"
    class="btn btn-success btn-xs"
    data-like-url="{{ route('like.store', $talk->id)}}"
    data-unlike-url="{{ route('like.destroy', $talk->id) }}"
    data-status="{{ $liked ? '1' : '0' }}">
    {{ $liked ? 'Unlike' : 'Like' }}
</button>
