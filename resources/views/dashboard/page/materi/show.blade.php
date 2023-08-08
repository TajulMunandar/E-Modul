@extends('dashboard.component.main')
@section('title', 'Data Materi')
@section('page-heading', 'Data Materi')

@section('content')

    <div class="row text-start">
        <a class="btn btn-outline-secondary" href="{{ route('materi.index') }}">
            <i class="fa-regular fa-chevron-left me-2"></i>
            Kembali
        </a>
    </div>
    <div class="row mt-6">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">{{ $materi->title }}</h5>
                {!! $materi->content !!}
            </div>
        </div>

    </div>
@endsection
