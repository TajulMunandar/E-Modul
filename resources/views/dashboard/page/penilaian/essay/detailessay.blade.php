@extends('dashboard.component.main')
@section('title', 'Penilaian Essay')
@section('page-heading', 'Penilaian Essay')

@section('content')
{{--  @dd($essayusers);  --}}
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
                Tambah Total Nilai
            </button>
            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">
                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Question</th>
                                <th>jawaban User</th>
                                <th>Nilai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($essayusers as $essayuser)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $essayuser->questions->title }}</td>
                                    <td>{{ $essayuser->jawaban }}</td>
                                    <td>{{ $essayuser->nilai }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info text-white" data-bs-toggle="modal"
                                            data-bs-target="#addModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen"></i></a>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL NILAI QUESTION  --}}
                                <div class="modal fade" id="addModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('essay.updateitem', $essayuser->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row">
                                                        <input type="hidden" name="status" value="true">
                                                        <input type="hidden" name="quizId" value="{{ $quizId }}">
                                                        <input type="hidden" name="scoreId" value="{{ $scoreId }}">
                                                        <input type="hidden" name="total" value="{{ $total }}">
                                                        <input type="hidden" name="userId"
                                                            value="{{ $essayuser->userId }}">
                                                        <div class="mb-3">
                                                            <label for="nilai" class="form-label">Nilai</label>
                                                            <input type="number"
                                                                class="form-control @error('nilai') is-invalid @enderror"
                                                                name="nilai" id="nilai" placeholder="Nilai Question"
                                                                value="{{ old('nilai', $essayuser->nilai) }}" autofocus
                                                                required>
                                                            @error('nilai')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
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
                                {{--  MODAL NILAI QUESTION  --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  MODAL NILAI QUIZ  --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Modul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('essay.update', $scoreId) }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <input type="hidden" name="status" value="true">
                            <input type="hidden" name="quizId" value="{{ $quizId }}">
                            <input type="hidden" name="total" value="{{ $total }}">
                            <input type="hidden" name="userId" value="{{ $essayuser->userId }}">
                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input type="number" class="form-control @error('nilai') is-invalid @enderror"
                                    name="nilai" id="nilai" placeholder="Nilai Total Quiz"
                                    value="{{ old('nilai', $total) }}" autofocus required>
                                @error('nilai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  MODAL NILAI QUIZ   --}}
    {{--  CONTENT  --}}
@endsection
