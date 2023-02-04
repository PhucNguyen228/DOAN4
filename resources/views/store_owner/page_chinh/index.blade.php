@extends('master_store')

@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div>
        Nộp Thuế
        <div class="page-title-subheading">
            Nôp thuế theo phương thức
        </div>
    @endsection
    @section('content')
        <h1>Mức thuế hiện tại {{ $price }} / 6 Tháng</h1>
        {{-- <h1>{{ $muc_thue }}</h1> --}}
        <h3>hạn sử dụng của bạn sẽ đến {{ $han_can_thanh_toan->format('d/m/Y') }}</h3>
        <form action="{{ url('/store/vnpay_payment') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $muc_thue }}">
            <button type="submit" class="btn btn-warning" name="redirect">Thanh toán VNPAY</button>
        </form>
        <form autocomplete="off">
            <input type="hidden" name="total" id="thue" value="{{ $muc_thue }}">
            <button type="submit" class="btn btn-warning mt-2" id="create_Thue">Thanh toán</button>
        </form>
    @endsection

    @section('js')
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#create_Thue').click(function(e) {
                    e.preventDefault();
                    var thue = $('#thue').val();
                    payload = {
                        thue: thue,
                    }

                    $.ajax({
                        url: "{{ route('nop_tien') }}",
                        type: "POST",
                        data: payload,
                        success: function(response) {
                            if (response.trangThai) {
                                toastr.success('Nộp tiền thành công');
                            } else {
                                toastr.error('Nộp tiền thất bại');
                            }
                        },
                    });
                });
            });
        </script>
    @endsection
