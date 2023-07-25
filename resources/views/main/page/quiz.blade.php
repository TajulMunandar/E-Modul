@extends('main.component.main')

@section('content')
    <div class="container h-100">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-12">
                <a><i class="fa-solid fa-arrow-left"></i></a>
                <h2 class="fw-bolder mb-0 lh-base" data-aos="fade-right" data-aos-duration="1200" style="color: #001C30;">Quiz
                    1</h2>
                <p>12 Oct 2023</p>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <p class="badge bg-primary fs-6 border"><span>asep</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 p-3 mt-3">
                <p class="fs-4">1. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Totam enim dicta aperiam
                    veritatis
                    consequuntur, optio fugit cupiditate suscipit obcaecati, odit quos?</p>
            </div>
            <div class="col-lg-12 d-flex align-items-center">
                <input type="radio" class="me-2">
                <p class="mt-2">a. Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="col-lg-12 d-flex align-items-center">
                <input type="radio" class="me-2">
                <p class="mt-2">a. Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="col-lg-12 d-flex align-items-center">
                <input type="radio" class="me-2">
                <p class="mt-2">a. Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="col-lg-12 d-flex align-items-center">
                <input type="radio" class="me-2">
                <p class="mt-2">a. Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
    </div>
    <hr>
    <footer class="footer px-5 py-3">
        <div class="row">
            <div class="col d-flex justify-content-between">
                <a href="">Lorem, ipsum dolor.</a>
                <a href="">Lorem, ipsum dolor.</a>
                <a href="">Lorem, ipsum dolor.</a>
            </div>
        </div>
    </footer>
@endsection

@section('script')
    AOS.init();
@endsection
