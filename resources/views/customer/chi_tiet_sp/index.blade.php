@extends('master_homepage')
@section('titel')
    <div class="hero-wrap hero-bread"
        style="background-image: url('https://file.vfo.vn/hinh/2016/08/hinh-nen-dep-ve-rau-qua-6.jpg');">
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="customer/images/product-1.jpg" class="image-popup"><img src="{{ $data->anh_dai_dien }}"
                            class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <b>
                        <h3 style="">{{ $data->ten_san_pham }}</h3>
                    </b>
                    <button><a href="">Hài Lòng</a></button>

                    <button><a href="">Không Hài Lòng</a></button>
                    <h5>Tên cửa hàng:</h5>
                    <h4 style="color: red">{{ $data->ten_cua_hang }}</h4>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                        <p style="color: #000;">2000 <span style="color: #bbb;">Hài lòng</span></p>
                        </p>
                        <p class="text-left ml-4">
                        <p href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Không Hài
                                Lòng</span></p>
                        </p>
                    </div>
                    <div class="d-flex">
                        <div class="pricing">
                            <p class="price">
                                @if ($data->gia_khuyen_mai == 0)
                                <div style="font-size: 30px">
                                    <span class="price-sale">Gía Hiện Tại : <b>{{ $data->gia_ban }}đ/{{$data->don_vi}}</b></span>
                                </div>
                                @else
                                    <div style="font-size: 20px">
                                        <span class="price-dc">Gía gốc : <b>{{ $data->gia_ban }}đ/{{$data->don_vi}}</b></span>
                                    </div>
                                    <div style="font-size: 30px">
                                    <span class="price-sale">Gía KM : <b>{{ $data->gia_khuyen_mai }}đ/{{$data->don_vi}}</b></span>

                                    </div>
                                @endif
                            </p>
                        </div>
                    </div>
                    <p>{{$data->mo_ta_ngan}}
                    </p>
                    {{-- <div class="row mt-4">
                        <h4>SỐ LƯỢNG</h4>
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">

                            <input type="text" id="quantity" name="quantity" class="form-control input-number"
                                value="1" min="1" max="100">

                        </div>
                        <div class="w-100"></div>

                    </div> --}}
                    <p><a data-id="{{ $data->id }}" class="btn btn-black py-3 px-5 addToCart">Add to Cart</a></p>
                </div>
            </div>
        </div>
        <div class="mota ml-4">
            <b>Mô tả chi tiết sản phẩm</b>
            {!! $data->mo_ta_dai !!}
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Products</span>
                    <h2 class="mb-4">Related Products</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($dataSP as $value)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="/chi-tiet/{{$value->id}}" class="img-prod"><img class="img-fluid" src="{{ $value->anh_dai_dien }}"
                                alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="/chi-tiet/{{$value->id}}">{{$value->ten_san_pham}}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price">
                                        @if ($value->gia_khuyen_mai == 0)
                                            <span class="price-sale">{{ $value->gia_ban }}</span>
                                        @else
                                            <span class="mr-2 price-dc">{{ $value->gia_ban }}</span>
                                            <span class="price-sale">{{ $value->gia_khuyen_mai }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">

                                    <a data-id="{{ $value->id }}" href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
