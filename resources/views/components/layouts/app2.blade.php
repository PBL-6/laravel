<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('style/app2.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"/>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
    <link
        href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css"
        rel="stylesheet"
    />
    <title>{{ $title ?? 'Page Title' }}</title>
    <style>
        .nav-link.active {
            color: #005A65 !important;
        }
    </style>
</head>
<body>
@include('components.layouts.header2')
<div class="content">
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0">Welcome, Admin</span>
            <!-- <div class="navbar-item">
              <form>
              <div  class="search">
                <i class="bi-nav bi-search"></i>
                <input class="search-input" type="search" placeholder="Cari apapun disini">
              </div>
            </form>
            <div class="notif">
              <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
            </div>
            <div class="profile">
              <i class="bi bi-person-circle" style="font-size: 2.5rem;"></i>
            </div>
            </div> -->
        </div>
    </nav>
    @yield('main', $slot ?? '')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" data-navigate-once></script>
<script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        window.addEventListener('toast', event => {
            iziToast.show({
                message: event.detail.message,
                color: event.detail.success === true ? 'green' : 'red',
                close: true,
                position: 'topCenter',
                timeout: 5000,
                progressBar: false,
                animateInside: false,
            });
        });
    });
</script>
</body>
</html>
