@extends('dashboard.component.main')
@section('title', 'Data Penilaian Essay')
@section('page-heading', 'Data Penilaian Essay')

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
                                            href="{{ route('essay.show', ['essay' => $score->id, 'userId' => $score->users->id, 'isChoice' => "false", 'quizId' => $score->quizId, 'nilai' => $score->nilai]) }}"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--  CONTENT  --}}
@endsection
