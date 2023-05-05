@extends('master_store')
@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div style="text-align: center">
        <b style="color: red; font-size: 20px">Đơn Hàng Chờ Xác Nhận</b>
    </div>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="table-response">
            <div class="main-card mb-3 card">
                <div class="card-body" style="overflow-x:auto;">
                    <table style="text-align: center" class="mb-0 table table-bordered" id="tableSanPham">
                        <thead>
                            <tr>
                                <th class="text-nowrap text-center">#</th>
                                <th class="text-nowrap text-center">Tên Khách Hàng</th>
                                <th class="text-nowrap text-center">Mã đơn hàng</th>
                                <th class="text-nowrap text-center">Tên sản Phẩm</th>
                                <th class="text-nowrap text-center">Tiển Trả</th>
                                <th class="text-nowrap text-center">Địa Chỉ</th>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadTable() {
                $.ajax({
                    url: '/store/don-hang/cho-xac-nhan/data',
                    type: 'get',
                    success: function(res) {
                        var html = '';

                        $.each(res.data, function(key, value) {
                            if (value.tinh_trang == 1) {
                                var doan_muon_hien_thi =
                                    '<button class="btn btn-primary status" data-id="' +
                                    value.id + '">Xác Nhận</button>';
                            }

                            html += '<tr>';
                            html += '<th scope="row">' + (key + 1) + '</th>';
                            html += '<th class="text-nowrap text-center">'+ value.ho_ten +'</th>';
                            html += '<th class="text-nowrap text-center">'+ value.ma_don_hang +'</th>';
                            html += '<th class="text-nowrap text-center">'+ value.ten_san_pham +' , <b>số lượng :</b> '+ value.so_luong +'</th>';
                            html += '<th class="text-nowrap text-center">'+ value.tien_tra +'</th>';
                            html += '<th class="text-nowrap text-center">'+ value.dia_chi +'</th>';
                            html += '<td>' + doan_muon_hien_thi + '</td>';
                            html += '</tr>';
                        });
                        $("#tableSanPham tbody").html(html);

                    },
                });
            }
            loadTable();
            $('body').on('click', '.status', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/store/don-hang/tinh-trang/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success('đã xác nhận thành công');
                            loadTable();
                        }
                    },
                });
            });
        });
    </script>
@endsection
