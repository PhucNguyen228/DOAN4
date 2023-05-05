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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function loadTable() {
                $.ajax({
                    url: '/customer/don-hang/data',
                    type: 'get',
                    success: function(res) {
                        var html = '';

                        $.each(res.data, function(key, value) {
                            if (value.tinh_trang == 1) {
                                var doan_muon_hien_thi =
                                    '<p class="text-nowrap text-center" style="color: green">đang chờ xác nhận</p>';
                            }else if(value.tinh_trang == 2){
                                var doan_muon_hien_thi =
                                    '<p class="text-nowrap text-center" style="color: green">Đã xác nhận</p>';
                            }

                            html += '<tr>';
                            html += '<th scope="row">' + (key + 1) + '</th>';
                            html += '<th class="text-nowrap text-center">'+ value.ma_don_hang +'</th>';
                            html += '<th class="text-nowrap text-center">'+ value.ten_san_pham +' , <b>số lượng :</b> '+ value.so_luong +'</th>';
                            html += '<th class="text-nowrap text-center">'+ value.tien_tra +'</th>';
                            html += '<th class="text-nowrap text-center">'+ value.dia_chi +'</th>';
                            html += '<th>' + doan_muon_hien_thi + '</th>';
                            html += '<th class="text-nowrap text-center"><button style="background: red;color: white">Hủy</button></th>';
                            html += '</tr>';
                        });
                        $("#tableSanPham tbody").html(html);

                    },
                });
            }
            loadTable();
        })
    </script>
@endsection
