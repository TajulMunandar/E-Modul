@extends('main.component.main')

@section('content')
    <div class="row d-flex">
        <div class="col-lg-5 col-md-12">
            <p class="hastag" data-aos="fade-right" data-aos-duration="1000">#PejuangIlmu</p>
            <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">Bangun
                Masa Depanmu Dengan Ilmu</h2>
        </div>
    </div>
    <div class="row w-100" data-aos="fade-up" data-aos-duration="1000">
        <div class="col w-100">
            <nav class="navbar navbar-expand-lg">
                <div class="navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
@endsection

@section('script')
    AOS.init();
@endsection
