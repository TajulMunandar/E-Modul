@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-12">
                <p class="hastag" data-aos="fade-right" data-aos-duration="1000">#PejuangIlmu</p>
                <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">Bangun
                    Masa Depanmu Dengan Ilmu</h2>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-duration="1000">
            <div class="col">
                <nav class="navbar navbar-expand-lg">
                    <div class="navbar-collapse fs-5 fw-bold">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 slider">
                            <li class="nav-item me-5">
                                <a class="nav-link" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item me-5">
                                <a class="nav-link" href="#">Link</a>
                            </li>

                        </ul>
                        <a href="">Semua</a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row p-5 h-100" data-aos="fade-up" data-aos-duration="1500">
            <div class="col mb-3">
                <div class="card" style="width: 22rem;">
                    <div class="card-body">
                        <img src="{{ asset('images/avatar.png') }}" class="card-img-top" alt="..." style="height: 12rem; object-fit: cover">
                        <a class="card-title fw-bold text-black fs-4 stretched-link" href="/pramateri" style="text-decoration: none">Card title</a>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('main.component.footer')
@endsection

@section('script')
    AOS.init();
@endsection
