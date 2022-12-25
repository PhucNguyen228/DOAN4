@extends('master_store')
@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div>
        Quản lý Khuyến Mãi
        <div class="page-title-subheading">
            Thêm Mới Tỷ Lệ Khuyến Mãi
        </div>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-4">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Thêm Mới Khuyến Mãi</h5>
                        <form autocomplete="off" id="createDanhMuc">
                            <div class="position-relative form-group">
                                <label>Tên Đợt</label>
                                <input id="ten_dot_KM" placeholder="Nhập vào tên đợt" type="text" class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label>Ngày Bắt Đầu</label>
                                <input id="ngay_bd" placeholder="Nhập vào ngày bắt đầu" type="date"
                                    class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label>Ngày Kết Thúc</label>
                                <input id="ngay_kt" placeholder="Nhập vào ngày kết thúc" type="date"
                                    class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label>Tình Trạng</label>
                                <select id="is_open"class="form-control">
                                    <option value=1>Hiển Thị</option>
                                    <option value=0>Tạm Tắt</option>
                                </select>
                            </div>
                            <button class="mt-1 btn btn-primary" id="createKM">Thêm Mới Khuyến Mãi</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Table Đợt Khuyến Mãi</h5>
                        <table class="mb-0 table table-bordered" id="tableKM">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tên Đợt</th>
                                    <th class="text-center">Ngày Bắt Đầu</th>
                                    <th class="text-center">Ngày Kết Thúc</th>
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
                    <h5 class="modal-title">Xóa Đợt Khuyến Mãi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa? Điều này không thể hoàn tác.
                    <input type="text" class="form-control" placeholder="Nhập vào id cần xóa" id="idDeleteKM"
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
                    <h5 class="modal-title">Chỉnh Sửa Đợt Khuyến Mãi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="position-relative form-group">
                        <label>Tên Đợt</label>
                        <input id="ten_dot_KM_edit" placeholder="Nhập vào tên khuyến mãi" type="text"
                            class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label>Ngày Bắt Đầu</label>
                        <input id="ngay_bd_edit" placeholder="Nhập vào ngày bắt đầu" type="date"
                            class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label>Ngày Kết Thúc</label>
                        <input id="ngay_kt_edit" placeholder="Nhập vào ngày kết thúc" type="date"
                            class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label>Tình Trạng</label>
                        <select id="is_open_edit"class="form-control">
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

                function loadTable() {
                    $.ajax({
                        url: '/store/khuyen-mai/dataKM',
                        type: 'get',
                        success: function(res) {
                            // var list_danh_muc = res.list;
                            var content_table = '';
                            $.each(res.dataKM, function(key, value) {
                                // if(value.ten_danh_muc_cha === null) {
                                //     var ten_danh_muc_cha = 'Root';
                                // } else {
                                //     var ten_danh_muc_cha = value.ten_danh_muc_cha;
                                // }
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
                                content_table += '<td> ' + value.ten_dot_KM + ' </td>';
                                content_table += '<td> ' + value.ngay_bd + ' </td>';
                                content_table += '<td> ' + value.ngay_kt + ' </td>';
                                // content_table += '<td> ' + ten_danh_muc_cha + ' </td>';
                                content_table += '<td class="text-center">';
                                content_table += '<button data-id="' + value.id +
                                    '" class="status btn ' + class_button + '">';
                                content_table += text_button;
                                content_table += '</button></td>';
                                content_table += '<td class="text-center">';
                                content_table +=
                                    '<button class="btn btn-danger delete mr-1" data-iddelete="' +
                                    value.id +
                                    '" data-toggle="modal" data-target="#deleteModal">Delete</button>';
                                content_table +=
                                    '<button class="btn btn-primary edit mr-1" data-idedit=' + value
                                    .id +
                                    ' data-toggle="modal" data-target="#editModal">Edit</button>';
                                content_table += '</td>';
                                content_table += '</tr>';
                            });
                            $("#tableKM tbody").html(content_table);
                        },
                    });
                }
                loadTable();
                $("#createKM").click(function(e) {
                    e.preventDefault();
                    var val_ten_dot = $("#ten_dot_KM").val();
                    var val_ngay_bd = $("#ngay_bd").val();
                    var val_ngay_kt = $("#ngay_kt").val();
                    var val_trang_thai = $("#is_open").val();

                    var payload = {
                        'ten_dot_KM': val_ten_dot,
                        'ngay_bd': val_ngay_bd,
                        'ngay_kt': val_ngay_kt,
                        'trang_thai': val_trang_thai,
                    };
                    
                    $.ajax({
                        url: '/store/khuyen-mai/index',
                        type: 'post',
                        data: payload,
                        success: function(res) {
                        if(res.status){
                            toastr.success("Đã thêm mới khuyến mãi thành công!");
                            loadTable();
                            $('#createDanhMuc').trigger("reset");
                        }else{
                            toastr.error("Đợt khuyến mãi đã tồn tại!");
                        }
                        },
                        error: function(res) {
                            var danh_sach_loi = res.responseJSON.errors;
                            $.each(danh_sach_loi, function(key, value) {
                                toastr.error(value[0]);
                            });
                        }
                    });
                });
                $('body').on('click', '.status', function() {
                    var idStatus = $(this).data('id');
                    var self = $(this);
                    $.ajax({
                        url: '/store/khuyen-mai/status/' + idStatus,
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
                $('body').on('click', '.delete', function() {
                    var getId = $(this).data('iddelete');
                    $("#idDeleteKM").val(getId);
                });

                $("#accpectDelete").click(function() {
                    var id = $("#idDeleteKM").val();
                    $.ajax({
                        url: '/store/khuyen-mai/delete/' + id,
                        type: 'get',
                        success: function(res) {
                            if (res.status) {
                                toastr.success('Đã xóa Khuyến Mãi thành công!');
                                loadTable();
                            } else {
                                toastr.error('Khuyến mãi không tồn tại!');
                            }
                        },
                    });
                });
                $('body').on('click', '.edit', function() {
                    var id = $(this).data('idedit');
                    console.log(id);
                    $.ajax({
                        url: '/store/khuyen-mai/edit/' + id,
                        type: 'get',
                        success: function(res) {
                            if (res.status) {
                                $("#ten_dot_KM_edit").val(res.data.ten_dot_KM);
                                $("#ngay_bd_edit").val(res.data.ngay_bd);
                                $("#ngay_kt_edit").val(res.data.ngay_kt);
                                $("#is_open_edit").val(res.data.trang_thai);
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
                    var val_ten_dot_KM = $("#ten_dot_KM_edit").val();
                    var val_ngay_bd = $("#ngay_bd_edit").val();
                    var val_ngay_kt = $("#ngay_kt_edit").val();
                    var val_is_open = $("#is_open_edit").val();
                    var val_id = $("#id_edit").val();
                    var payload = {
                        'ten_dot_KM': val_ten_dot_KM,
                        'ngay_bd': val_ngay_bd,
                        'ngay_kt': val_ngay_kt,
                        'trang_thai': val_is_open,
                        'id': val_id,
                    };


                    // Gửi payload lên trên back-end bằng con đường ajax
                    $.ajax({
                        url: '/store/khuyen-mai/update',
                        type: 'post',
                        data: payload,
                        success: function(res) {
                            if (res.status) {
                                toastr.success('Khuyến Mãi đã được cập nhật!');
                                $('#closeModalUpdate').click();
                                loadTable();
                            }else{
                                toastr.error('Tên đợt khuyến mãi đã tồn tại');
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
