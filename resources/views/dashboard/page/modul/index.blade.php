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
                            @foreach ($moduls as $modul)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $modul->name }}</td>
                                    <td>{{ $modul->slug }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#seeImage{{ $loop->iteration }}">
                                            <i class="fa-regular fa-eye me-1"></i>
                                            Lihat
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#seeDescription{{ $loop->iteration }}">
                                            <i class="fa-regular fa-eye me-1"></i>
                                            Lihat
                                        </button>
                                    </td>
                                    <td>{{ $modul->users->name }}</td>
                                    <td>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Modul</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('modul.update', $modul->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row">
                                                        <input type="hidden" name="oldImage" value="{{ $modul->image }}">
                                                        <input type="hidden" name="oldName" value="{{ $modul->name }}">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama</label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" id="name"
                                                                value="{{ old('name', $modul->name) }}" placeholder="Anton"
                                                                autofocus required>
                                                            @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Image</label>
                                                            <img src="{{ asset('storage/' . $modul->image) }}"
                                                                class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                                            <img class="img-preview img-fluid mb-3 col-sm-5">
                                                            <input class="form-control @error('image') is-invalid @enderror"
                                                                type="file" name="image" id="image"
                                                                onchange="previewImage()">
                                                            <div id="imageHelp" class="form-text">Ekstensi file: JPG, PNG
                                                                maksimal 2MB
                                                            </div>
                                                            @error('image')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi" name="deskripsi"
                                                                style="height: 100px">{{ old('deskripsi', $modul->deskripsi) }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="userId" class="form-label">Dosen Penanggung
                                                                Jawab</label>
                                                            <select class="form-select" name="userId" id="userId">
                                                                @foreach ($users as $user)
                                                                    @if (old('userId') == $user->id)
                                                                        <option value="{{ $user->id }}" selected>
                                                                            {{ $user->name }}</option>
                                                                    @else
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="categoryId" class="form-label">Category</label>
                                                            <select class="form-select" name="categoryId" id="categoryId">
                                                                @foreach ($categorys as $category)
                                                                    @if (old('categoryId') == $category->id)
                                                                        <option value="{{ $category->id }}" selected>
                                                                            {{ $category->name }}</option>
                                                                    @else
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->name }}</option>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data Modul</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('modul.destroy', $modul->id) }}" method="POST">
                                                <div class="modal-body">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="id" value="{{ $modul->id }}">
                                                    <p class="fs-5">Apakah anda yakin akan menghapus data </p>
                                                    <b>{{ $modul->name }} ?</b>
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

                                {{--  MODAL SEE IMAGE  --}}
                                <div class="modal fade" id="seeImage{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Lihat Foto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <img class="rounded-3" style="object-fit: cover"
                                                            src="{{ asset('storage/' . $modul->image) }}" alt=""
                                                            height="250" width="350">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL SEE IMAGE  --}}

                                {{--  MODAL SEE DESCRIPTION  --}}
                                <div class="modal fade" id="seeDescription{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Lihat Foto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <p>
                                                            {{ $modul->deskripsi }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  MODAL SEE DESCRIPTION  --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Modul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('modul.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="Anton" autofocus required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    name="image" id="image" onchange="previewImage()">
                                <div id="imageHelp" class="form-text">Ekstensi file: JPG, PNG maksimal 2MB
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi" name="deskripsi"
                                    style="height: 100px"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="userId" class="form-label">Dosen Penanggung Jawab</label>
                                <select class="form-select" name="userId" id="userId">
                                    @foreach ($users as $user)
                                        @if (old('userId') == $user->id)
                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                        @else
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="categoryId" class="form-label">Category</label>
                                <select class="form-select" name="categoryId" id="categoryId">
                                    @foreach ($categorys as $category)
                                        @if (old('categoryId') == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
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
    {{--  MODAL ADD  --}}

@section('scripts')
    <script>
        function previewImage() {
            const image = document.querySelector('#thumbnail');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(OFREvent) {
                imgPreview.src = OFREvent.target.result;
            }

            //batas

            const image1 = document.querySelector('#thumbnail1');
            const imgPreview1 = document.querySelector('.img-preview1');

            imgPreview1.style.display = 'block';

            const oFReader1 = new FileReader();
            oFReader1.readAsDataURL(image1.files[0]);

            oFReader1.onload = function(OFREvent) {
                imgPreview1.src = OFREvent.target.result;
            }
        }
    </script>
@endsection
@endsection
