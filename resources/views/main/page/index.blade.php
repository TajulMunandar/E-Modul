@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-5 col-md-12">
                <p class="hastag" data-aos="fade-right" data-aos-duration="1000">
                    <a href="https://iain-takengon.ac.id/" target="_blank">
                        <img src="{{ asset('images/logo2.png') }}" alt="" width="75%">
                    </a>
                </p>
                <h1 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">
                    Bangun
                    Masa Depanmu Dengan Ilmu</h1>
                <p class="caption lh-md" data-aos-duration="1400" data-aos="fade-right"> Jelajahi dunia pengetahuan dengan
                    e-learning, platform interaktif yang memungkinkan Anda belajar secara
                    fleksibel.</p>
                <a class="btn btn-primary" href="/modul" data-aos-duration="1600" data-aos="fade-right">MULAI</a>
            </div>
            <div class="col-lg-7 col-md-12 border text-center">
                <img src="{{ asset('images/asset/landing.gif') }}" alt="" width="78%">
            </div>
        </div>
    </div>
    @include('main.component.footer')
@endsection

@section('script')
    AOS.init();
@endsection
