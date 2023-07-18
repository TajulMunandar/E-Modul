@extends('dashboard.component.main')
@section('title', 'Data Materi')
@section('page-heading', 'Data Materi')

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
            <a class="btn btn-dark" href="{{ route('materi.create') }}">
                <i class=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg></i>
                Tambah
            </a>

            <div class="card mt-3 col-sm-6 col-md-12">
                <div class="card-body">

                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Nama Modul</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Fiqih</td>
                                <td>fiqih</td>
                                <td>1</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('materi.edit', 1) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <button id="delete-button" class="btn btn-danger" id="delete-button"
                                        data-bs-toggle="modal" data-bs-target="#hapusModal">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            {{--  MODAL DELETE  --}}
                            <x-modal>
                                @slot('id', 'hapusModal')
                                @slot('title', 'Delete Data Modul')
                                @slot('btnTitle', 'Delete')
                                @slot('primaryBtnStyle', 'btn-danger')
                                @slot('route', route('modul.destroy', 1))
                                @slot('method') @method('put') @endslot

                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="">
                                <p class="fs-5">Apakah anda yakin akan menghapus data </p>
                                <b>Fiqih ?</b>
                            </x-modal>
                            {{--  MODAL DELETE  --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--  CONTENT  --}}

    {{--  MODAL ADD  --}}

    {{--  MODAL ADD  --}}

@endsection
