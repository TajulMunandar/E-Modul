@extends('dashboard.component.main')
@section('page-heading', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-14">
                    <div class="card-body p-5">
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <h3 class="fw-light">Mahasiswa</h3>
                                <h3 class="fw-bold">{{ $mahasiswa }}</h3>
                            </div>
                            <div class="col">
                                <span class="float-end pe-3">
                                    <i class="fa-solid fa-user fs-2 text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-14">
                    <div class="card-body p-5">
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <h3 class="fw-light">Guru</h3>
                                <h3 class="fw-bold">{{ $dosen }}</h3>
                            </div>
                            <div class="col">
                                <span class="float-end pe-3">
                                    <i class="fa-solid fa-user fs-2 text-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-14">
                    <div class="card-body p-5">
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <h3 class="fw-light">Modul</h3>
                                <h3 class="fw-bold">{{ $modul }}</h3>
                            </div>
                            <div class="col">
                                <span class="float-end pe-3">
                                    <i class="fa-solid fa-book fs-2 text-danger"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contoh elemen div untuk menampilkan grafik -->
        <div id="grafikContainer" style="height: 400px;"></div>

    </div>
@endsection
