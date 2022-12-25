@extends('master_store')
@section('title')
    <div class="row">
        <div class="col-md-12" style="text-align: center; font-size: 20px ; color: red">
            <b>Quản lý Tỷ Lệ Khuyến Mãi</b>
            <div class="page-title-subheading">
                <b>Thêm Mới Tỷ Lệ Khuyến Mãi</b>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-3">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Thêm Mới Khuyến Mãi</h5>
                        <form autocomplete="off" id="createTyLeKM">
                            <div class="position-relative form-group">
                                <label>Tên Đợt Khuyến Mãi</label>
                                <select id="dot_KM" class="form-control">
                                    @foreach ($list_KM as $value)
                                        <option value={{ $value->id }}> {{ $value->ten_dot_KM }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="position-relative form-group">
                                <label>Tên Sản Phẩm</label>
                                <select id="san_pham" class="form-control">
                                    @foreach ($list_SP as $value)
                                        <option value={{ $value->id }}> {{ $value->ten_san_pham }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="position-relative form-group">
                                <label>Tỷ Lệ Khuyến Mãi (%)</label>
                                <div>
                                    {{-- <input id="ty_le" placeholder="Nhập vào tỷ lệ %" type="number"
                                        class="form-control"> --}}
                                    <input id="ty_le" placeholder="Nhập vào tỷ lệ %"><i class="fa fa-percent"
                                        aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <label>Tình Trạng</label>
                                <select id="tinh_trang"class="form-control">
                                    <option value=1>Hiển Thị</option>
                                    <option value=0>Tạm Tắt</option>
                                </select>
                            </div>
                            <div style="text-align: right">
                                <button class="mt-1 btn btn-primary" id="createKM">Thêm Mới Khuyến Mãi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="main-card mb-3 card">
                    <div class="card-body" >
                        <h5 class="card-title">Table Tỷ Kệ Khuyến Mãi</h5>
                        <table style="text-align: center" class="mb-0 table table-bordered" id="tableTyLe">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tên Đợt</th>
                                    <th class="text-center">Tên sản phẩm</th>
                                    <th class="text-center">Tỷ Lệ Khuyến Mãi (%)</th>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa Tỷ Lệ Khuyến Mãi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa? Điều này không thể hoàn tác.
                    <input type="text" class="form-control" placeholder="Nhập vào id cần xóa" id="idDeleteTyLe"
                        hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="accpectDelete" class="btn btn-danger" data-dismiss="modal">Xóa </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh Sửa Tỷ Lệ Khuyến Mãi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="position-relative form-group">
                        <label>Tên Đợt</label>
                        <select id="dot_KM_edit" class="form-control">
                            @foreach ($list_KM as $value)
                                <option value={{ $value->id }}> {{ $value->ten_dot_KM }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label>Tên Sản Phẩm</label>
                        <select id="san_pham_edit" class="form-control">
                            @foreach ($list_SP as $value)
                                <option value={{ $value->id }}> {{ $value->ten_san_pham }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="position-relative form-group">
                        <label>Tỷ Lệ Khuyến Mãi (%)</label>
                        <div>
                            <input id="ty_le_edit" placeholder="Nhập vào tỷ lệ %"><i class="fa fa-percent"
                                aria-hidden="true"></i>

                        </div>
                    </div>
                    <div class="position-relative form-group">
                        <label>Tình Trạng</label>
                        <select id="tinh_trang_edit"class="form-control">
                            <option value=1>Hiển Thị</option>
                            <option value=0>Tạm Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModalUpdate" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="button" id="accpectUpdate" class="btn btn-success">Cập Nhật </button>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#createKM").click(function(e) {
                    e.preventDefault();
                    var id_san_pham = $("#san_pham").val();
                    var id_khuyen_mai = $("#dot_KM").val();
                    var ty_le = $("#ty_le").val();
                    var tinh_trang = $("#tinh_trang").val();
                    var payload = {
                        'id_san_pham': id_san_pham,
                        'id_khuyen_mai': id_khuyen_mai,
                        'ti_le_KM': ty_le,
                        'trang_thai': tinh_trang,
                    };
                    // console.log(payload);
                    $.ajax({
                        url: '/store/ty-le/index',
                        type: 'post',
                        data: payload,
                        success: function(res) {
                            if (res.status) {
                                toastr.success('Thêm mới tỷ lệ khuyến mãi thành công!');
                                loadTable();
                                $('#createTyLeKM').trigger("reset");
                            } else {
                                toastr.error('tỷ lệ khuyến Đã Tồn Tại');
                                $('#createTyLeKM').trigger("reset");
                            }
                        },
                        error: function(res) {
                            var errros = res.responseJSON.errors;
                            $.each(errros, function(key, value) {
                                toastr.error(value[0]);
                            });
                        }
                    });

                });

                function loadTable() {
                    console.log(123);
                    $.ajax({
                        url: '/store/ty-le/dataTyLe',
                        type: 'get',
                        success: function(res) {
                            var html = '';
                            $.each(res.dataTyLe, function(key, value) {
                                if (value.trang_thai == true) {
                                    var doan_muon_hien_thi =
                                        '<button class="btn btn-primary status" data-idtrangthai="' +
                                        value.id + '">Hiển Thị</button>';
                                } else {
                                    var doan_muon_hien_thi =
                                        '<button class="btn btn-danger status" data-idtrangthai="' +
                                        value.id + '">Tạm Tắt</button>';
                                }

                                html += '<tr>';
                                html += '<th scope="row">' + (key + 1) + '</th>';
                                html += '<td>' + value.ten_dot_KM + '</td>';
                                html += '<td>' + value.ten_san_pham + '</td>';
                                html += '<td>' + value.ti_le_KM +
                                    ' <i class="fa fa-percent" aria-hidden="true"></i> </td>';
                                html += '<td>' + doan_muon_hien_thi + '</td>';
                                html += '<td>';
                                html +=
                                    '<button class="btn btn-danger delete mr-1" data-iddelete="' +
                                    value.id +
                                    '" data-toggle="modal" data-target="#deleteModal"> Xóa </button>';
                                html +=
                                    '<button class="btn btn-success edit" data-idedit="' +
                                    value.id +
                                    '" data-toggle="modal" data-target="#editModal"> Chỉnh sửa </button>';
                                html += '</td>';
                                html += '</tr>';
                            });
                            $("#tableTyLe tbody").html(html);

                        },
                    });
                }
                loadTable();
                $('body').on('click', '.delete', function() {
                    var getId = $(this).data('iddelete');
                    $("#idDeleteTyLe").val(getId);
                });
                $("#accpectDelete").click(function() {
                    var id = $("#idDeleteTyLe").val();
                    $.ajax({
                        url: '/store/ty-le/delete/' + id,
                        type: 'get',
                        success: function(res) {
                            if (res.status) {
                                toastr.success('Đã xóa tỷ lệ Khuyến Mãi thành công!');
                                loadTable();
                            } else {
                                toastr.error('Tỷ lệ Khuyến mãi không tồn tại!');
                            }
                        },
                    });
                });
                $('body').on('click', '.status', function() {
                    var idStatus = $(this).data('idtrangthai');
                    var self = $(this);
                    $.ajax({
                        url: '/store/ty-le/status/' + idStatus,
                        type: 'get',
                        success: function(res) {
                            if (res.trangThai) {
                                toastr.success('Đã đổi trạng thái thành công!');
                                // Tình trạng mới là true
                                // loadTable();
                                if (res.tinhTrangKM == true) {
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
                $('body').on('click', '.edit', function() {
                    var id = $(this).data('idedit');
                    console.log(id);
                    $.ajax({
                        url: '/store/ty-le/edit/' + id,
                        type: 'get',
                        success: function(res) {
                            if (res.status) {
                                $("#dot_KM_edit").val(res.data.id_khuyen_mai);
                                $("#san_pham_edit").val(res.data.id_san_pham);
                                $("#ty_le_edit").val(res.data.ti_le_KM);
                                $("#tinh_trang_edit").val(res.data.trang_thai);
                                $("#id_edit").val(res.data.id);
                            } else {
                                toastr.error('Khuyến Mãi không tồn tại!');
                                window.setTimeout(function() {
                                    $('#closeModal').click();
                                }, 1000);
                            }
                        },
                    });
                });
                $("#accpectUpdate").click(function() {
                    var val_ten_dot_KM = $("#dot_KM_edit").val();
                    var val_ten_san_pham = $("#san_pham_edit").val();
                    var val_ty_le = $("#ty_le_edit").val();
                    var val_trang_thai = $("#tinh_trang_edit").val();
                    var val_id = $("#id_edit").val();
                    var payload = {
                        'id_khuyen_mai': val_ten_dot_KM,
                        'id_san_pham': val_ten_san_pham,
                        'ti_le_KM': val_ty_le,
                        'trang_thai': val_trang_thai,
                        'id': val_id,
                    };


                    // Gửi payload lên trên back-end bằng con đường ajax
                    $.ajax({
                        url: '/store/ty-le/update',
                        type: 'post',
                        data: payload,
                        success: function(res) {
                            if (res.status) {
                                toastr.success('Tỷ Lệ Khuyến Mãi đã được cập nhật!');
                                $('#closeModalUpdate').click();
                                loadTable();
                            }else{
                                toastr.error('Tên Tỷ Lệ khuyến mãi đã tồn tại');
                            }
                        },
                        error: function(res) {
                            var danh_sach_loi = res.responseJSON.errors;
                            $.each(danh_sach_loi, function(key, value) {
                                toastr.error(value[0]);
                            });
                        },
                    });
                });
            });
        </script>
    @endsection
