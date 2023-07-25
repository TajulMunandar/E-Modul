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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Materi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Quiz</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row p-5 h-100" data-aos="fade-up" data-aos-duration="1500">
            <div class="col mb-3">
                <div class="card" style="width: 22rem;">
                    <img src="{{ asset('images/avatar.png') }}" class="card-img-top" alt="..." style="height: 50%">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Card title</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque fugiat earum facere.</p>
                        <a href="/materi" class="btn btn-primary stretched-link float-end">Mulai</a>
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
