@extends('master_admin')
@section('title')
    <div style="text-align: center; color: red; font-size: 20px">
        <b>QUẢN LÝ YÊU CẦU DANH MỤC</b>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Table Yêu Cầu</h5>
                    <table class="mb-0 table table-bordered" style="text-align: center" id="tableYeuCau">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Danh Mục</th>
                                <th class="text-center">Option</th>
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
                <h5 class="modal-title">Xóa Yêu Cầu Danh Mục Sản Phẩm</h5>
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
                <button type="button" id="accpectDelete" class="btn btn-danger" data-dismiss="modal">Xóa Yêu
                    Cầu</button>
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
                    url: '/admin/yeu-cau-danh-muc/data',
                    type: 'get',
                    success: function(res) {
                        var html = '';

                        $.each(res.data, function(key, value) {
                            html += '<tr>';
                            html += '<th scope="row">' + (key + 1) + '</th>';
                            html += '<td>' + value.ten_danh_muc + '</td>';
                            html += '<td>';
                            html +=
                                '<button class="btn btn-primary submit mr-1" data-idsubmit="' +
                                value.id +
                                '" data-toggle="modal" data-target="#exampleModal"> Đồng ý </button>'
                            html += '</td>'
                            html += '<td>';
                            html +=
                                '<button class="btn btn-danger delete mr-1" data-iddelete="' +
                                value.id +
                                '" data-toggle="modal" data-target="#deleteModal"> Xóa </button>'
                            html += '</td>'
                            html += '</tr>';
                        });
                        $("#tableYeuCau tbody").html(html);
                    },
                });
            }
            loadTable();
            $('body').on('click', '.submit', function() {
                var id = $(this).data('idsubmit');
                $.ajax({
                    url: '/admin/yeu-cau-danh-muc/submit/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status == 1) {
                            toastr.success("Đã đồng ý thành công danh mục");
                            loadTable();
                        } else {
                            toastr.warning("Không tồn tại");
                        }
                    },
                });
            })
            $('body').on('click', '.delete', function() {
                var getId = $(this).data('iddelete');
                $("#idDeleteDanhMuc").val(getId);
            });

            $("#accpectDelete").click(function() {
                var id = $("#idDeleteDanhMuc").val();
                $.ajax({
                    url: '/admin/yeu-cau-danh-muc/delete/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Đã xóa yêu cầu danh mục thành công!');
                            loadTable();
                        } else {
                            toastr.error('Yêu cầu danh mục không tồn tại!');
                        }
                    },
                });
            });
        });
    </script>
@endsection
