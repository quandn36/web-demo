@extends('layouts.master')

@section('content')
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body pt-0">

                        <div class="ex-page-content text-center">
                            <h1 class="text-dark">404!</h1>
                            <h3 class="">Xin lỗi, không tìm thấy trang</h3>
                            <br>

                            <a class="btn btn-info mb-4 waves-effect waves-light" href="{{$previousPage}}"><i
                                    class="mdi mdi-home"></i> Quay lại</a>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">
                    ©
                    <script>document.write(new Date().getFullYear())</script> Lexa <span
                        class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i>
                        by Themesdesign.</span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
