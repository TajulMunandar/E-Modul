@extends('dashboard.component.main')
@section('title', 'Penilaian Choice')
@section('page-heading', 'Penilaian Choice')

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
            <a href="{{ route('choice.index', ['isChoice' => 'true']) }}" class="btn btn-dark "><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($choiceusers as $choiceuser)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $choiceuser->jawabans->questions->title }}</td>
                                    <td>{{ $choiceuser->jawabans->name }}</td>
                                    <td>
                                        @php
                                            if($choiceuser->nilai == 1){
                                                echo "Benar";
                                            }else{
                                                echo "Salah";
                                            }
                                        @endphp
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
