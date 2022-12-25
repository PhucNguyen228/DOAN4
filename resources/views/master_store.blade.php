<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<style>
    .oder {
        display: flex;
        justify-content: space-around;
    }
    .cricel {
        height: 30px ;
        width: 30px;
    }
</style>

<head>
    @include('share_store.head')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('share_store.top')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('share_store.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section id="dashboard-ecommerce">
                    <div class="content-wrapper">
                        <div class="content-header row">
                            <div class="content-header-left col-md-12 mb-2">
                                @yield('title')
                            </div>
                        </div>
                    </div>
                    <div class="content-body">
                        @yield('content')
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('share_store.foot')
    <!-- END: Footer-->
    @include('share_store.boot')
    @yield('js')
</body>
<!-- END: Body-->

</html>
