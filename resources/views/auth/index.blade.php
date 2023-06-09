@extends('layouts.master')

@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">

                            <h3 class="text-center mt-5 mb-4">
                                <a href="" class="d-block auth-logo">
                                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="30" class="auth-logo-dark">
                                    <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="30" class="auth-logo-light">
                                </a>
                            </h3>

                            <div class="p-3">
                                <form class="form-horizontal mt-4" id="form-login" method="post" action="login-submit">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username">Tên tài khoản</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Nhập vào tên đăng nhập" value="root">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userpassword">Mật khẩu</label>
                                        <input type="password" class="form-control" id="userpassword" name="password" placeholder="Nhập vào mật khẩu" value="root">
                                    </div>
                                    <div class="mb-3 row mt-4">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="remember" value="" id="remember-login">
                                                <label class="form-check-label" for="remember-login">Nhớ đăng nhập</label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" id="sunmit-login">Đăng nhập</button>
                                        </div>
                                    </div>

                                    <div>
                                        <p>
                                            <small>Đây là trang web demo cho nhà tuyển dụng.</small><br>
                                            <small>Tài khoản: `root`</small><br>
                                            <small>Mật khẩu: `root`</small><br>
                                        </p>
                                    </div>
                                </form>
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

@section('scripts')
<script>
    $(document).ready(function(){
        $('#sunmit-login').off().on('click', function(e) {
            e.preventDefault();
            var isError = false;
            var username = $('#username').val();
            var password = $('#userpassword').val();

            if(username == '') {
                toastr.warning('Vui lòng nhập tên đăng nhập');
                isError = true;
                return 0;
            }

            if(password == '') {
                toastr.warning('Vui lòng nhập mật khẩu');
                isError = true;
                return 0;
            }

            if(isError == false) {
                $('#form-login').submit();
            }
        });

    });
</script>
@stop
