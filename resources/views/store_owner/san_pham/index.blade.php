@extends('master_store')
@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div style="text-align: center; color: red; font-size: 20px">
        <b>Quản lý sản phẩm</b>
        <div class="page-title-subheading">
            <b>Thêm Mới Sản Phẩm và Quản Lý Sản Phẩm</b>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Thêm mới sản phẩm</h5>
                <form class="" id="formCreate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label>Tên Sản Phẩm</label>
                                <input id="ten_san_pham" placeholder="Nhập vào tên sản phẩm" type="text"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label>Slug Sản Phẩm</label>
                                <input id="slug_san_pham" placeholder="Nhập vào slug sản phẩm" type="text"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label>Giá Bán</label>
                                <input id="gia_ban" placeholder="Nhập vào giá bán" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label>Đơn Vị</label>
                                <input id="don_vi" placeholder="Nhập vào đơn vị" type="text"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <div class="input-group">
                                    <input id="hinh_anh" class="form-control" type="text" name="filepath">
                                    <span class="input-group-prepend">
                                        <a data-input="hinh_anh" data-preview="holder" class="btn btn-primary lfm">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="position-relative form-group">
                    <label>Mô Tả Ngắn</label>
                    <textarea class="form-control" id="mo_ta_ngan" cols="30" rows="5" placeholder="Nhập vào mô tả ngắn"></textarea>
                </div>
                <div class="position-relative form-group">
                    <label>Mô Tả Chi Tiết</label>
                    <input name="mo_ta_chi_tiet" id="mo_ta_chi_tiet" placeholder="Nhập vào mô tả chi tiết" type="text" class="form-control">
                </div> --}}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label>Danh Mục</label>
                                <select id="id_danh_muc" class="form-control">
                                    @foreach ($list_danh_muc as $value)
                                        <option value={{ $value->id }}> {{ $value->ten_danh_muc }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label>Tình Trạng</label>
                                <select id="is_open" class="form-control">
                                    <option value=1>Hiển Thị</option>
                                    <option value=0>Tạm tắt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label>Mô Tả Ngắn</label>
                                <textarea class="form-control" id="mo_ta_ngan" cols="30" rows="5" placeholder="Nhập vào mô tả ngắn"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label>Mô Tả Chi Tiết</label>
                                <input name="mo_ta_chi_tiet" id="mo_ta_chi_tiet" placeholder="Nhập vào mô tả chi tiết"
                                    type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <button class="mt-1 btn btn-primary" id="createSanPham">Thêm Mới Sản Phẩm</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="table-response">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Table Sản Phẩm</h5>
                    <table style="text-align: center" class="mb-0 table table-bordered" id="tableSanPham">
                        <thead>
                            <tr>
                                <th class="text-nowrap text-center">#</th>
                                <th class="text-nowrap text-center">Tên Sản Phẩm</th>
                                <th class="text-nowrap text-center">Slug Sản Phẩm</th>
                                <th class="text-nowrap text-center">Giá Bán</th>
                                <th class="text-nowrap text-center">Tình Trạng</th>
                                <th class="text-nowrap text-center">Danh Mục</th>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <input type="text" name="" id="idCanXoa" class="form-control" hidden>
                <h5 class="modal-title text-white" id="exampleModalLabel">Xoá Sản Phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="text-align: center; font-size: 20px">
                <b>Bạn có muốn xóa ???</b>
                <input type="text" class="form-control" placeholder="Nhập vào id cần xóa" id="idDeleteSP" hidden>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="accpectDelete" class="btn btn-danger" data-dismiss="modal">Xóa Sản
                    Phẩm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <label class="modal-title text-text-bold-600 text-white" id="myModalLabel33">
                    <h3>Chỉnh Sửa Sản Phẩm</h3>
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="number" class="form-control" id="id_edit" hidden>
                                    <fieldset class="form-group">
                                        <label>Tên Sản Phẩm</label>
                                        <input type="text" class="form-control" id="ten_san_pham_edit"
                                            placeholder="Nhập vào tên sản phẩm">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label>Slug Sản Phẩm</label>
                                        <input type="text" class="form-control" id="slug_san_pham_edit"
                                            placeholder="Nhập vào slug sản phẩm">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label>Giá Bán</label>
                                        <input type="number" class="form-control" id="gia_ban_edit"
                                            placeholder="Nhập vào giá bán">
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label>Đơn Vị</label>
                                        <input id="don_vi_edit" placeholder="Nhập vào đơn vị" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Hình Ảnh</label>
                                        <div class="input-group">
                                            <input id="hinh_anh_edit" class="form-control" type="text"
                                                name="filepath">
                                            <span class="input-group-prepend">
                                                <a data-input="hinh_anh_edit" data-preview="holder_edit"
                                                    class="btn btn-primary lfm">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                        </div>
                                        <div id="holder_edit" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="placeTextarea">Mô Tả Ngắn</label>
                                        <textarea class="form-control" id="mo_ta_ngan_edit" cols="30" rows="5"
                                            placeholder="Nhập vào mô tả ngắn"></textarea>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <label>Mô Tả Chi Tiết</label>
                                <input name="mo_ta_chi_tiet_edit" id="mo_ta_chi_tiet_edit"
                                    placeholder="Nhập vào mô tả chi tiết" type="text" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label>Danh Mục</label>
                                        <select id="id_danh_muc_edit" class="custom-select block">
                                            @foreach ($list_danh_muc as $value)
                                                <option value={{ $value->id }}> {{ $value->ten_danh_muc }} </option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label>Trạng thái</label>
                                        <select id="is_open_edit" class="custom-select block">
                                            <option value=1>Hiển Thị</option>
                                            <option value=0>Tạm tắt</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModalUpdate" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="button" id="accpectUpdate" class="btn btn-success">Cập Nhật Danh Mục</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('js')
    <script>
        var route_prefix = "/laravel-filemanager";
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('.lfm').filemanager('image', {
            prefix: '/laravel-filemanager'
        });
        $('.edit_lfm').filemanager('image', {
            prefix: '/laravel-filemanager'
        });
    </script>
    <textarea id="my-editor" name="content" class="form-control">{!! old('content', 'test editor content') !!}</textarea>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('mo_ta_chi_tiet', options);
        CKEDITOR.replace('mo_ta_chi_tiet_edit', options);
    </script>
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
            $("#ten_san_pham").keyup(function() {
                var tenSanPham = $("#ten_san_pham").val();
                var slugSanPham = toSlug(tenSanPham);
                $("#slug_san_pham").val(slugSanPham);
            });

            function loadTable() {
                $.ajax({
                    url: '/store/san-pham/dataSP',
                    type: 'get',
                    success: function(res) {
                        var html = '';

                        $.each(res.dataSP, function(key, value) {
                            if (value.is_open == true) {
                                var doan_muon_hien_thi =
                                    '<button class="btn btn-primary status" data-id="' +
                                    value.id + '">Hiển Thị</button>';
                            } else {
                                var doan_muon_hien_thi =
                                    '<button class="btn btn-danger status" data-id="' +
                                    value.id + '">Tạm Tắt</button>';
                            }

                            html += '<tr>';
                            html += '<th scope="row">' + (key + 1) + '</th>';
                            html += '<td>' + value.ten_san_pham + '</td>';
                            html += '<td>' + value.slug_san_pham + '</td>';
                            html += '<td>' + value.gia_ban + '</td>';
                            html += '<td>' + doan_muon_hien_thi + '</td>';
                            html += '<td>' + value.ten_danh_muc + '</td>';
                            html += '<td>';
                            html +=
                                '<button class="btn btn-danger delete mr-1" data-iddelete="' +
                                value.id +
                                '" data-toggle="modal" data-target="#exampleModal"> Xóa </button>';
                            html +=
                                '<button class="btn btn-success edit" data-idedit="' +
                                value.id +
                                '" data-toggle="modal" data-target="#inlineForm"> Chỉnh sửa </button>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $("#tableSanPham tbody").html(html);

                    },
                });
            }
            loadTable();
            $("#createSanPham").click(function(e) {
                e.preventDefault();
                var ten_san_pham = $("#ten_san_pham").val();
                var slug_san_pham = $("#slug_san_pham").val();
                var gia_ban = $("#gia_ban").val();
                var don_vi = $("#don_vi").val();
                var anh_dai_dien = $("#hinh_anh").val();
                var mo_ta_ngan = $("#mo_ta_ngan").val();
                var mo_ta_chi_tiet = CKEDITOR.instances['mo_ta_chi_tiet'].getData();
                var id_danh_muc = $("#id_danh_muc").val();
                var is_open = $("#is_open").val();

                var payload = {
                    'ten_san_pham': ten_san_pham,
                    'slug_san_pham': slug_san_pham,
                    'gia_ban': gia_ban,
                    'don_vi' : don_vi,
                    'anh_dai_dien': anh_dai_dien,
                    'mo_ta_ngan': mo_ta_ngan,
                    'mo_ta_dai': mo_ta_chi_tiet,
                    'id_danh_muc': id_danh_muc,
                    'is_open': is_open,
                };
                console.log(payload);
                $.ajax({
                    url: '/store/san-pham/index',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Thêm mới sản phẩm thành công!');
                            loadTable();
                            $('#formCreate').trigger("reset");
                            CKEDITOR.instances.mo_ta_chi_tiet.setData('');
                            $('#holder').attr('src', '');
                        } else {
                            toastr.error('Sản Phẩm Đã Tồn Tại');
                            $('#formCreate').trigger("reset");
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
            $('body').on('click', '.status', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/store/san-pham/status/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Đổi trạng thái thành công');
                            loadTable();
                        }
                    },
                });
            });
            $('body').on('click', '.delete', function() {
                var getId = $(this).data('iddelete');
                $("#idDeleteSP").val(getId);
            });
            $("#accpectDelete").click(function() {
                var id = $("#idDeleteSP").val();
                $.ajax({
                    url: '/store/san-pham/delete/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Đã xóa Sản Phẩm thành công!');
                            loadTable();
                        } else {
                            toastr.error('Sản Phẩm không tồn tại!');
                        }
                    },
                });
            });

            $("#ten_san_pham_edit").keyup(function() {
                var tenSanPham = $("#ten_san_pham_edit").val();
                var slugSanPham = toSlug(tenSanPham);
                $("#slug_san_pham_edit").val(slugSanPham);
            });

            $('body').on('click', '.edit', function() {
                var id = $(this).data('idedit');
                $.ajax({
                    url: '/store/san-pham/edit/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            $("#ten_san_pham_edit").val(res.data.ten_san_pham);
                            $("#slug_san_pham_edit").val(res.data.slug_san_pham);
                            $("#gia_ban_edit").val(res.data.gia_ban);
                            $("#don_vi_edit").val(res.data.don_vi);
                            $("#hinh_anh_edit").val(res.data.anh_dai_dien);
                            $("#holder_edit").attr("src", res.data.anh_dai_dien);
                            $("#mo_ta_ngan_edit").val(res.data.mo_ta_ngan);
                            // $("#mo_ta_chi_tiet_edit").val(res.data.mo_ta_dai);
                            CKEDITOR.instances['mo_ta_chi_tiet_edit'].setData(res.data
                                .mo_ta_dai);
                            $("#id_danh_muc_edit").val(res.data.id_danh_muc);
                            $("#is_open_edit").val(res.data.is_open);
                            // CKEDITOR.instances['mo_ta_chi_tiet_edit'].getData(res.data.mo_ta_dai);
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
                // var test = 123;
                var val_ten_san_pham = $("#ten_san_pham_edit").val();
                var val_slug_san_pham = $("#slug_san_pham_edit").val();
                var val_gia_ban = $("#gia_ban_edit").val();
                var val_don_vi  = $("#don_vi_edit").val();
                var val_hinh_anh = $("#hinh_anh_edit").val();
                var val_mo_ta_ngan = $("#mo_ta_ngan_edit").val();
                var val_mo_ta_chi_tiet = CKEDITOR.instances['mo_ta_chi_tiet_edit'].getData();
                var val_id_danh_muc = $("#id_danh_muc_edit").val();
                var val_is_open = $("#is_open_edit").val();
                var val_id = $("#id_edit").val();
                var payload = {
                    'ten_san_pham': val_ten_san_pham,
                    'slug_san_pham': val_slug_san_pham,
                    'gia_ban': val_gia_ban,
                    'don_vi' : val_don_vi,
                    'anh_dai_dien': val_hinh_anh,
                    'mo_ta_ngan': val_mo_ta_ngan,
                    'mo_ta_dai': val_mo_ta_chi_tiet,
                    'id_danh_muc': val_id_danh_muc,
                    'is_open': val_is_open,
                    'id': val_id,
                };


                // Gửi payload lên trên back-end bằng con đường ajax
                $.ajax({
                    url: '/store/san-pham/update',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Sản Phẩm đã được cập nhật!');
                            $('#closeModalUpdate').click();
                            loadTable();
                        } else {
                            toastr.error('Sản Phẩm đã tồn tại');
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
