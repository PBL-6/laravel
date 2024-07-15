<header class="p-3">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 fw-bold">
                <li><a href="{{route('home')}}" class="nav-link {{ request()->routeIs('home') ? 'active' : 'text-white' }}" wire:navigate>CoverMatch</a></li>
                <li><a href="{{route('search')}}" class="nav-link {{ request()->routeIs('search') || request()->routeIs('search.result') || request()->routeIs('search.detail') ? 'active' : 'text-white' }}" wire:navigate>Search</a></li>
                <li><a href="{{route('search.history')}}" class="nav-link {{ request()->routeIs('search.history') ? 'active' : 'text-white' }}" wire:navigate>History</a></li>
                <li><a href="#" class="nav-link text-white">FAQs</a></li>
            </ul>
            <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0 fw-bold float-end">
                @auth
                    <li><a href="{{route('admin.logout')}}" class="nav-link text-white" wire:navigate>Logout</a></li>
                @else
                    <li><a href="{{route('login')}}" class="nav-link {{ request()->routeIs('login') ? 'active' : 'text-white' }}" wire:navigate>Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</header>

