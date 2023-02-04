@extends('master_homepage')
@section('titel')
    <div class="col-md-12">
        <div class="table-response">
            <div class="main-card mb-3 card">
                <div style="text-align: center" class="card-body">
                    <h5 style="color: red; font-size: 35px" class="card-title"><b>Quản Lý Đơn Hàng</b></h5>
                    <table style="text-align: center" class="mb-0 table table-bordered" id="tableSanPham">
                        <thead>
                            <tr>
                                <th class="text-nowrap text-center">#</th>
                                <th class="text-nowrap text-center">Mã đơn hàng</th>
                                <th class="text-nowrap text-center">Tên sản Phẩm</th>
                                <th class="text-nowrap text-center">Tiển Trả</th>
                                <th class="text-nowrap text-center">Địa Chỉ</th>
                                <th class="text-nowrap text-center">Tình Trạng</th>
                                <th class="text-nowrap text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-nowrap text-center">1</th>
                                <th class="text-nowrap text-center">29d5cdc4-15e5-421a-a237-597ef2e341d2</th>
                                <th class="text-nowrap text-center">củ cải , <b>số lượng :</b> 2</th>
                                <th class="text-nowrap text-center">60000</th>
                                <th class="text-nowrap text-center">58 hòa minh 7, Phường Hòa Minh, Quận Liên Chiểu, TP.Đà Nẵng</th>
                                <th class="text-nowrap text-center" style="color: green">đang chờ xác nhận</th>
                                <th class="text-nowrap text-center"><button style="background: red;color: white">Hủy</button></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
