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
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Deskripsi</th>
                                <th>Dosen Penanggung Jawab</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Agama</td>
                                <td>agama</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#seeImage">
                                        <i class="fa-regular fa-eye me-1"></i>
                                        Lihat Foto
                                    </button>
                                </td>
                                <td>apa ajalah</td>
                                <td>Pak Arhami</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button id="delete-button" class="btn btn-danger" id="delete-button"
                                        data-bs-toggle="modal" data-bs-target="#hapusModal">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            {{--  MODAL SEE IMAGE  --}}
                            <x-modal_image>
                                @slot('id', 'seeImage')
                                @slot('title', 'Image')
                                @slot('btnTitle', 'Close')
                                @slot('primaryBtnStyle', 'btn-danger')

                                <div class="modal-body text-center">
                                    <img class="rounded-3" src="{{ asset('images/logos/logo.png') }}" alt="image Modul" height="400">
                                </div>
                            </x-modal>
                            {{--  MODAL SEE IMAGE  --}}

                            {{--  MODAL EDIT  --}}
                            <x-modal_image>
                                @slot('id', 'editModal')
                                @slot('title', 'Edit Data User')
                                @slot('route', route('user.update', 1))
                                @slot('method') @method('put') @endslot
                                @slot('btnTitle', 'Perbarui')

                                <div class="row">
                                    <div class="mb-3">
                                        <input type="hidden" name="id" value="">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" id="name" placeholder="Anton"
                                            autofocus required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            name="username" id="username" value="{{ old('username') }}"
                                            placeholder="anto_23" required>
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div id="pwd1" class="input-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="password" value="{{ old('password') }}" placeholder="*****" required>
                                            <span class="input-group-text cursor-pointer">
                                                <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </x-modal>
                            {{--  MODAL EDIT  --}}

                            {{--  MODAL DELETE  --}}
                            <x-modal>
                                @slot('id', 'hapusModal')
                                @slot('title', 'Delete Data User')
                                @slot('btnTitle', 'Delete')
                                @slot('primaryBtnStyle', 'btn-danger')
                                @slot('route', route('user.destroy', 1))
                                @slot('method') @method('put') @endslot

                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="">
                                <p class="fs-5">Apakah anda yakin akan menghapus data </p>
                                <b>Anton ?</b>
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
    <x-modal>
        @slot('id', 'createModal')
        @slot('title', 'Tambah Data User')
        @slot('route', route('user.store'))

        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    id="name" placeholder="Anton" autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    id="slug" placeholder="Anton" autofocus required>
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                    id="username" placeholder="anto_23" required>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div id="pwd1" class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="*****" required>
                    <span class="input-group-text cursor-pointer">
                        <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

    </x-modal>
    {{--  MODAL ADD  --}}


    @section('scripts')
    
    @endsection

@endsection
