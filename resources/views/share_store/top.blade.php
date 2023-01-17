<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-grey-blue">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand" href="/admin/html/ltr/vertical-menu-template/index.html"><img class="brand-logo" alt="stack admin logo" src="/admin/app-assets/images/logo/stack-logo.png">
                        <h2 class="brand-text">Fresh Food</h2>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu"></i></a></li>
                    <li class="dropdown nav-item mega-dropdown d-none d-lg-block"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Mega</a>
                        <ul class="mega-dropdown-menu dropdown-menu row p-1">

                            <li class="col-md-5 px-2">
                                <h6 class="font-weight-bold font-medium-2 ml-1">Apps</h6>
                                <ul class="row mt-2">

                                    <li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0" href="invoice-template.html" target="_blank"><i class="feather icon-printer font-large-1 mr-0"></i>
                                            <p class="font-medium-2 mt-25 mb-50">Invoice</p>
                                        </a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="avatar avatar-online"><img src="/admin/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></div><span>{{ Auth::guard('TaiKhoan')->user()->ten_tai_khoan }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="thongtin dropdown-item" href="/store/thong-tin/index" >
                                <i class="feather icon-user"></i>
                                Thông tin cá nhân
                            </a>
                            <div class="dropdown-divider"></div>
                            @if ( Auth::guard('TaiKhoan')->check())
                            <a class="dropdown-item" href="/logout">
                                <i class="feather icon-power"></i>
                                Logout
                            </a>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
