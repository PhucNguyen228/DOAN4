<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Đăng Ký | Thực Phẩm Sạch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body.authentication-bg {
            background-image: url(https://lovefoodhatewaste.ca/wp-content/uploads/2020/11/FoodBackgroundNomeat.jpg);
            background-size: cover;
            background-position: center;
        }
        .data{
            display: none;
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
                            <span><img src="assets/images/logo-dark.png" alt="" height="18"></span>
                        </a>
                        <a href="index.html" class="logo-light">
                            <span><img src="assets/images/logo.png" alt="" height="18"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <h4 class="mt-0">Đăng Ký</h4>
                    <p class="text-muted mb-4">Bạn chưa có tài khoản? Tạo tài khoản của bạn, nó chỉ mất ít hơn một phút
                    </p>
                    <!-- form -->
                    <form action="#">
                        {{-- {{csrf_field()}} --}}
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <input class="form-control" type="text" id="ten_tai_khoan" placeholder="Nhập họ và tên">
                        </div>
                        <div class="form-group">
                            <label for="emailaddress">Địa chỉ Email</label>
                            <input class="form-control" type="email" id="email"
                                placeholder="Nhập địa chỉ email">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input class="form-control" type="password"  id="password"
                                placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-group">
                            <label for="number">Số điện thoại</label>
                            <input class="form-control" type="text" id="sdt"
                                placeholder="Nhập số điện thoại">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Địa chỉ</label>
                            <input class="form-control" type="text" id="dia_chi"
                                placeholder="Nhập địa chỉ ">
                        </div>
                        <div class="position-relative form-group">
                            <label>Thể loại người dùng</label>
                            <select id="loai_TK"class="form-control">
                                @foreach ($list_loai_TK as $value)
                                    <option value={{$value->ma_loai}}> {{ $value->ten_loai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id= "cua_hang" class="form-group data">
                            <label for="fullname">Tên cửa hàng</label>
                            <input class="form-control" type="text" id="ten_cua_hang" placeholder="Nhập tên cửa hàng" required>
                        </div>


                        {{-- <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="agree">
                                <label class="custom-control-label" for="checkbox-signup">Tôi chấp nhận <a
                                        href="javascript: void(0);" class="text-muted">Điều khoản này</a></label>
                            </div>
                        </div> --}}
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button id="register" type="button"
                                class="btn btn-primary btn-lg">Register</button>
                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Bạn đã có tài khoản? <a href="/login"
                                class="text-muted ml-1"><b>Đăng Nhập</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">I love the color!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent templete. I love it very
                    much! . <i class="mdi mdi-format-quote-close"></i>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#loai_TK").on('change', function(){
                var demovalue = $(this).val();
                if(demovalue == 2){
                  $(".data").show();
                }else{
                    $(".data").hide();
                }
            });

            $("#register").click(function(e) {
                var payload = {
                    'ten_tai_khoan'     : $("#ten_tai_khoan").val(),
                    'muc'               : $("#loai_TK").val(),
                    'email'             : $("#email").val(),
                    'password'          : $("#password").val(),
                    'sdt'               : $("#sdt").val(),
                    'dia_chi'           : $("#dia_chi").val(),
                    'ten_cua_hang'      : $('#ten_cua_hang').val(),
                };
                $.ajax({
                    url     :   '/register',
                    type    :   'post',
                    data    :   payload,
                    success :   function(res) {
                        if(res.status){
                            toastr.success("Bạn đã đăng kí tài khoản thành công !!!");
                            setTimeout(function() {
                                window.top.location = "/login"
                            }, 1000)
                        }
                    },
                    error   :   function(res) {
                        var danh_sach_loi = res.responseJSON.errors;
                        $.each(danh_sach_loi, function(key, value){
                            toastr.error(value[0]);
                        });
                    },
                });
            });
        });
    </script>
</body>

</html>
