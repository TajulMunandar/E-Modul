<nav class="navbar-classic navbar navbar-expand-lg">
    <a id="nav-toggle" href="#">
        <i class="fa-solid fa-bars fa-sm"></i>
    </a>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0 h4 fw-semibold ms-3">@yield('page-heading')</h1>
    </div>
    <div class="ms-lg-3 d-none d-md-none d-lg-block">
    </div>

    <!--Navbar nav -->
    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
        <!-- List -->
        <li class="dropdown ms-2">
            <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                    @if (auth()->user()->image)
                        <img alt="avatar" src="{{ asset('storage/' . auth()->user()->image) }}" class="rounded-circle" />
                    @else
                        <img alt="avatar" src="{{ asset('images/avatar.png') }}" class="rounded-circle" />
                    @endif
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                <div class="px-4 pb-0 pt-2">
                    <div class="lh-1 mb-2">
                        <h5 class="mb-4">{{ auth()->user()->name }}</h5>
                        <a href="/profile">Profile</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
