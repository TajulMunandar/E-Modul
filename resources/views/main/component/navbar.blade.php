<nav class="navbar p-4">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="/">E-Modul</a>
        @if (auth()->user())
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn btn-login dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <form action="/logout" method="post">
                            @csrf
                            <li><button type="submit" class="dropdown-item">Logout</button></li>
                        </form>
                    </ul>
                  </div>
            </div>
        @else
            <div class="d-flex">
                <a class="btn btn-login" href="/login">Login</a>
            </div>
        @endif
    </div>
</nav>
