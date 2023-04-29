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
                                {{-- <h4 class="text-muted font-size-18 mb-1 text-center">Welcome Back !</h4>
                                <p class="text-muted text-center">Sign in to continue to Lexa.</p> --}}
                                <form class="form-horizontal mt-4" id="form-login" method="post" action="login-submit">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username">Tên tài khoản</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Enter username" value="root">
                                    </div>
                                    <div class="mb-3">
                                        <label for="userpassword">Mật khẩu</label>
                                        <input type="password" class="form-control" id="userpassword" name="password"
                                            placeholder="Enter password" value="root">
                                    </div>
                                    <div class="mb-3 row mt-4">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="remember" value="" id="remember-login">
                                                <label class="form-check-label" for="remember-login">Nhớ đăng nhập
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" id="sunmit-login" type="submit">Đăng nhập</button>
                                        </div>
                                    </div>

                                    <div>
                                        <p>
                                            <small>Đây là trang web demo cho nhà tuyển dụng.</small><br>
                                            <small>Tài khoản: `root`</small><br>
                                            <small>Mật khẩu: `root`</small><br>
                                        </p>
                                    </div>
                                    {{-- <div class="form-group mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="pages-recoverpw.html" class="text-muted"><i
                                                    class="mdi mdi-lock"></i> Forgot your password?</a>
                                        </div>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        {{-- <p>Don't have an account ? <a href="pages-register.html" class="text-primary"> Signup Now </a>
                        </p> --}}
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
        clickSubmit()
    });

    function clickSubmit() {
        // $('.btn#sunmit-login').off().on('click', function(e) {
        //     e.preventDefault();
        //     var username = $('#username').val();
        //     var password = $('#userpassword').val();
        //     var remember = $('#remember-login').is(':checked');
        //     var _token = $('input[type="hidden"][name="_token"]').val();

        //     if(username.length == 0) {
        //         toastr.warning('vui lòng nhập tên người dùng')
        //         return 0;
        //     }
        //     if(password.length == 0) {
        //         toastr.warning('vui lòng nhập mật khẩu')
        //         return 0;
        //     }

        //     var dataReq = {
        //         'username' : username,
        //         'password' : password,
        //         'remember' : remember,
        //         '_token' : _token,
        //     }
        //     submitLogin(dataReq)
        // })

    }

    function submitLogin(dataReq) {
        console.log(dataReq);
        // if(dataReq.length == 0) {
        //     toastr.warning('vui lòng gửi thông tin đăng nhập')
        //     console.log('vui lòng gửi thông tin đăng nhập');
        // }else{
        //     // gửi
        //     $.ajax({
        //         type: 'POST',
        //         url: 'api/auth/login',
        //         data: dataReq,
        //         success: function (response) {
        //             toastr.success('Đăng nhập thành công');
        //             window.location.href = "/";
        //         },
        //         error: function (response) {
        //             toastr.error('Đăng nhập thất bại');
        //         }
        //     });
        // }
    }

</script>
@stop
