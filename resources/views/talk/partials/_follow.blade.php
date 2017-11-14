<button
    type="button"
    id="follow"
    class="btn btn-info btn-xs"
    data-follow-url="{{ route('follow.store', $talk->user->id)}}"
    data-unfollow-url="{{ route('follow.destroy', $talk->user->id) }}"
    data-status="{{ $following ? '1' : '0' }}">
    {{ $following ? 'Unfollow' : 'Follow' }}
</button>
