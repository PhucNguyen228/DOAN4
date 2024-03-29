@extends('master_store')
@section('title')
    <div class="page-title-icon">
        <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
    </div>
    <div style="text-align: center; font-size: 25px">
        <b> Bảng Thống Kê </b>
    </div>
@endsection
@section('content')
    @if ($errors->any())
        <div class="card-header">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <form class="row ml-lg-1" method="POST" autocomplete="off">
        @csrf
        <div class="col-md-2">
            <span>Từ Năm: </span>
            <input type="text" class="form-control" name="datepicker" id="datepicker" />
            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
        </div>
    </form>

    <div class="col-md-12" style="display: none;">
        <div id="Chart" style="height: 250px;">
            {{-- {{ $get }} --}}
        </div>
    </div>

    {{-- show table --}}
    <div class="col-md-12 mt-5">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Bảng Thống Kê 1 Năm</h5>
                <div style="overflow-x: auto;">
                    <table class="mb-0 table table-bordered" id="tableDanhMuc">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>

                <h3 class="card-title">Tổng tiền: <b></b> </h3>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            // chart30days();
            var chart = new Morris.Bar({
                element: 'Chart',
                lineColors: ['#0b62a4', '#7A92A3', '#4da74d', '#afd8f8'],
                //data
                paseTime: false,
                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                paseTime: false,
                xkey: 'Thang_thu_nhap',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['Tong_tien'],
                behaveLinked: true,
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Tháng Thu Nhập', 'Tổng Tiền'],
            });

            $('#btn-dashboard-filter').click(function() {
                // alert('ok man');
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker').val();
                // alert(from_date);
                // alert(to_date);
                $.ajax({
                    url: "{{ route('admin.thong_ke.filter') }}",
                    method: "POST",
                    data: "JSON",
                    data: {
                        from_date: from_date,
                        _token: _token
                    },
                    success: function(data) {
                        $('#myAreaChart').html('');
                        $('#myAreaChart').html(data);
                        chart.setData(JSON.parse(data));
                        console.log(JSON.parse(data));
                        // xoá dữ liệu cũ của table
                        $("#tableDanhMuc thead tr").html('');
                        $("#tableDanhMuc tbody").html('');
                        $("h3 b").html('');

                        // thử in ra xem có đúng không
                        test = JSON.parse(data);
                        // console.log(test[0]['Thang_thu_nhap']);
                        var head_table = '';
                        var body_table = '';
                        var total_money = 0;
                        $.each(test, function(key, value) {
                            // console.log(key);
                            console.log(value);
                            head_table += '<th>' + value['Thang_thu_nhap'] + '</th>';
                            body_table += '<td>' + value['Tong_tien'].toLocaleString(
                                'it-IT', {
                                    style: 'currency',
                                    currency: 'VND'
                                }) + '</td>';
                            total_money += value['Tong_tien'];
                        });
                        $("#tableDanhMuc thead tr").html(head_table);
                        $("#tableDanhMuc tbody").html(body_table);
                        $("h3 b").html(total_money.toLocaleString('it-IT', {
                            style: 'currency',
                            currency: 'VND'
                        }));
                    }
                });
            });
            console.log(chart);

            $(function() {
                $("#datepicker").datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    autoclose: true //to close picker once year is selected
                });
            });
        });
    </script>
@endsection
