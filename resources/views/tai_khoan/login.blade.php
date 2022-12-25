<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Đăng Nhập | Thực Phẩm Sạch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <style>
        body.authentication-bg {
            background-image: url(https://lovefoodhatewaste.ca/wp-content/uploads/2020/11/FoodBackgroundNomeat.jpg);
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-left">
                        <a href="index.html" class="logo-dark">
                            <span><img src="../../css/img/seller-stands-front-grocery-store_152995-30.jpg"
                                    alt=""></span>
                        </a>
                    </div>

                    <!-- title-->
                    <h4 class="mt-0">Đăng nhập</h4>
                    <p class="text-muted mb-4">Điền Email của bạn.</p>

                    <!-- form -->
                    <form action="#">
                        <div class="form-group">
                            <label for="email">Địa chỉ Email</label>
                            <input class="form-control" type="email" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <a href="pages-recoverpw-2.html" class="text-muted float-right"><small>Quên mật
                                    khẩu</small></a>
                            <label for="password">Mật khẩu</label>
                            <input class="form-control" type="password" id="password"
                                placeholder="Enter your password">
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button id="login" class="btn btn-primary btn-block" type="submit">Đăng nhập </button>
                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Bạn chưa có tài khoản? <a href="/register" class="text-muted ml-1"><b>Đăng
                                    ký</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">I love the color!</h2>
                <p class="lead"> It's a elegent templete. I love it very
                    much! .
                </p>
                <p>
                    - Hyper Admin User
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    {{-- @jquery
    @toastr_js
    @toastr_render --}}
    {{-- @jquery
    @toastr_js
    @toastr_render --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#login").click(function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();
                var payload = {
                    'email': email,
                    'password': password,
                };
                console.log(payload);
                $.ajax({
                    url: '/login',
                    data: payload,
                    type: 'post',
                    success: function(res) {
                        if (res.status == 2) {
                            toastr.success('dang nhap thanh cong');
                        } else if (res.status == 3) {
                            toastr.success('dang nhap thanh cong');
                            setTimeout(function() {
                                window.top.location = "/store/index"
                            }, 1000)
                        } else if (res.status == 1) {
                            toastr.error('dang nhap that bai');
                        } else {
                            toastr.error('dang nhap that bai');
                        }
                    },
                    error: function(res) {
                        var danh_sach_loi = res.responseJSON.errors;
                        $.each(danh_sach_loi, function(key, value) {
                            toastr.error(value[0]);
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
