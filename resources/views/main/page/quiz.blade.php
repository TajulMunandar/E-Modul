@extends('main.component.main')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col d-flex justify-content-between align-items-center">
                <p class="fs-3 fw-bold mb-0">
                    {{ $quiz->title }}
                </p>
                <p class="m-0">
                    {{ $tanggal }}
                </p>
            </div>
        </div>
        <hr>
        @if ($quiz->isChoice == 1)
            <form action="{{ route('quiz-main.store') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $quiz->modulId }}">
                <input type="hidden" name="quizId" value="{{ $quizId }}">
                <div class="row">
                    @foreach ($questions as $question)
                        <div class="col-lg-12 p-3 mt-3">
                            <p class="fs-5 mb-0">{{ $loop->iteration }} . {{ $question->title }}</p>
                        </div>
                        @foreach ($question->jawabans as $key => $jawaban)
                            <div class="col-lg-12 d-flex align-items-center">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio"
                                        name="jawabanId[{{ $loop->parent->iteration }}]"
                                        id="jawabanId_{{ $loop->parent->iteration }}_{{ $loop->iteration }}"
                                        value="{{ $jawaban->id }}">
                                    @php
                                        $abjad = chr(97 + $key);
                                    @endphp
                                    <label class="form-check-label"
                                        for="jawabanId_{{ $loop->parent->iteration }}_{{ $loop->iteration }}">
                                        {{ $abjad }}. {{ $jawaban->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <hr>
                <footer class="footer px-5 py-3 text-end">
                    <button class="btn btn-primary " type="submit">Selesai</button>
                </footer>
            </form>
        @else
            {{-- essay --}}
            <form action="{{ route('quiz-essay.store') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $quiz->modulId }}">
                <input type="hidden" name="quizId" value="{{ $quizId }}">
            <div class="row">
                @foreach ($questions as $question)
                    <div class="row">
                        <div class="col-lg-12 p-3 mt-3">
                            <p class="fs-5">{{ $loop->iteration }} . {{ $question->title }}</p>
                            <div class="form-floating">
                                <input type="hidden" name="questionId[]" value="{{ $question->id }}">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="jawaban[]"></textarea>
                                <label for="floatingTextarea">Jawaban</label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <footer class="footer px-5 py-3 text-end">
                <button class="btn btn-primary ">Selesai</button>
            </footer>
        </form>
        @endif
    </div>

@endsection

@section('script')
    AOS.init();
@endsection
