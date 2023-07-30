@extends('dashboard.component.main')
@section('title', 'Data Modul')
@section('page-heading', 'Data Modul')

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
            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">
                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Modul</th>
                                <th>Name Quizz</th>
                                <th>Name User</th>
                                <th>Nilai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scores as $score)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $score->quizzes->moduls->name }}</td>
                                    <td>{{ $score->quizzes->title }}</td>
                                    <td>{{ $score->users->name }}</td>
                                    <td>{{ $score->nilai }}</td>
                                    <td>
                                        <a class="btn btn-warning"
                                            href="{{ route('essay.show', ['essay' => $score->id, 'userId' => $score->users->id, 'isChoice' => "false", 'quizId' => $score->quizId]) }}"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#addModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen"></i></a>
                                        </button>
                                    </td>
                                </tr>

                                {{--  MODAL ADD  --}}
                                <div class="modal fade" id="addModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('essay.update', $score->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="mb-3">
                                                            <label for="nilai" class="form-label">Nilai</label>
                                                            <input type="number"
                                                                class="form-control @error('nilai') is-invalid @enderror"
                                                                name="nilai" id="nilai" placeholder="Anton" value="{{ old('nilai', $score->nilai) }}" autofocus
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
                                {{--  MODAL ADD  --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--  CONTENT  --}}
@endsection
