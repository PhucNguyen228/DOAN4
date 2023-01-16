@extends('master_homepage')
@section('titel')
<div class="hero-wrap hero-bread" style="background-image: url('https://file.vfo.vn/hinh/2016/08/hinh-nen-dep-ve-rau-qua-6.jpg');">
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
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span
                                            class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img"
                                        style="background-image:url(http://127.0.0.1:8000/storage/photos/ca_rot.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>CA ROT</h3>
                                </td>

                                <td class="price">21000</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity"
                                            class="quantity form-control input-number" value="1"
                                            min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">21000</td>
                            </tr><!-- END TR-->

                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span
                                            class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img"
                                        style="background-image:url(http://127.0.0.1:8000/storage/photos/20210106_041321_793265_hat-giong-rau-xa-la.max-1800x1800.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>RAU XÀ LÁCH</h3>
                                    {{-- <p>Far far away, behind the word mountains, far from the countries</p> --}}
                                </td>

                                <td class="price">20000</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity"
                                            class="quantity form-control input-number" value="1"
                                            min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">20000</td>
                            </tr><!-- END TR-->
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
                        <span>50000</span>
                    </p>
                    <p class="d-flex">
                        <span>Gía giảm</span>
                        <span>41000</span>
                    </p>
                    <p class="d-flex">
                        <span>Vận chuyển</span>
                        <span>15000</span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span>56000</span>
                    </p>
                </div>
                <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Đặt hàng</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
