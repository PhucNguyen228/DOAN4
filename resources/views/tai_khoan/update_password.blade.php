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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
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
                    <h4 class="mt-0">Quên mật khẩu</h4>
                    <p class="text-muted mb-4">Điền Email của bạn.</p>

                    <!-- form -->
                    @if ($errors->any())
                        @foreach ($errors->all() as $key => $value)
                            <div class="alert alert-danger" role="alert">
                                {{ $value }}
                            </div>
                        @endforeach
                    @endif
                    <form autocomplete="off" method="post" action="/update-password">
                        @csrf
                        <input type="text" name="id" value="{{ $customer->id }}" hidden>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input name="password" class="form-control" type="password"
                                placeholder="Enter your password">
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit">OK</button>
                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Bạn đã có tài khoản? <a href="/login" class="text-muted ml-1"><b>Đăng
                            nhập</b></a></p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
</body>
