@extends('main.component.main')

@section('content')
    @extends('main.component.head')
@section('style')
    {{-- Theme --}}
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
@endsection


<div class="wrapper">
    <div class="main-content">
        <div class="container px-5">
            <div class="row d-flex justify-content-end align-items-center">
                <div class="col-lg-5 col-md-12">
                    <p class="badge bg-primary border mb-0" data-aos="fade-right" data-aos-duration="1000">
                        <span>{{ $materi->moduls->users->name }}</span>
                    </p>
                    <h2 class="fw-bolder mb-0 lh-base" data-aos="fade-right" data-aos-duration="1200"
                        style="color: #001C30;">
                        {{ $materi->title }}</h2>
                    <p data-aos="fade-right" data-aos-duration="1300">{{ $tanggal }}</p>
                </div>
                <div class="col text-end">
                    @if (auth()->user())
                        <button class="btn float-end" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <h4><i class="fa-solid fa-bars"></i></h4>
                        </button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasRightLabel">Materi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="menu-item text-start">
                                    @foreach ($navmateris as $index => $navmateri)
                                        @php
                                            $isFinished = \App\Models\MateriStatus::where('userId', auth()->user()->id)
                                                ->where('materiId', $navmateri->id)
                                                ->exists();
                                            $isFirstMateri = $index === 0;
                                            $isPrevFinished =
                                                $index === 0 ||
                                                \App\Models\MateriStatus::where('userId', auth()->user()->id)
                                                    ->where('materiId', $navmateris[$index - 1]->id)
                                                    ->exists();
                                        @endphp
                                        <form action="{{ route('materi-main.show', ['materi' => $navmateri->slug]) }}"
                                            method="get">
                                            @if (request()->is('materi-main/' . $navmateri->slug))
                                                <button type="submit" class="dropdown-item b active"
                                                    data-i18n="Analytics">
                                                    <i class="fa-solid fa-diamond me-2"></i>
                                                    {{ $navmateri->title }}
                                                </button>
                                            @else
                                                <button type="submit" class="dropdown-item b" data-i18n="Analytics"
                                                    {{ !$isFirstMateri && !$isPrevFinished ? 'disabled' : '' }}>
                                                    <i class="fa-solid fa-diamond me-2"></i>
                                                    {{ $navmateri->title }}
                                                </button>
                                            @endif
                                        </form>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <p>
                {!! $materi->content !!}
            </p>
            <hr class="mt-5 text-dark opacity-25">
            <h2 class="fw-bold">Ruang Diskusi</h2>
            <div class="row w-100 p-3 d-flex">
                @foreach ($komentars as $komentar)
                    <div class="col-lg-10 mb-4 d-flex w-100">
                        <div class="col-lg-2 text-center me-2" style="width: 80px">
                            <img src="{{ asset('images/avatar.png') }}" class="rounded-pill" style="max-width: 100%">
                        </div>
                        <div class="col-lg-10 me-2">
                            <h4 class="fw-bolder mb-2">{{ $komentar->users->name }}</h4>
                            <p>{{ $komentar->name }}</p>
                        </div>
                        <div class="me-3 d-flex align-items-start">
                            <p style="font-size: 11px" class="me-3 mb-0">{{ $komentar->created_at->format('D-M-Y') }}
                            </p>
                            @if ($komentar->userId == auth()->user()->id)
                                <div class="dropdown d-flex align-items-center">
                                    <a class=" dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical "></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $loop->iteration }}">
                                                EDIT
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#hapusModal{{ $loop->iteration }}">
                                                DELETE
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{--  EDIT MODAL KOMENTAR  --}}
                    <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Komentar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('coment.update', $komentar->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="materiId" value="{{ $materi->id }}">
                                        <input type="hidden" name="id" value="{{ $komentar->id }}">
                                        <input type="hidden" name="slug" value="{{ $materi->slug }}">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="name">{{ $komentar->name }}</textarea>
                                            <label for="floatingTextarea">Comments</label>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info text-white">Edit Coment</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--  EDIT MODAL KOMENTAR  --}}

                    {{--  DELETE MODAL KOMENTAR  --}}
                    <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Komentar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('coment.destroy', $komentar->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $komentar->id }}">
                                        <input type="hidden" name="slug" value="{{ $materi->slug }}">
                                        <p class="fs-5">Apakah anda yakin akan menghapus data </p>
                                        <b>{{ $komentar->name }} ?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info text-white">Delete Coment</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--  DELETE MODAL KOMENTAR  --}}
                @endforeach
            </div>
            @if (auth()->user())
                <div class="row mt-5">
                    <form action="{{ route('coment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="materiId" value="{{ $materi->id }}">
                        <input type="hidden" name="slug" value="{{ $materi->slug }}">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="name"></textarea>
                            <label for="floatingTextarea">Comments</label>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Komen</button>
                    </form>
                </div>
            @endif

        </div>
    </div>
</div>
<footer class="footer px-5 py-3">
    @if (auth()->user())
        <div class="row">
            <div class="col d-flex justify-content-between">
                @if ($previousMateri)
                    <a href="{{ route('materi-main.show', ['materi' => $previousMateri->slug]) }}"
                        class="btn">{{ $previousMateri->title }}</a>
                @else
                    <a> </a>
                @endif
                <p>{{ $materi->title }}</p>
                @if ($status->status == 1)
                    @if ($nextMateri)
                        <a href="{{ route('materi-main.show', ['materi' => $nextMateri->slug]) }}"
                            class="btn">{{ $nextMateri->title }}</a>
                    @else
                        <a> </a>
                    @endif
                @else
                    @if ($nextMateri)
                        <form action="{{ route('materi-main.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="materi" value="{{ $materi }}">
                            <button type="submit" class="btn">{{ $nextMateri->title }}</button>
                        </form>
                    @else
                        <a> </a>
                    @endif
                @endif

            </div>
        </div>
    @else
        <a class="btn btn-primary" href="{{ route('pramateri.show', ['modul' => $modul->slug]) }}">Selesai</a>
    @endif
</footer>
@endsection
<style>
body {
    margin: 0;
    padding: 0;
}

.footer {
    position: sticky;
    bottom: 0;
    width: 100%;
    border-top: 1px solid #001c303f;
    background-color: #DDE6ED;
    z-index: 999;
}

/* Menambahkan class 'stuck' untuk footer saat melebihi tinggi layar */
.footer.stuck {
    position: static;
}
</style>


@section('script')
AOS.init();
@endsection
