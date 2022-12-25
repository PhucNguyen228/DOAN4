<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link type="image/png" sizes="16x16" rel="icon" href=".../icons8-ingredients-16.png">
    <link type="image/png" sizes="32x32" rel="icon" href=".../icons8-ingredients-32.png">
    <link type="image/png" sizes="96x96" rel="icon" href=".../icons8-ingredients-96.png"> --}}
    <title>Admin | Đăng Nhập </title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Sarabun:300,400,700" rel="stylesheet">
    <!-- FontAwesome Font -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Custom Css -->
    <link href="https://d2set.net/Publics/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body id="admin-login">
    <div class="login-body">
        <div class="canvar-background">
            <div id="canvar-show"></div>
        </div>
        <div class="login-content">
            <div class="login-inner">
                <div class="login-head">
                    <div class="login-head-title">Khu vực hạn chế</div>
                    <div class="login-head-text">Bạn cần đăng nhập để truy cập vào trang quản trị</div>
                </div>
                <div class="login-form-box">
                    <form class="form">
                        <div class="form-group">
                            <label>Đăng Nhập</label>
                            <input type="email" id="email" placeholder="Nhập tài khoản Admin..."
                                class="form-control site-form-input">
                        </div>
                        <div class="form-group">
                            <label>Mật Khẩu</label>
                            <input type="password" id="password" class="form-control site-form-input">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="submit" value="Đăng Nhập" class="site-form-submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://d2set.net/Publics/new_js/jquery-1.11.3.min.js"></script>
    <script src="https://d2set.net/Publics/new_js/jquery.particleground.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#canvar-show').particleground({
                dotColor: '#fff',
                lineColor: '#fff'
            });

            $("#submit").click(function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();
                var payload = {
                    'email': email,
                    'password': password,
                };
                console.log(payload);
                $.ajax({
                    url: '/admin/login',
                    data: payload,
                    type: 'post',
                    success: function(res) {
                        if (res.status == 1) {
                            toastr.success('dang nhap thanh cong');
                            setTimeout(function() {
                                window.location.href = '/admin/index';
                            }, 1000)
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
