<div class="flex w-full flex-row justify-between py-8">
    <div>
        <a href="" class="text-3xl">Idea</a>
    </div>
    <div class="flex flex-row items-center gap-4">
        @auth
            <form method="POST" action="/logout">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn">Logout</button>
            </form>
        @endauth

        @guest
            <a href="/login">Login</a>
            <a href="/register" class="btn">Register</a>
        @endguest
    </div>
</div>
