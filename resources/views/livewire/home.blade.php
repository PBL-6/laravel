<div>
    <div class="container mt-4">
        <div>
            <a href="{{route('search')}}" wire:navigate>Search book</a>
        </div>
        <div>
            <a href="{{route('search.history')}}" wire:navigate>Search book history</a>
        </div>
        <div>
            @auth
                <a href="{{route('admin.home')}}" wire:navigate>Dashboard</a>
            @else
                <a href="{{route('login')}}" wire:navigate>Login</a>
            @endauth
        </div>
    </div>
</div>
