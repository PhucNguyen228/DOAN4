@extends('master_store')
@section('title')
<div class="page-title-icon">
    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
</div>
<div style="text-align: center">
    <b style="color: red; font-size: 20px">Đơn Hàng Đã Giao</b>
</div>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="table-response">
            <div class="main-card mb-3 card">
                <div class="card-body" style="overflow-x:auto;">
                    <table style="text-align: center" class="mb-0 table table-bordered" id="tableSanPham" >
                        <thead>
                            <tr>
                                <th class="text-nowrap text-center">#</th>
                                <th class="text-nowrap text-center">Tên Khách Hàng</th>
                                <th class="text-nowrap text-center">Mã đơn hàng</th>
                                <th class="text-nowrap text-center">Tên sản Phẩm</th>
                                <th class="text-nowrap text-center">Tiển Trả</th>
                                <th class="text-nowrap text-center">Địa Chỉ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-nowrap text-center">1</th>
                                <th class="text-nowrap text-center">Đặng Ngọc Thơm</th>
                                <th class="text-nowrap text-center">29d5cdc4-15e5-421a-a237-597ef2e341d2</th>
                                <th class="text-nowrap text-center">củ cải , <b>số lượng :</b> 2</th>
                                <th class="text-nowrap text-center">60000</th>
                                <th class="text-nowrap text-center">58 hòa minh 7, Phường Hòa Minh, Quận Liên Chiểu, TP.Đà Nẵng</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
