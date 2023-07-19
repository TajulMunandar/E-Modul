<nav class="navbar-vertical navbar">
    <div class="nav-scroller flex-column d-flex justify-content-between">
        <!-- Brand logo -->
        <a class="navbar-brand text-center fw-bold" href="/dashboard" style="color: #DDE6ED">E-<span style="color: #64CCC5">Modul</span></a>

        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-chart-pie me-3 nav-icon"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/materi') ? 'active' : '' }}" href="{{ route('materi.index') }}">
                    <i class="fa-solid fa-file me-4 nav-icon"></i>
                    Materi
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/quizz*') ? 'active' : '' }}" href="#!"
                    data-bs-toggle="collapse" data-bs-target="#navQuizz" aria-expanded="false" aria-controls="navQuizz">
                    <i class="fa-solid fa-briefcase me-3 nav-icon"></i>
                    Quizz
                </a>
                <div id="navQuizz" class="collapse {{ Request::is('dashboard/quizz*') ? 'show' : '' }}"
                    data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/quizz/choice*') ? 'active' : '' }}"
                                href="">
                                Choice
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/quizz/essay*') ? 'active' : '' }}"
                                href="">
                                Essay
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/penilaian*') ? 'active' : '' }}" href="#!"
                    data-bs-toggle="collapse" data-bs-target="#navPenilaian" aria-expanded="false"
                    aria-controls="navPenilaian">
                    <i class="fa-solid fa-calculator me-4 nav-icon"></i>
                    Penilaian
                </a>
                <div id="navPenilaian" class="collapse {{ Request::is('dashboard/penilaian*') ? 'show' : '' }}"
                    data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/penilaian/choice*') ? 'active' : '' }}"
                                href="">
                                Choice
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/penilaian/essay*') ? 'active' : '' }}"
                                href="">
                                Essay
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <hr class="mx-3">

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/modul') ? 'active' : '' }}" href="{{ route('modul.index') }}">
                    <i class="fa-solid fa-book me-3 nav-icon"></i>
                    Modul
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/category') ? 'active' : '' }}" href="{{ route('category.index') }}">
                    <i class="fa-solid fa-book me-3 nav-icon"></i>
                    Category
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/user') ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <i class="fa-solid fa-user me-3 nav-icon"></i>
                    User
                </a>
            </li>

        </ul>

        <div class="nav-item mt-auto mb-5">
            <form action="/logout" method="post" class="d-grid">
                @csrf
                <button class="btn btn-outline-secondary d-block mx-4" style="color: #64CCC5">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2 nav-icon"></i>
                    Keluar
                </button>
            </form>
        </div>

    </div>
</nav>
