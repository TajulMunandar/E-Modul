@extends('dashboard.component.main')
@section('title', 'Data Materi')
@section('page-heading', 'Data Materi')

@section('content')
    <div class="row mt-6">
        <div class="col-sm-6 col-md-12 col-lg-8">
            <div class="card">
                <h5 class="card-header">Buat Materi Baru</h5>
                <form action="{{ route('question.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="isChoice" id="" value="{{ $isChoice }}">
                            <input type="hidden" name="quizId" id="" value="{{ $quizzId }}">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" value="{{ old('title', $question->title) }}" placeholder="Anton" autofocus required>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @foreach ($jawabans as $index => $value)
                                <label for="answer" class="form-label">Jawaban</label>
                                <div class="mb-3 form-check px-6">
                                    <input class="form-check-input @error('jawaban') is-invalid @enderror mt-2"
                                        type="radio" id="flexRadioDefault1" name="jawaban" value="{{ old('jawaban', $index) }}" {{ $value->status ? "checked" : "" }}>
                                    <input type="text"
                                        class="form-control @error('answer.' . $index) is-invalid @enderror" name="answer[]"
                                        id="answer{{ $index }}" value="{{ old('answer.' . $index, $value->name) }}" required>
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
                            @endforeach
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
