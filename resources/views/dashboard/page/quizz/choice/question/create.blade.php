@extends('dashboard.component.main')
@section('title', 'Data Materi')
@section('page-heading', 'Data Materi')

@section('content')

    <div class="row mt-6">
        <div class="col-sm-6 col-md-12 col-lg-8">
            <div class="card">
                <h5 class="card-header">Buat Materi Baru</h5>
                <form action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="isChoice" id="" value="{{ $isChoice }}">
                            <input type="hidden" name="quizId" id="" value="{{ $quizzId }}">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" placeholder="Question" autofocus required>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="answer" class="form-label">Jawaban</label>
                            <div class="mb-3 form-check px-6">
                                <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2" type="radio" id="flexRadioDefault1" name="jawaban" value="0">
                                <input type="text" class="form-control @error('answer') is-invalid @enderror"
                                    name="answer[]" id="answer" autofocus required>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="answer" class="form-label">Jawaban</label>
                            <div class="mb-3 form-check px-6">
                                <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2" type="radio" id="flexRadioDefault1" name="jawaban" value="1">
                                <input type="text" class="form-control @error('answer') is-invalid @enderror"
                                    name="answer[]" id="answer" autofocus required>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="answer" class="form-label">Jawaban</label>
                            <div class="mb-3 form-check px-6">
                                <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2" type="radio" id="flexRadioDefault1" name="jawaban" value="2">
                                <input type="text" class="form-control @error('answer') is-invalid @enderror"
                                    name="answer[]" id="answer" autofocus required>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="answer" class="form-label">Jawaban</label>
                            <div class="mb-3 form-check px-6">
                                <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2" type="radio" id="flexRadioDefault1" name="jawaban" value="3">
                                <input type="text" class="form-control @error('answer') is-invalid @enderror"
                                    name="answer[]" id="answer" autofocus required>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
