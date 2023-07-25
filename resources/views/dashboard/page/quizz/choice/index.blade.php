@extends('dashboard.component.main')
@section('title', 'Data Quizz Choice')
@section('page-heading', 'Data Quizz Choice')

@section('content')

    {{--  ALERT  --}}
    <div class="row mt-3">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    {{--  ALERT  --}}

    {{--  CONTENT  --}}
    <div class="row mt-3 mb-5">
        <div class="col">
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg></i>
                Tambah
            </button>

            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">

                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>First Time</th>
                                <th>Last Time</th>
                                <th>Nama Modul</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzs as $quizz)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $quizz->title }}</td>
                                    <td>{{ $quizz->firstTime }}</td>
                                    <td>{{ $quizz->lastTime }}</td>
                                    <td>{{ $quizz->modul->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('question.index', ['isChoice' => 'true', 'quizzId' => $quizz->id]) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button id="delete-button" class="btn btn-danger" id="delete-button"
                                            data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL EDIT  --}}
                                <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Quizz Choice</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('choicee.update', $quizz->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <input type="hidden" name="isChoice" id="" value="true">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                                name="title" id="title" value="{{ old('title', $quizz->title) }}" autofocus required>
                                                            @error('title')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="firstTime" class="form-label">First Time</label>
                                                            <input type="time" class="form-control @error('firstTime') is-invalid @enderror"
                                                                name="firstTime" id="firstTime" value="{{ old('firstTime', $quizz->firstTime) }}" required>
                                                            @error('firstTime')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="lastTime" class="form-label">Last Time</label>
                                                            <input type="time" class="form-control @error('lastTime') is-invalid @enderror"
                                                                name="lastTime" id="lastTime" value="{{ old('lastTime', $quizz->lastTime) }}" required>
                                                            @error('lastTime')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="modulId" class="form-label">Category</label>
                                                            <select class="form-select" name="modulId" id="modulId">
                                                                @foreach ($moduls as $modul)
                                                                    @if (old('modulId') == $modul->id)
                                                                        <option value="{{ $modul->id }}" selected>
                                                                            {{ $modul->name }}</option>
                                                                    @else
                                                                        <option value="{{ $modul->id }}">
                                                                            {{ $modul->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Perbarui</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL EDIT  --}}

                                {{--  MODAL DELETE  --}}
                                <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Quizz Choice</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('choicee.destroy', $quizz->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="isChoice" id="" value="true">
                                                    <input type="hidden" name="id" value="{{ $quizz->id }}">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data </p>
                                                    <b>{{ $quizz->title }} ?</b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL DELETE  --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--  CONTENT  --}}

    {{--  MODAL ADD  --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Quizz Choice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('choicee.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="isChoice" id="" value="true">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" placeholder="Anton" autofocus required>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="firstTime" class="form-label">First Time</label>
                                <input type="time" class="form-control @error('firstTime') is-invalid @enderror"
                                    name="firstTime" id="firstTime" required>
                                @error('firstTime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lastTime" class="form-label">Last Time</label>
                                <input type="time" class="form-control @error('lastTime') is-invalid @enderror"
                                    name="lastTime" id="lastTime" required>
                                @error('lastTime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="modulId" class="form-label">Category</label>
                                <select class="form-select" name="modulId" id="modulId">
                                    @foreach ($moduls as $modul)
                                        @if (old('modulId') == $modul->id)
                                            <option value="{{ $modul->id }}" selected>
                                                {{ $modul->name }}</option>
                                        @else
                                            <option value="{{ $modul->id }}">
                                                {{ $modul->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  MODAL ADD  --}}

@endsection
