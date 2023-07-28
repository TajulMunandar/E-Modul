@extends('main.component.main')

@section('content')
    <div class="container" style="height: 90%">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-12">
                <a><i class="fa-solid fa-arrow-left"></i></a>
                <h2 class="fw-bolder mb-0 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">
                    {{ $materi->title }}</h2>
                <p data-aos="fade-right" data-aos-duration="1300">{{ $tanggal }}</p>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <p class="badge bg-primary fs-6 border"><span>{{ $materi->modul->user->name }}</span></p>
            </div>
        </div>
        <p>
            {{ strip_tags($materi->content) }}
        </p>

    </div>
    <hr>
    <footer class="footer px-5 py-3">
        @if (auth()->user())
            <div class="row">
                <div class="col d-flex justify-content-between">
                    <a href="" class="btn">Lorem, ipsum dolor.</a>
                    <p>Lorem, ipsum dolor.</p>
                    <a href="" class="btn">Lorem, ipsum dolor.</a>
                </div>
            </div>
        @else
            <a class="btn btn-primary" href="/modul">Selesai</a>
        @endif

    </footer>
@endsection

@section('script')
    AOS.init();
@endsection
