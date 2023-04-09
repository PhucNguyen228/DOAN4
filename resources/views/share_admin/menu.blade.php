<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header"><span>General</span><i class=" feather icon-minus" data-toggle="tooltip"
                    data-placement="right" data-original-title="General"></i>
            </li>
            <li class=" nav-item"><a href="index.html"><i class="feather icon-home"></i><span class="menu-title"
                        data-i18n="Dashboard">Chức Năng</span><span
                        class="badge badge badge-primary badge-pill float-right mr-2"></span></a>
                <ul class="menu-content">
                    <li class=" nav-item {{ request()->is('admin/user/index') ? 'active' : '' }}"><a class="menu-item"
                            href="/admin/user/index" data-i18n="eCommerce">Tài Khoản Khách Hàng</a>
                    </li>
                    <li class=" nav-item {{ request()->is('admin/store/index') ? 'active' : '' }}"><a class="menu-item"
                            href="/admin/store/index" data-i18n="Analytics">Tài Khoản Chủ Cừa Hàng</a>
                    </li>
                    <li class=" nav-item {{ request()->is('admin/danh-muc-san-pham/index') ? 'active' : '' }}">
                        <a class="menu-item" href="/admin/danh-muc-san-pham/index" data-i18n="Fitness">Danh Mục Sản
                            Phẩm</a>
                    </li>
                    <li class=" nav-item {{ request()->is('admin/doanh-thu-admin/index') ? 'active' : '' }}">
                        <a class="menu-item" href="/admin/doanh-thu-admin/index" data-i18n="Fitness">Dồ Thị Doanh
                            Thu</a>
                    </li>
                    <li class=" nav-item {{ request()->is('admin/thong-ke-admin/index') ? 'active' : '' }}">
                        <a class="menu-item" href="/admin/thong-ke-admin/index" data-i18n="Fitness">Thống Kê</a>
                    </li>
                    <li class=" nav-item {{ request()->is('admin/thue/index') ? 'active' : '' }}">
                        <a class="menu-item" href="/admin/thue/index" data-i18n="Fitness">Thuế</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/yeu-cau-danh-muc/index') ? 'active' : '' }}"><a
                    class="menu-item" href="/admin/yeu-cau-danh-muc/index" data-i18n="Horizontal">Yêu Cầu Danh Mục

                    <span class="cricel badge-pill badge-danger badge-up">
                        {{ $dem }}
                    </span>


                </a>
            <li>
        </ul>
    </div>
</div>
