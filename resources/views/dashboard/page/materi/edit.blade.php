@extends('dashboard.component.main')
@section('title', 'Data Materi')
@section('page-heading', 'Data Materi')

@section('content')

    <div class="row mt-6">
        <div class="col-sm-6 col-md-12 col-lg-8">
            <div class="card">
                <h5 class="card-header">Buat Materi Baru</h5>
                <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                    id="title" value="{{ old('title') }}" placeholder="Anton" autofocus required oninput="updateSlug()">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="sluq" class="form-label">Slug</label>
                                <input type="text" class="form-control @error('sluq') is-invalid @enderror" name="sluq"
                                    id="sluq" value="{{ old('sluq') }}" placeholder="Anton" autofocus required oninput="updateSlug()">
                                @error('sluq')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Nama Modul</label>
                            <select class="form-select" name="id_kategori" id="id_kategori">
                                <option value="" selected>Agama</option>
                                <option value="" selected>Bisnis</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sluq" class="form-label">Content</label>
                            <textarea name="content" id="summernote" class="form-control  @error('content') is-invalid @enderror"></textarea>
                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
