@extends('main.component.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col col-md-5">
                <div class="card border-0 bg-transparent" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class="card-body p-4 ">
                        <div class="text-center">
                            <div class="row">
                                <div class="col">
                                    <a type="button" class="position-relative" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <div>
                                            @if (auth()->user()->id)
                                                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                                                    width="25%" class="rounded-circle mb-3 ">
                                            @else
                                                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                                                    width="25%" class="rounded-circle mb-3 ">
                                            @endif

                                            <span
                                                class="position-absolute start-60 translate-middle badge rounded-pill bg-secondary"
                                                style="top: 75%;">
                                                <i class="fa-solid fa-camera-retro"></i>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Image</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('profile.updateimage', auth()->user()->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Pilih Foto Anda</label>
                                                <input class="form-control" type="file" name="image" id="formFile">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info text-white">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" id="username" value="{{ auth()->user()->username }}" required disabled>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                @if (auth()->user()->role == 1)
                                    <label for="no_induk" class="form-label">NIP</label>
                                @else
                                    <label for="no_induk" class="form-label">NIM</label>
                                @endif
                                <input type="text" class="form-control @error('no_induk') is-invalid @enderror"
                                    name="no_induk" id="no_induk" value="{{ auth()->user()->no_induk }}" required>
                                @error('no_induk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="prodiId" class="form-label">Prodi</label>
                                <select class="form-select" name="prodiId" id="prodiId" disabled>
                                    @foreach ($prodis as $prodi)
                                        @if (old('prodiId', auth()->user()->prodiId) == $prodi->id)
                                            <option value="{{ auth()->user()->prodiId }}" selected>{{ $prodi->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ auth()->user()->email }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No Hp</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    name="no_hp" id="no_hp" value="{{ auth()->user()->no_hp }}" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row text-end">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Perbarui</button>
                                </div>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                            data-bs-target="#resetPassword">
                                            Reset Password
                                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--  MODAL RESET PASSWORD  --}}
    <div class="modal fade" id="resetPassword" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.reset') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                            <div class="mb-3">
                                <label for="password" class="form-label">Password
                                    Baru</label>
                                <div id="pwd1" class="input-group">
                                    <input type="password"
                                        class="form-control border-end-0 @error('password') is-invalid @enderror"
                                        name="password" id="password" value="{{ old('password') }}" required>
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

                            <div class="mb-3">
                                <label for="password2" class="form-label">Konfirmasi
                                    Password
                                    Baru</label>
                                <div id="pwd2" class="input-group">
                                    <input type="password"
                                        class="form-control border-end-0 @error('password2') is-invalid @enderror"
                                        name="password2" id="password2" value="{{ old('password2') }}" required>
                                    <span class="input-group-text cursor-pointer">
                                        <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                    </span>
                                    @error('password2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info text-white">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  MODAL RESET PASSWORD  --}}

    @include('main.component.footer')
@endsection


@section('script')
    AOS.init();
        const input = document.querySelector("#pwd input");
        const eye = document.querySelector("#pwd .fa-eye-slash");

        eye.addEventListener("click", () => {
            if (input.type === "password") {
                input.type = "text";

                eye.classList.remove("fa-eye-slash");
                eye.classList.add("fa-eye");
            } else {
                input.type = "password";

                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            }
        });
@endsection
