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
                                    <a type="button" class="position-relative">
                                        <div>
                                            @if (auth()->user()->id)
                                                <img src="{{ asset('images/avatar.png') }}" alt="" width="25%"
                                                    class="rounded-circle mb-3 ">
                                            @else
                                                <img src="{{ asset('images/avatar.png') }}" alt="" width="25%"
                                                    class="rounded-circle mb-3 ">
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
                        <form action="" method="POST">
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
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                @if (auth()->user()->role == 1)
                                    <label for="bidang" class="form-label">NIP</label>
                                @else
                                    <label for="bidang" class="form-label">NIM</label>
                                @endif
                                <input type="text" class="form-control @error('bidang') is-invalid @enderror"
                                    name="bidang" id="bidang" value="" required>
                                @error('bidang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bidang" class="form-label">Prodi</label>
                                <input type="text" class="form-control @error('bidang') is-invalid @enderror"
                                    name="bidang" id="bidang" value="" required>
                                @error('bidang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bidang" class="form-label">Email</label>
                                <input type="text" class="form-control @error('bidang') is-invalid @enderror"
                                    name="bidang" id="bidang" value="" required>
                                @error('bidang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bidang" class="form-label">No Hp</label>
                                <input type="text" class="form-control @error('bidang') is-invalid @enderror"
                                    name="bidang" id="bidang" value="" required>
                                @error('bidang')
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
                        <a class="btn btn-primary float-end">Reset Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('main.component.footer')
@endsection

@section('script')
    AOS.init();
@endsection
