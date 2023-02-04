@extends('master_homepage')
@section('titel')
    <div class="hero-wrap hero-bread"
        style="background-image: url('https://file.vfo.vn/hinh/2016/08/hinh-nen-dep-ve-rau-qua-6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Cart</span>
                    </p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table" id="tableSanPham">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr class="text-center">
                                    <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a>
                                    </td>

                                    <td class="image-prod">
                                        <div class="img"
                                            style="background-image:url(http://127.0.0.1:8000/storage/photos/ca_rot.jpg);">
                                        </div>
                                    </td>

                                    <td class="product-name">
                                        <h3>CA ROT</h3>
                                    </td>

                                    <td class="price">21000</td>

                                    <td class="quantity">
                                        <div class="input-group mb-3">
                                            <input type="text" name="quantity" class="quantity form-control input-number"
                                                value="1" min="1" max="100">
                                        </div>
                                    </td>

                                    <td class="total">21000</td>
                                </tr><!-- END TR--> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">

                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Thông tin và địa chỉ giao hàng</h3>
                        <p>Nhập thông tin</p>
                        <form action="#" class="info">
                            <div class="form-group">
                                <label for="">Họ tên </label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Số điện thoại</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Địa chỉ nhận hàng</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                        </form>
                    </div>
                    {{-- <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p> --}}
                </div>
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Gía tiền</span>
                            <span id="giatien"></span>
                        </p>
                        <p class="d-flex">
                            <span>Gía giảm</span>
                            <span id="giagiam"></span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span id="TienTra"></span>
                        </p>
                    </div>
                    <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Đặt hàng</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Xóa </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Bạn có chắc chắn muốn xóa? Điều này không thể hoàn tác.
            <input type="text" class="form-control" placeholder="Nhập vào id cần xóa" id="idDelete" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="accpectDelete" class="btn btn-danger" data-dismiss="modal">Xóa </button>
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
                    url: '/customer/cart/data',
                    type: 'get',
                    success: function(res) {
                        var content_table = '';
                        var giatien = 0;
                        var giagiam = 0;
                        var tientra = 0;
                        $.each(res.data, function(key, value) {
                            content_table += '<tr class="text-center">';
                            content_table +=
                                '<td class="image-prod"><div class="img"style="background-image:url(' +
                                value.anh_dai_dien + ');"></div></td>';
                            content_table += '<td class="product-name"><h3>' + value
                                .ten_san_pham + '</h3></td>';
                            content_table += '<td class="price">' + value.gia_ban + '</td>';
                            content_table +=
                                ' <td ><div class="input-group mb-3"><input type="text" class="quantity form-control input-number" value="' +
                                value.so_luong + '" data-id=' + value.id +
                                '></div></td>';
                            content_table += '<td class="total">' + formatNumber(value
                                .so_luong * value.gia_ban) + '</td>';
                            content_table += '<td class="text-center">';
                            content_table +=
                                '<button class="btn btn-danger delete mr-1" data-iddelete="' +
                                value.id +
                                '" data-toggle="modal" data-target="#deleteModal">Delete</button>';
                            content_table += '</td>';
                            content_table += '</tr>';
                            giatien = giatien + value.gia_ban * value.so_luong;
                            tientra = tientra + value.so_luong * value.don_gia;
                            giagiam = giatien - tientra;
                        });
                        $("#tableSanPham tbody").html(content_table);
                        $("#giatien").text(formatNumber(giatien));
                        $("#giagiam").text(formatNumber(giagiam));
                        $("#TienTra").text(formatNumber(tientra));
                    },

                });
            }
            loadTable();

            function formatNumber(number) {
                return new Intl.NumberFormat('vi-VI', {
                    style: 'currency',
                    currency: 'VND'
                }).format(number);
            }
            $("body").on('change', '.quantity', function() {

                var payload = {
                    'id': $(this).data('id'),
                    'so_luong': $(this).val(),
                };

                $.ajax({
                    url: '/customer/cart/updateqty',
                    type: 'post',
                    data: payload,
                    success: function(res) {
                        if (res.status) {
                            toastr.success("Đã cập nhật số lượng sản phẩm!");
                            loadTable();
                        } else {
                            toastr.error(' số lượng nhỏ hơn 0');
                            loadTable();
                        }
                    },
                    error: function(res) {
                        var listError = res.responseJSON.errors;
                        $.each(listError, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                });
            });
            $('body').on('click', '.delete', function() {
                var getId = $(this).data('iddelete');
                $("#idDelete").val(getId);
            });
            $("#accpectDelete").click(function() {
                // var a = [
                //     'id'   : $("#idDelete").val(),
                // ]
                var id = $("#idDelete").val();
                $.ajax({
                    url: '/customer/cart/remove/' + id,
                    type: 'get',
                    success: function(res) {
                        if (res.status) {
                            toastr.success('Đã xóa  thành công!');
                            loadTable();
                        } else {
                            toastr.error('không tồn tại!');
                        }
                    },
                });
            });
        });
    </script>
@endsection
