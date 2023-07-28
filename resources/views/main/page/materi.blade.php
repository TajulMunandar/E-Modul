@extends('main.component.main')

@section('content')
    @extends('main.component.head')
@section('style')
    {{-- Theme --}}
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
@endsection
<div class="wrapper">
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-end align-items-center">
                <div class="col-lg-5 col-md-12">
                    <p class="badge bg-primary border mb-0" data-aos="fade-right" data-aos-duration="1000">
                        <span>{{ $materi->modul->user->name }}</span>
                    </p>
                    <h2 class="fw-bolder mb-0 lh-base" data-aos="fade-right" data-aos-duration="1200"
                        style="color: #001C30;">
                        {{ $materi->title }}</h2>
                    <p data-aos="fade-right" data-aos-duration="1300">{{ $tanggal }}</p>
                </div>
                <div class="col text-end">
                    @if (auth()->user())
                        <button class="btn float-end" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <h4><i class="fa-solid fa-bars"></i></h4>
                        </button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Materi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="menu-item text-start">
                                    <form action="" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item b">
                                            <div data-i18n="Analytics"><i class="fa-solid fa-diamond me-2"></i> ayam
                                            </div>
                                        </button>
                                    </form>
                                    <form>
                                        <button disabled="disabled" class="dropdown-item b">
                                            <div data-i18n="Analytics"><i class="fa-solid fa-diamond me-2"></i>babi
                                            </div>
                                        </button>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <p>
                {{ strip_tags($materi->content) }}
            </p>
        </div>
    </div>
</div>
<footer class="footer px-5 py-3">
    @if (auth()->user())
        <div class="row">
            <div class="col d-flex justify-content-between">
                <a href="" class="btn">Lorem, ipsum dolor.</a>
                <p>{{ $materi->title }}</p>
                <a href="" class="btn">Lorem, ipsum dolor.</a>
            </div>
        </div>
    @else
        <a class="btn btn-primary" href="/modul">Selesai</a>
    @endif
</footer>
@endsection
<style>
body {
    margin: 0;
    padding: 0;
}

.footer {
    position: sticky;
    bottom: 0;
    width: 100%;
    border-top: 1px solid #001c303f;
    background-color: #DDE6ED;
    z-index: 999;
}

/* Menambahkan class 'stuck' untuk footer saat melebihi tinggi layar */
.footer.stuck {
    position: static;
}
</style>


@section('script')
AOS.init();
@endsection
