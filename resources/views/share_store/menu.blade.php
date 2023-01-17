<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header"><span>General</span><i class=" feather icon-minus" data-toggle="tooltip"
                    data-placement="right" data-original-title="General"></i>
            </li>
            <li class=" nav-item"><a href="/store/index"><i class="feather icon-home"></i><span class="menu-title"
                        data-i18n="Dashboard">Chức Năng</span><span
                        class="badge badge badge-primary badge-pill float-right mr-2"></span></a>
                <ul class="menu-content">
                    <li class=" nav-item {{ request()->is('store/san-pham/index') ? 'active' : '' }}"><a
                            class="menu-item" href="/store/san-pham/index" data-i18n="eCommerce">Sản Phẩm</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/khuyen-mai/index') ? 'active' : '' }}"><a
                            class="menu-item" href="/store/khuyen-mai/index" data-i18n="eCommerce">Đợt Khuyến Mãi</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/ty-le/index') ? 'active' : '' }}"><a class="menu-item"
                            href="/store/ty-le/index" data-i18n="eCommerce">Tỷ Lệ Khuyến Mãi</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/doanh-thu/index') ? 'active' : '' }}"><a
                            class="menu-item" href="/store/doanh-thu/index" data-i18n="eCommerce">Đồ Thị Doanh Thu</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/thong-ke/index') ? 'active' : '' }}"><a
                            class="menu-item" href="/store/thong-ke/index" data-i18n="eCommerce">Thống Kê</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/yeu-cau/index') ? 'active' : '' }}"><a
                            class="menu-item" href="/store/yeu-cau/index" data-i18n="eCommerce">Yêu cầu danh mục</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="/store/index"><i class="feather icon-home"></i><span class="menu-title"
                data-i18n="Dashboard">Đơn Hàng</span><span
                class="badge badge badge-primary badge-pill float-right mr-2"></span></a>
                <ul class="menu-content">
                    <li class=" nav-item {{ request()->is('store/don-hang/cho-xac-nhan') ? 'active' : '' }}"><a class="menu-item"
                        href="/store/don-hang/cho-xac-nhan" data-i18n="eCommerce">Chờ Xác Nhận</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/don-hang/da-xac-nhan') ? 'active' : '' }}"><a class="menu-item"
                        href="/store/don-hang/da-xac-nhan" data-i18n="eCommerce">Đã Xác Nhận</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/don-hang/dang-chuyen') ? 'active' : '' }}"><a class="menu-item"
                        href="/store/don-hang/dang-chuyen" data-i18n="eCommerce">Đang Chuyển</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/don-hang/da-giao') ? 'active' : '' }}"><a class="menu-item"
                        href="/store/don-hang/da-giao" data-i18n="eCommerce">Đã Giao</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
