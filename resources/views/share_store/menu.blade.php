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
                    <li class=" nav-item {{ request()->is('store/san-pham/index') ? 'active' : '' }}"><a class="menu-item"
                        href="/store/san-pham/index" data-i18n="eCommerce">Sản Phẩm</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/khuyen-mai/index') ? 'active' : '' }}"><a class="menu-item"
                        href="/store/khuyen-mai/index" data-i18n="eCommerce">Đợt Khuyến Mãi</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/ty-le/index') ? 'active' : '' }}"><a class="menu-item"
                        href="/store/ty-le/index" data-i18n="eCommerce">Tỷ Lệ Khuyến Mãi</a>
                    </li>
                    <li class=" nav-item {{ request()->is('store/yeu-cau/index') ? 'active' : '' }}"><a class="menu-item"
                        href="/store/yeu-cau/index" data-i18n="eCommerce">Yêu cầu danh mục</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>