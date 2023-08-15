@extends('dashboard.component.main')
@section('title', 'Data Materi')
@section('page-heading', 'Data Materi')

@section('content')

    <div class="row mt-6">
        <div class="col-sm-6 col-md-12 col-lg-8">
            <a href="{{ route('materi.index')  }}" class="btn btn-dark mb-3"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <div class="card">
                <h5 class="card-header">Buat Materi Baru</h5>
                <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="oldTitle" value="{{ $materi->title }}">
                            <input type="hidden" name="oldSlug" value="{{ $materi->slug }}">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" value="{{ old('title', $materi->title) }}" placeholder="Anton" autofocus
                                    required oninput="updateSlug()">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="modulId" class="form-label">Nama Modul</label>
                                <select class="form-select" name="modulId" id="modulId">
                                    @foreach ($moduls as $modul)
                                        @if (old('modulId', $materi->modulId) == $modul->id)
                                            <option value="{{ $modul->id }}" selected>
                                                {{ $modul->name }}</option>
                                        @else
                                            <option value="{{ $modul->id }}">
                                                {{ $modul->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="summernote" class="form-control  @error('content') is-invalid @enderror">
                                    {{ $materi->content }}
                                </textarea>
                                @error('content')
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
            });
        });
    </script>
@endsection
@endsection
