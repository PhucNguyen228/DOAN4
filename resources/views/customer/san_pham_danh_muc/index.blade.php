@extends('master_homepage')\
@section('titel')
    <div style="text-align: center">
        <h4><b>Sản Phẩm</b></h4>
    </div>
@endsection
@section('content')
<div class="row">
    @foreach ($sanPham as $key_sp => $value_sp)
        <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
                <a data-id="{{ $value_sp->id }}" href="/chi-tiet/{{ $value_sp->id }}" class="img-prod"><img
                        class="img-fluid" src="{{ $value_sp->anh_dai_dien }}" alt="Colorlib Template">
                    <div class="overlay"></div>
                </a>
                <div class="text py-3 pb-4 px-3 text-center">
                    <h3><a href="#"></a>{{ $value_sp->ten_san_pham }}</h3>
                    <div class="d-flex">
                        <div class="pricing">
                            <p class="price">
                                @if ($value_sp->gia_khuyen_mai == 0)
                                    <span class="price-sale">{{ $value_sp->gia_ban }}</span>
                                @else
                                    <span class="mr-2 price-dc">{{ $value_sp->gia_ban }}</span>
                                    <span class="price-sale">{{ $value_sp->gia_khuyen_mai }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="bottom-area d-flex px-3">
                        <div class="m-auto d-flex">
                            <a href="#"
                                class="buy-now d-flex justify-content-center align-items-center mx-1">
                                <span><i class="ion-ios-cart"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
