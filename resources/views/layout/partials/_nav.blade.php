<div>
    <div>
        {{ env('APP_NAME') }}
    </div>
    <div>
    @auth
        <form action="{{ route('auth.login.destroy') }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit">Logout</button>
        </form>
    @else
        <div>
            <a href="{{ route('auth.login.create') }}">Login</a>
            <a href="{{ route('auth.register.create') }}">Register</a>
        </div>
    @endauth
    </div>
</div>
