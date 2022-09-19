<nav class="navbar w-full justify-end bg-base-300">
    <div class="flex-1">
        <a href="/" class="btn btn-ghost normal-case text-xl">SurveyServ</a>
    </div>
    @auth
        <div class="self-end">
            <a href="{{ route('logout') }}" class="btn btn-ghost normal-case text-xl">Logout</a>
        </div>
    @else
        <div class="self-end">
            <a href="{{ route('login') }}" class="btn btn-ghost normal-case text-xl">Login</a>
        </div>
    @endauth
    <div>
        <x-theme-change with-label />
    </div>
</nav>
