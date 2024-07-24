<link rel="stylesheet" href="{{asset('style/app2.css')}}">
<div class="sidebar d-flex flex-column p-3">
{{--    <a href="/" class="d-flex justify-content-center">--}}
{{--        <img src="{{asset('img/logopnj.png')}}" class="" width="100" alt="">--}}
{{--    </a>--}}
    <span class="fs-4">CoverMatch</span>
    <span class="fs-6">Admin Dashboard</span>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{route('admin.home')}}" class="nav-link {{request()->routeIs('admin.home') ? 'active' : ''}}" style="background-color: {{request()->routeIs('admin.home') ? '#008797' : ''}};" wire:navigate>
                <i class="bi{{request()->routeIs('admin.home') ? '-act' : ''}} bi-columns-gap" style="font-size: 1.3rem;"></i>
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                <span class="text-nav{{request()->routeIs('admin.home') ? '-act' : ''}}">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route('admin.book.index')}}" class="nav-link {{request()->routeIs('admin.book.index') || request()->routeIs('admin.book.create') || request()->routeIs('admin.book.edit') ? 'active' : ''}}" wire:navigate style="background-color: {{request()->routeIs('admin.book.index') || request()->routeIs('admin.book.create') || request()->routeIs('admin.book.edit') ?  '#008797' : ''}};">
                <i class="bi{{request()->routeIs('admin.book.index') || request()->routeIs('admin.book.create') || request()->routeIs('admin.book.edit') ? '-act' : ''}} bi-journal-bookmark" style="font-size: 1.3rem;"></i>
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                <span class="text-nav{{request()->routeIs('admin.book.index') || request()->routeIs('admin.book.create') || request()->routeIs('admin.book.edit') ? '-act' : ''}}">Books</span>
            </a>
        </li>
    </ul>
    <ul class="nav nav-pills flex-column me-auto">
        <li>
            <a href="{{route('admin.logout')}}" class="nav-link link-body-emphasis">
                <i class="bi bi-box-arrow-right" style="font-size: 1.3rem;"></i>
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                <span class="text-nav">Logout</span>
            </a>
        </li>
    </ul>
</div>
