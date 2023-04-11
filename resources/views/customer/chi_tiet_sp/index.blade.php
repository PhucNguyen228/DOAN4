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
                    <button data-id="1" id="hailong" class="btn-hai-long">Hài Lòng</button>

                    <button data-id="0" id="k_hailong" class="btn-khong-hai-long">Không Hài Lòng</button>
                    <h5>Tên cửa hàng:</h5>
                    <h4 style="color: red">Bà tư rau sạch</h4>
                    <form method="POST" autocomplete="off">
                        <div class="rating d-flex">
                            @csrf
                            <input type="hidden" id="id_user" data-id="{{ $user->id }}" />
                            <input type="hidden" id="id_san_pham" data-id="{{ $data->id }}">
                            <p class="text-left mr-4">
                            <p style="color: #000;">{{ $danh_gia_hai_long }} <span style="color: #bbb;">Hài lòng</span></p>
                            </p>
                            <p class="text-left ml-4">
                            <p href="#" class="mr-2" style="color: #000;">{{ $danh_gia_khong_hai_long }} <span
                                    style="color: #bbb;">Không Hài
                                    Lòng</span></p>
                            </p>
                        </div>
                    </form>
                    <div class="d-flex">
                        <div class="pricing">
                            <p class="price">
                                @if ($data->gia_khuyen_mai == 0)
                                    <div style="font-size: 25px">
                                        <span class="price-sale">Giá Hiện Tại :
                                            <b>{{ $data->gia_ban }}đ/{{ $data->don_vi }}</b></span>
                                    </div>
                                @else
                                    <div style="font-size: 25px">
                                        <span class="price-dc">Giá gốc :
                                            <b>{{ number_format($data->gia_ban, 0, '', ',') }}đ/{{ $data->don_vi }}</b></span>
                                    </div>
                                    <div style="font-size: 15px">
                                        <span class="price-sale">Giá KM :
                                            <b>{{ number_format($data->gia_khuyen_mai, 0, '', ',') }}đ/{{ $data->don_vi }}</b></span>

                                    </div>
                                @endif
                            </p>
                        </div>
                    </div>
                    {{ $data->mo_ta_ngan }}

                    <p><a data-id="{{ $data->id }}" class="btn btn-black py-3 px-5 addToCart">Add to Cart</a></p>
                </div>
            </div>
        </div>
        <div class="mota ml-4">
            <b>Mô tả chi tiết sản phẩm</b>
            {{-- <p>{{ html_entity_decode($data -> mo_ta_dai) }}</p> --}}
            {!! $data->mo_ta_dai !!}
        </div>

        {{-- form đánh giá sản phẩm --}}
        <div class="mota ml-4">
            <b class="">ĐÁNH GIÁ SẢN PHẨM</b>

            <div class="overflow-auto" style="height: 450px; width: 90%">
                @foreach ($data_danhGia_binhLuan_user as $data_binh_luan)
                    <div style="border: 1px solid #ddd; border-radius: 10px; background: #F0F0E9; width: 90%"
                        class="mt-2">
                        @if ($data_binh_luan->noi_dung != null)
                            <ul class="row">
                                <li style="list-style: none"><a href="">{{ $data_binh_luan->ten_tai_khoan }}</a>
                                </li>
                                <li style="list-style: none" class="ml-2"><a
                                        href="">{{ $data_binh_luan->updated_at }}</a>
                                </li>
                            </ul>
                            <p class="ml-4">{{ $data_binh_luan->noi_dung }}</p>
                            @if ($data_binh_luan->id_khach_hang === $user->id)
                                {{-- button delete --}}
                                <button id="delete" data-id="{{ $data_binh_luan->id }}"
                                    class="ml-4 btn btn-danger btn-sm btn-xoa-binh-luan">Xóa bình luận</button>
                            @endif
                        @endif
                    </div>
                @endforeach

                <div style="border: 1px solid #ddd; border-radius: 10px; background: #F0F0E9; width: 90%" class="mt-2">
                    <ul class="row">
                        <li style="list-style: none"><a href="">Admin</a></li>
                        <li style="list-style: none" class="ml-2"><a href="">12:00 PM</a></li>
                        <li style="list-style: none" class="ml-2"><a href="">14 03 2023</a></li>
                    </ul>
                    <p class="ml-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos porro, aliquam, dolores
                        veniam unde amet,
                        id quam illum deserunt debitis sed nam eveniet non. Explicabo omnis maxime minima architecto
                        necessitatibus.Tempora molestiae deserunt odio, provident placeat minus quisquam qui quos quae
                        nesciunt
                        perferendis porro dolorum pariatur consectetur fugiat blanditiis minima veniam. Nesciunt sunt nobis
                        ratione facere delectus et id consectetur?</p>
                </div>

                <div style="border: 1px solid #ddd; border-radius: 10px; background: #F0F0E9; width: 90%" class="mt-2">
                    <ul class="row">
                        <li style="list-style: none"><a href="">Admin</a></li>
                        <li style="list-style: none" class="ml-2"><a href="">12:00 PM</a></li>
                        <li style="list-style: none" class="ml-2"><a href="">14 03 2023</a></li>
                    </ul>
                    <p class="ml-1">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos porro, aliquam, dolores
                        veniam unde amet,
                        id quam illum deserunt debitis sed nam eveniet non. Explicabo omnis maxime minima architecto
                        necessitatibus.Tempora molestiae deserunt odio, provident placeat minus quisquam qui quos quae
                        nesciunt
                        perferendis porro dolorum pariatur consectetur fugiat blanditiis minima veniam. Nesciunt sunt nobis
                        ratione facere delectus et id consectetur?</p>
                </div>
            </div>

            <div class="mt-2">
                <b>Viết đánh giá</b>
                <form class="mt-2" method="GET" autocomplete="off">
                    @csrf
                    <input type="hidden" id="id_user" data-id="{{ $user->id }}" />
                    <input type="hidden" id="id_san_pham" data-id="{{ $data->id }}">
                    <textarea style="resize: none; background-color: #F0F0E9" cols="100" rows="5" name="noi_dung"
                        id="noi-dung"></textarea>
                    <br>
                    <button class="btn btn-primary mt-2 btn-noi-dung">Gửi</button>
                </form>
            </div>
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
                            <a href="/chi-tiet/{{ $value->id }}" class="img-prod"><img class="img-fluid"
                                    src="{{ $value->anh_dai_dien }}" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="/chi-tiet/{{ $value->id }}">{{ $value->ten_san_pham }}</a></h3>
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

                                        <a data-id="{{ $value->id }}" href="#"
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
        </div>
    </section>

    <script>
        // bắt sự kiện của nút hài lòng và không hài lòng và gửi dữ liệu lên database
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id_user = $('#id_user').data('id');
            var id_san_pham = $('#id_san_pham').data('id');
            $('.btn-hai-long').click(function() {
                var id_danh_gia = $(this).data('id');
                console.log(id_danh_gia, id_user, id_san_pham);
                $.ajax({
                    url: "{{ route('tao_danh_gia') }}",
                    type: 'POST',
                    data: {
                        id_sp: id_san_pham,
                        muc_do_hai_long: id_danh_gia,
                        id_khach_hang: id_user,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
            $('.btn-khong-hai-long').click(function() {
                var id_danh_gia = $(this).data('id');
                console.log(id_danh_gia, id_user, id_san_pham);
                $.ajax({
                    url: "{{ route('tao_danh_gia') }}",
                    type: 'POST',
                    data: {
                        id_sp: id_san_pham,
                        muc_do_hai_long: id_danh_gia,
                        id_khach_hang: id_user,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
            $('.btn-noi-dung').click(function() {
                var noi_dung = $('#noi-dung').val();
                console.log(noi_dung);
                $.ajax({
                    url: "{{ route('tao_binh_luan') }}",
                    type: 'POST',
                    data: {
                        id_sp: id_san_pham,
                        noi_dung: noi_dung,
                        id_khach_hang: id_user,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        console.log(data);
                        // if (res.status) {
                        //     toasr.success('Xóa bình luận thành công');
                        // }
                    }
                });
            });
            // delete comment get id then route to controller and delete
            $('.btn-xoa-binh-luan').click(function() {
                var id_binh_luan = $(this).data('id');
                var id_san_pham = $('#id_san_pham').data('id');
                console.log(id_binh_luan);
                // ajax delete
                $.ajax({
                    url: '{{ route('xoa_binh_luan') }}',
                    type: 'GET',
                    data: {
                        id: id_binh_luan,
                        // _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        // console.log();
                        if (res.status) {
                            toastr.success('Xóa bình luận thành công');
                            setTimeout(function(res) {
                                window.top.location = "/chi-tiet/" + id_san_pham;
                            }, 1000)
                        }
                    }
                });
            });
        });
    </script>
@endsection
