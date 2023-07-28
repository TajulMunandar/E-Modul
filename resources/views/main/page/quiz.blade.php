@extends('main.component.main')

@section('content')
    <div class="container " style="height: 90%">
        <div class="row">
            @foreach ($questions as $question)
            <div class="row">
                <div class="col-lg-12 p-3 mt-3">
                    <p class="fs-4">{{ $question->title }}</p>
                </div>
                @foreach ($question->jawabans as $key => $jawaban)
                    <div class="col-lg-12 d-flex align-items-center">
                        <input type="radio" class="me-2">
                        @php
                            $abjad = chr(97 + $key);
                        @endphp
                        <p class="mt-2">{{ $abjad }}. {{ $jawaban->name }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
        </div>
    </div>
    <hr>
    <footer class="footer px-5 py-3">
        <div class="row">
            <div class="col d-flex justify-content-between" >
                <a href=""  class="btn">Lorem, ipsum dolor.</a>
                <p>Lorem, ipsum dolor.</p>
                <a href="" class="btn">Lorem, ipsum dolor.</a>
            </div>
        </div>
    </footer>
@endsection

@section('script')
    AOS.init();
@endsection
