@extends('master_admin')
@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div style="text-align: center; font-size: 25px">
        <b> Quản Lý Tài Khoản Store Owner </b>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body" style="text-align: center">
                    <h5 class="card-title">Table Tài Khoản Owner</h5>
                    <table class="mb-0 table table-bordered" id="tableStore">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Tài Khoản</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">SĐT</th>
                                <th class="text-center">Địa Chỉ</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Action</th>
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
                    url: '/admin/store/data',
                    type: 'get',
                    success: function(res) {
                        var content_table = '';
                        $.each(res.TK_Store, function(key, value) {
                            if (value.trang_thai) {
                                var class_button = 'btn-primary';
                                var text_button = 'Hiển thị';
                            } else {
                                var text_button = 'Tạm tắt';
                                var class_button = 'btn-danger';
                            }
                            content_table += '<tr>';
                            content_table += '<th class="text-center" scope="row">' + (key +
                                1) + '</th>';
                            content_table += '<td> ' + value.ten_tai_khoan + ' </td>';
                            content_table += '<td> ' + value.email + ' </td>';
                            content_table += '<td> ' + value.sdt + ' </td>';
                            content_table += '<td> ' + value.dia_chi + ' </td>';
                            content_table += '<td class="text-center">';
                            content_table += '<button data-id="' + value.id +
                                '" class="doiTrangThai btn ' + class_button + '">';
                            content_table += text_button;
                            content_table += '</button></td>';
                            content_table += '<td class="text-center">';
                            content_table +=
                                '<button class="btn btn-danger delete mr-1" data-iddelete="' +
                                value.id +
                                '" data-toggle="modal" data-target="#deleteModal">Delete</button>';
                            content_table += '</td>';
                            content_table += '</tr>';
                        });
                        $("#tableStore tbody").html(content_table);
                    },
                });
            }
            loadTable();
            $('body').on('click', '.doiTrangThai', function() {
                var idDanhMuc = $(this).data('id');
                var self = $(this);
                $.ajax({
                    url: '/admin/accout/status/' + idDanhMuc,
                    type: 'get',
                    success: function(res) {
                        if (res.trangThai) {
                            toastr.success('Đã đổi trạng thái thành công!');
                            // Tình trạng mới là true
                            // loadTable();
                            if (res.tinhTrangDanhMuc) {
                                self.html('Hiển Thị');
                                self.removeClass('btn-danger');
                                self.addClass('btn-primary');
                            } else {
                                self.html('Tạm Tắt');
                                self.removeClass('btn-primary');
                                self.addClass('btn-danger');
                            }
                            loadTable();
                        } else {
                            toastr.error('Vui lòng không can thiệp hệ thống!');
                        }

                    },
                });
            });
        });
    </script>
@endsection
