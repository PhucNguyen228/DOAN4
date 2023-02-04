@extends('master_admin')
@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div style="text-align: center; font-size: 25px">
        <b> Quản lý thuế </b>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body" style="text-align: center">
                    <h5 class="card-title">Bảng thêm thuế</h5>
                    <form autocomplete="off">
                        <div class="position-relative form-group">
                            <label style="float: left">Tên thuế</label>
                            <input id="ten_thue" name="ten_thue" placeholder="Nhập tên hoặc chú thích cho thuế"
                                type="text" class="form-control">
                        </div>

                        <div class="position-relative form-group">
                            <label style="float: left">Mức thuế</label>
                            <input id="muc_thue" name="muc_thue" placeholder="Nhập vào mức thuế" type="text"
                                class="form-control">
                        </div>

                        <div class="position-relative form-group">
                            <label style="float: left">Tình Trạng</label>
                            <select id="is_open"class="form-control">
                                <option value=1>Hiển Thị</option>
                                <option value=0>Tạm Tắt</option>
                            </select>
                        </div>
                        <button type="submit" style="float: left" class="mt-1 btn btn-primary"
                            id="create_Thue">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body" style="text-align: center">
                    <h5 class="card-title">Bảng thuế</h5>
                    <table class="mb-0 table table-bordered" id="tableThue">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Thuế</th>
                                <th class="text-center">Mức thuế</th>
                                <th class="text-center">Tình trạng</th>
                                <th class="text-center">Ngày tạo</th>
                                <th class="text-center">Cập nhập</th>
                                <th class="text-center">Sửa</th>
                                <th class="text-center">Xoá</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa Thuế</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa? Điều này không thể hoàn tác.
                    <input type="text" class="form-control" placeholder="Nhập vào id cần xóa" id="idDeleteThue" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="accpectDelete" class="btn btn-danger" data-dismiss="modal">Xóa Thuế</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh Sửa Thuế</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="position-relative form-group">
                        <label>Tên Thuế</label>
                        <input id="ten_thue_edit" placeholder="Nhập vào tên danh mục" type="text" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label>Mức Thuế</label>
                        <input id="muc_thue_edit" placeholder="Nhập vào slug danh mục" type="text"
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

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadTable() {
                $.ajax({
                    url: "{{ route('admin.thue.data') }}",
                    type: 'GET',
                    success: function(res) {
                        // var list_danh_muc = res.list;
                        var content_table = '';
                        $.each(res.data, function(key, value) {
                            if (value.Trang_thai) {
                                var class_button = 'btn-primary';
                                var text_button = 'Hiển thị';
                            } else {
                                var text_button = 'Tạm tắt';
                                var class_button = 'btn-danger';
                            }
                            content_table += '<tr>';
                            content_table += '<th class="text-center" scope="row">' + (key +
                                1) + '</th>';
                            content_table += '<td> ' + value.Ten_thue + ' </td>';
                            content_table += '<td> ' + value.Muc_thue + ' </td>';
                            content_table += '<td class="text-center">';
                            content_table += '<button data-id="' + value.id +
                                '" class="status btn ' + class_button + '">';
                            content_table += text_button;
                            content_table += '<td> ' + value.created_at + ' </td>';
                            content_table += '<td> ' + value.updated_at + ' </td>';
                            content_table += '</button></td>';
                            content_table += '<td class="text-center">';
                            content_table +=
                                '<button class="btn btn-primary edit mr-1" data-idedit=' + value
                                .id +
                                ' data-toggle="modal" data-target="#editModal">Sửa</button>';
                            content_table += '</td>';
                            content_table += '<td class="text-center">';
                            content_table +=
                                '<button class="btn btn-danger delete mr-1" data-iddelete="' +
                                value.id +
                                '" data-toggle="modal" data-target="#deleteModal">Xoá</button>';
                            content_table += '</td>';
                            content_table += '</tr>';
                        });
                        $("#tableThue tbody").html(content_table);
                    },
                });
            }
            loadTable();

            $('#create_Thue').click(function(e) {
                e.preventDefault();
                var ten_thue = $('#ten_thue').val();
                var muc_thue = $('#muc_thue').val();
                var is_open = $('#is_open').val();

                payload = {
                    ten_thue: ten_thue,
                    muc_thue: muc_thue,
                    is_open: is_open,
                }

                $.ajax({
                    url: "{{ route('admin.thue.create') }}",
                    type: "POST",
                    data: payload,
                    success: function(response) {
                        if (response.success) {
                            loadTable();
                            $('#createModal').trigger("reset");
                        } else {
                            loadTable();
                        }
                    },
                    error: function(response) {
                        var danh_sach_loi = response.responseJSON.errors;
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
                    url: '/admin/thue/status/' + idStatus,
                    type: 'GET',
                    success: function(res) {
                        if (res.trangThai) {
                            toastr.success('Đã đổi trạng thái thành công!');
                            // Tình trạng mới là true
                            // loadTable();
                            if (res.tinhTrangThue == true) {
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
                $("#idDeleteThue").val(getId);
            });

            $("#accpectDelete").click(function() {
                var id = $("#idDeleteThue").val();
                console.log(id);
                $.ajax({
                    url: '/admin/thue/delete/' + id,
                    type: 'GET',
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
                $.ajax({
                    url: '/admin/thue/edit/' + id,
                    type: 'GET',
                    success: function(res) {
                        if (res.status) {
                            $("#id_edit").val(res.data.id);
                            $("#ten_thue_edit").val(res.data.Ten_thue);
                            $("#muc_thue_edit").val(res.data.Muc_thue);
                            $("#is_open_edit").val(res.data.Trang_thai);
                        } else {
                            toastr.error('Danh mục không tồn tại!');
                        }
                    },
                });
            });

            $("#accpectUpdate").click(function() {
                var val_ten_thue = $("#ten_thue_edit").val();
                var val_muc_thue = $("#muc_thue_edit").val();
                var val_is_open = $("#is_open_edit").val();
                var val_id = $("#id_edit").val();

                console.log(val_ten_thue);
                console.log(val_muc_thue);
                console.log(val_is_open);
                console.log(val_id);
                
                var payload = {
                    'Ten_thue': val_ten_thue,
                    'Muc_thue': val_muc_thue,
                    'Trang_thai': val_is_open,
                    'id': val_id,
                };


                // Gửi payload lên trên back-end bằng con đường ajax
                $.ajax({
                    url: '/admin/thue/update',
                    type: 'POST',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Thuế đã được cập nhật!');
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
