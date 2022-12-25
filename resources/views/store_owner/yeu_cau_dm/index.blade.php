@extends('master_store')
@section('title')
    <div style="text-align: center; font-size: 25px; color: red" class="page-title-subheading">
        <b>Thêm Mới yêu cầu Danh Sách danh mục và Quản Lý Yêu Cầu Các Danh Mục</b>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Thêm Mới Danh Mục</h5>
                    <form autocomplete="off" id="createDanhMuc">
                        <div class="position-relative form-group">
                            <label>Tên Danh Mục</label>
                            <input id="ten_danh_muc_yc" name="ten_danh_muc" placeholder="Nhập vào tên danh mục" type="text"
                                class="form-control">
                        </div>
                        <div class="position-relative form-group">
                            <label>Slug Danh Mục</label>
                            <input id="slug_danh_muc_yc" name="slug_danh_muc" placeholder="Nhập vào slug danh mục"
                                type="text" class="form-control">
                        </div>
                        <button class="mt-1 btn btn-primary" id="createDM">Yêu Cầu Danh Mục</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Table Danh Mục</h5>
                    <table class="mb-0 table table-bordered" style="text-align: center" id="tableDanhMuc">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Danh Mục</th>
                                <th class="text-center">Tình Trạng</th>
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
            $("#ten_danh_muc_yc").keyup(function() {
                var tenDanhMuc = $("#ten_danh_muc_yc").val();
                var slugDanhMuc = toSlug(tenDanhMuc);
                $("#slug_danh_muc_yc").val(slugDanhMuc);
            });
            function loadTable(){
                $.ajax({
                        url: '/store/yeu-cau/data',
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
                                if (value.yeu_cau == 0) {
                                    // var class_button = 'btn-warning';
                                    var text_button = 'đang chờ...';
                                }
                                content_table += '<tr>';
                                content_table += '<th class="text-center" scope="row">' + (key +
                                    1) + '</th>';
                                content_table += '<td> ' + value.ten_danh_muc + ' </td>';
                                content_table += '<td >';
                                content_table += '<div style ="height:30px; background: yellow">';
                                content_table += text_button;
                                content_table += '</div></td>';
                                content_table += '</tr>';
                            });
                            $("#tableDanhMuc tbody").html(content_table);
                        },
                    });
            }
            loadTable();
            $("#createDM").click(function(e) {
                e.preventDefault();
                var val_ten_danh_muc = $("#ten_danh_muc_yc").val();
                var val_slug_danh_muc = $("#slug_danh_muc_yc").val();

                var payload = {
                    'ten_danh_muc': val_ten_danh_muc,
                    'slug_danh_muc': val_slug_danh_muc,
                };

                $.ajax({
                    url: '/store/yeu-cau/index',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        toastr.success("Đã yêu cầu danh mục thành công!");
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
        });
    </script>
@endsection
