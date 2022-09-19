<nav class="navbar shadow w-full justify-end bg-base-100">
    <div class="flex-1">
        <a href="{{ route('index') }}" class="btn btn-ghost normal-case text-xl">SurveyServ</a>
    </div>
    @auth
        <div class="self-end">
            <a href="{{ route('logout') }}" class="btn btn-ghost normal-case">Logout</a>
        </div>
    @else
        <div class="self-end">
            <a href="{{ route('login') }}" class="btn btn-ghost normal-case">Login</a>
        </div>
    @endauth
    <div>
        <x-theme-change with-label />
    </div>
</nav>
