@extends('master_admin')
@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div>
        Quản lý danh mục
        <div class="page-title-subheading">
            Thêm Mới Danh Sách danh mục và Quản Lý Các Danh Mục
        </div>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-5">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Thêm Mới Danh Mục</h5>
                        <form autocomplete="off" id="createDanhMuc">
                            <div class="position-relative form-group">
                                <label>Tên Danh Mục</label>
                                <input id="ten_danh_muc" name="ten_danh_muc" placeholder="Nhập vào tên danh mục"
                                    type="text" class="form-control">
                            </div>
                            <div class="position-relative form-group">
                                <label>Slug Danh Mục</label>
                                <input id="slug_danh_muc" name="slug_danh_muc" placeholder="Nhập vào slug danh mục"
                                    type="text" class="form-control">
                            </div>

                            {{-- <div class="position-relative form-group">
                            <label>Danh Mục Cha</label>
                            <select id="id_danh_muc_cha" name="id_danh_muc_cha" class="form-control">


                            </select>
                        </div> --}}
                            <div class="position-relative form-group">
                                <label>Tình Trạng</label>
                                <select id="is_open"class="form-control">
                                    <option value=1>Hiển Thị</option>
                                    <option value=0>Tạm Tắt</option>
                                </select>
                            </div>
                            <button class="mt-1 btn btn-primary" id="createDM">Thêm Mới Danh Mục</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Table Danh Mục</h5>
                        <table class="mb-0 table table-bordered" id="tableDanhMuc">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tên Danh Mục</th>
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
                    <h5 class="modal-title">Xóa Danh Mục Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa? Điều này không thể hoàn tác.
                    <input type="text" class="form-control" placeholder="Nhập vào id cần xóa" id="idDeleteDanhMuc"
                        hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="accpectDelete" class="btn btn-danger" data-dismiss="modal">Xóa Danh
                        Mục</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh Sửa Danh Mục Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="position-relative form-group">
                        <label>Tên Danh Mục</label>
                        <input id="ten_danh_muc_edit" placeholder="Nhập vào tên danh mục" type="text"
                            class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label>Slug Danh Mục</label>
                        <input id="slug_danh_muc_edit" placeholder="Nhập vào slug danh mục" type="text"
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
                    <button type="button" id="accpectUpdate" class="btn btn-success">Cập Nhật Danh Mục</button>
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

                function toSlug(str) {
                    str = str.toLowerCase();
                    str = str
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '');
                    str = str.replace(/[đĐ]/g, 'd');
                    str = str.replace(/([^0-9a-z-\s])/g, '');
                    str = str.replace(/(\s+)/g, '-');
                    str = str.replace(/-+/g, '-');
                    str = str.replace(/^-+|-+$/g, '');
                    return str;
                }
                $("#ten_danh_muc").keyup(function() {
                    var tenDanhMuc = $("#ten_danh_muc").val();
                    var slugDanhMuc = toSlug(tenDanhMuc);
                    $("#slug_danh_muc").val(slugDanhMuc);
                });

                function loadTable() {
                    $.ajax({
                        url: '/admin/danh-muc-san-pham/data',
                        type: 'get',
                        success: function(res) {
                            // var list_danh_muc = res.list;
                            var content_table = '';
                            $.each(res.data, function(key, value) {
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
                                content_table += '<td> ' + value.ten_danh_muc + ' </td>';
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
                            $("#tableDanhMuc tbody").html(content_table);
                        },
                    });
                }
                loadTable();
                $("#createDM").click(function(e) {
                    console.log(123);
                    e.preventDefault();
                    var val_ten_danh_muc = $("#ten_danh_muc").val();
                    var val_slug_danh_muc = $("#slug_danh_muc").val();
                    var val_trang_thai = $("#is_open").val();

                    var payload = {
                        'ten_danh_muc': val_ten_danh_muc,
                        'slug_danh_muc': val_slug_danh_muc,
                        'trang_thai': val_trang_thai,
                    };

                    $.ajax({
                        url: '/admin/danh-muc-san-pham/index',
                        type: 'post',
                        data: payload,
                        success: function(res) {
                            toastr.success("Đã thêm mới danh mục thành công!");
                            loadTable();
                            $('#createDanhMuc').trigger("reset");
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
                        url: '/admin/danh-muc-san-pham/status/' + idStatus,
                        type: 'get',
                        success: function(res) {
                            if (res.trangThai) {
                                toastr.success('Đã đổi trạng thái thành công!');
                                // Tình trạng mới là true
                                // loadTable();
                                if (res.tinhTrangDanhMuc == true) {
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
                    console.log(getId);
                    $("#idDeleteDanhMuc").val(getId);
                });

                $("#accpectDelete").click(function() {
                    var id = $("#idDeleteDanhMuc").val();
                    $.ajax({
                        url: '/admin/danh-muc-san-pham/delete/' + id,
                        type: 'get',
                        success: function(res) {
                            if (res.status) {
                                toastr.success('Đã xóa danh mục thành công!');
                                loadTable();
                            } else {
                                toastr.error('Danh mục không tồn tại!');
                            }
                        },
                    });
                });
                $('body').on('click', '.edit', function() {
                    var id = $(this).data('idedit');
                    console.log(id);
                    $.ajax({
                        url: '/admin/danh-muc-san-pham/edit/' + id,
                        type: 'get',
                        success: function(res) {
                            if (res.status) {
                                $("#ten_danh_muc_edit").val(res.data.ten_danh_muc);
                                $("#slug_danh_muc_edit").val(res.data.slug_danh_muc);
                                $("#is_open_edit").val(res.data.trang_thai);
                                $("#id_edit").val(res.data.id);
                            } else {
                                toastr.error('Danh mục sản phẩm không tồn tại!');
                                window.setTimeout(function() {
                                    $('#closeModal').click();
                                }, 1000);
                            }
                        },
                    });
                });
                $("#ten_danh_muc_edit").keyup(function() {
                    var tenDanhMuc = $("#ten_danh_muc_edit").val();
                    var slugDanhMuc = toSlug(tenDanhMuc);
                    $("#slug_danh_muc_edit").val(slugDanhMuc);
                });
                $("#accpectUpdate").click(function() {
                    var val_ten_danh_muc = $("#ten_danh_muc_edit").val();
                    var val_slug_danh_muc = $("#slug_danh_muc_edit").val();

                    // var val_id_danh_muc_cha = $("#id_danh_muc_cha_edit").val();
                    var val_is_open = $("#is_open_edit").val();
                    var val_id = $("#id_edit").val();
                    var payload = {
                        'ten_danh_muc': val_ten_danh_muc,
                        'slug_danh_muc': val_slug_danh_muc,
                        'trang_thai': val_is_open,
                        'id': val_id,
                    };


                    // Gửi payload lên trên back-end bằng con đường ajax
                    $.ajax({
                        url: '/admin/danh-muc-san-pham/update',
                        type: 'post',
                        data: payload,
                        success: function(res) {
                            if (res.status) {
                                toastr.success('Danh mục sản phẩm đã được cập nhật!');
                                $('#closeModalUpdate').click();
                                loadTable();
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
