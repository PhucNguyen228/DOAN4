@extends('master_store')
@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div style="text-align: center; color: red; font-size: 20px">
        <b>Quản lý thông tin</b>
        {{-- <div class="page-title-subheading">
        <b>Thêm Mới Sản Phẩm và Quản Lý Sản Phẩm</b>
    </div> --}}
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $key => $value)
                    <div class="alert alert-danger" role="alert">
                        {{ $value }}
                    </div>
                @endforeach
            @endif
            {{-- @csrf --}}
            <form autocomplete="off" method="post" action="/store/thong-tin/update">
                @csrf
                <div class="col-md-12">

                    <div class="form-group">
                        <input type="text" name="id" value="{{ $dataTKStore->id }}" hidden>
                        <div class="controls">
                            <label for="account-old-password">Tên cửa hàng</label>
                            <input value="{{ $dataTKStore->ten_cua_hang }}" name="ten_cua_hang" type="text"
                                class="form-control" id="ten_cua_hang">
                            <div class="help-block"></div>
                        </div>
                        <div class="controls">
                            <label for="account-old-password">Tên Tài Khoản</label>
                            <input value="{{ $dataTKStore->ten_tai_khoan }}" name="ten_tai_khoan" type="text"
                                class="form-control" id="ten_tai_khoan">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <div class="controls">
                            <label for="account-new-password">Email</label>
                            <input value="{{ $dataTKStore->email }}" name="email" type="text" id="email"
                                class="form-control" placeholder="Email">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <div class="controls">
                            <label for="account-retype-new-password">Số điện thoại</label>
                            <input value="{{ $dataTKStore->sdt }}" name="sdt" type="text" class="form-control"
                                id="so_dien_thoai" placeholder="số điện thoại">
                            {{-- data-validation-required-message="The Confirm password field is required" minlength="6" --}}
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <div class="controls">
                            <label for="account-new-password">Địa chị</label>
                            <input value="{{ $dataTKStore->dia_chi }}" name="dia_chi" type="text" id="dia_chi"
                                class="form-control" placeholder="Địa chỉ">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Cập Nhật</button>
                </div>
            </form>
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

        });
    </script>
@endsection
