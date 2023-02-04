@extends('master_homepage')
@section('titel')
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                            aria-labelledby="account-pill-general" aria-expanded="true">
                            <div class="media">
                                <a href="javascript: void(0);">
                                    <img src="/customer/images/category-2.jpg" class="rounded mr-75" alt="profile image"
                                        height="64" width="64">
                                </a>
                            </div>
                            <hr>
                            @if ($errors->any())
                                @foreach ($errors->all() as $key => $value)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $value }}
                                    </div>
                                @endforeach
                            @endif
                            <form autocomplete="off" method="post" action="/customer/thong-tin/update">
                                @csrf
                                <div class="row">
                                    <input type="text" name="id" value="{{ $dataTK->id }}" hidden>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-username">Tên Tài Khoản</label>
                                                <input type="text" class="form-control" name="ten_tai_khoan"
                                                    value="{{ $dataTK->ten_tai_khoan }}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">Email</label>
                                                <input type="text" class="form-control" name="email"
                                                    value="{{ $dataTK->email }}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-e-mail">Số Điện Thoại</label>
                                                <input type="text" class="form-control" name="sdt"
                                                    value="{{ $dataTK->sdt }}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="account-company">Địa Chỉ</label>
                                            <input value="{{ $dataTK->dia_chi }}" type="text" class="form-control"
                                               name="dia_chi">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Cập
                                            Nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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

        });
    </script>
@endsection
