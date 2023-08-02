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
            @foreach ($quizzes as $quiz)
                <div class="col mb-3">
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $quiz->moduls->image) }}" class="card-img-top" alt="..."
                                style="height: 15rem; object-fit: cover">
                            <div class="row mb-3 d-flex  align-items-center">
                                <div class="col">
                                    <h5 class="card-title fw-bold">{{ $quiz->title }}</h5>
                                    <p class="card-text">{{ $date }}</p>
                                </div>
                                <div class="col text-end">
                                    @if ($quiz->isChoice == 1)
                                        <span class="badge bg-info"> Choice </span>
                                    @else
                                        <span class="badge bg-success"> Essay </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">Dari Jam:</div>
                                <div class="col">Sampai Jam:</div>
                            </div>
                            <div class="row mb-3 fs-5">
                                <div class="col">
                                    <p class="badge bg-primary"><span>{{ $quiz->firstTime }}</span></p>
                                </div>
                                <div class="col">
                                    <p class="badge bg-danger"><span>{{ $quiz->lastTime }}</span></p>
                                </div>
                            </div>
                            @php
                                $now = now();
                                $currentTime = $now->format('H:i'); // Format waktu saat ini hanya jam dan menit
                                $isWithinTime = $currentTime >= $quiz->firstTime && $currentTime <= $quiz->lastTime;
                            @endphp
                            <a href="{{ $isWithinTime ? route('quiz-main.showquiz', ['id' => $quiz->id]) : '#' }}"
                                class="btn btn-primary stretched-link float-end {{ $isWithinTime ? '' : 'disabled' }}">
                                Mulai
                            </a>
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
