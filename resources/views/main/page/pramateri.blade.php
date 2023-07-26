@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-12">
                <p class="hastag" data-aos="fade-right" data-aos-duration="1000">#PejuangIlmu</p>
                <h2 class="fw-bolder mb-3 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">
                    {{ $modul->name }}</h2>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-duration="1000">
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pramateri/' . $modul->slug . '/pramateri') ? 'active' : '' }}"
                            href="{{ route('pramateri-main.show', ['modul' => $modul->slug]) }}">Materi</a>
                    </li>
                    @if (auth()->user())
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pramateri/' . $modul->slug . '/quiz') ? 'active' : '' }}"
                                href="{{ route('pramateri-quiz.show', ['modul' => $modul->slug]) }}">Quiz</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row p-5 h-100" data-aos="fade-up" data-aos-duration="1500">
            @foreach ($pramateris as $pramateri)
                <div class="col mb-3">
                    <div class="card" style="width: 22rem;">
                        <img src="{{ asset('storage/' . $pramateri->modul->image) }}" class="card-img-top" alt="..."
                            style="height: 50%">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $pramateri->title }}</h5>
                            <p class="card-text">{{ strip_tags($pramateri->content) }}</p>
                            <a href="{{ route('materi-main.show', ['materi' => $pramateri->slug]) }}"
                                class="btn btn-primary stretched-link float-end">Mulai</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('main.component.footer')
@endsection

@section('script')
    AOS.init();
@endsection
