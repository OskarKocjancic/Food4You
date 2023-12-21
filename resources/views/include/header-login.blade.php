{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="">@yield('header-title')</a>
    </div>
</nav> --}}

<nav class="navbar navbar-expand-* navbar-dark" style="background-color: #C6E593;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('login') }}"> 
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-top">
            <span class="align-middle">@yield('header-title')</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>
