@extends('app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <br>
            <div class="card">
                <span class="border border-danger">
                    <div class="card-header">
                        Thêm sản phẩm vào
                        <strong style="color: rgb(229, 18, 134)">Phiếu nhập hàng</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ url('/phieu-nhap-hang/' . $ip->ip_id . '/create') }}" method="post"
                            class="form-horizontal">
                            @csrf
                            {{-- @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif --}}
                            <input type="hidden" name="ip_id" value="{{ $ip->ip_id }}">
                            <div class="row">

                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Sản phẩm</label>
                                        <select name="prd_id" id="prd_id" class="form-control"
                                            {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                            <option value="0">Chọn sản phẩm</option>
                                            @foreach ($prd as $item)
                                                <option value="{{ $item->prd_id }}">{{ $item->prd_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger small">
                                            @error('prd_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Đơn vị tính</label>
                                        <div class=" form-control-label">
                                            <select name="dt_unit" id="prd_unit" class="form-control"
                                                {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                                <option value="0">Chọn đơn vị tính</option>
                                                <option value="Kg">Kg</option>
                                                <option value="Bộ">Bộ</option>
                                                <option value="Lốc">Lốc</option>
                                                <option value="Lon">Lon</option>
                                                <option value="Cái">Cái</option>
                                                <option value="Gói">Gói</option>
                                                <option value="Hộp">Hộp</option>
                                                <option value="Chai">Chai</option>
                                                <option value="Bịch">Bịch</option>
                                                <option value="Thùng">Thùng</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="text-danger small">
                                        @error('dt_unit')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="x_card_code" class="control-label mb-1">Đơn giá nhập</label>
                                    <div class="input-group">
                                        <input id="prd_inputprice" name="dt_inputprice" type="text"
                                            class="form-control cc-cvc prd_inputprice" value=""
                                            {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                    </div>
                                    <span class="text-danger small">
                                        @error('dt_inputprice')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <input type="hidden" id="ip_vat" value="{{ $ip->ip_vat }}">
                                <div class="col-4">
                                    <label for="x_card_code" class="control-label mb-1">Đơn giá VAT</label>
                                    <div class="input-group">
                                        <input name="dt_vat" type="tel" class="form-control cc-cvc" value=""
                                            id="dt_vat" data-val-required="Please enter the security code" readonly
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                    </div>
                                    <span class="text-danger small">
                                        @error('dt_vat')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-4">
                                    <label for="x_card_code" class="control-label mb-1">Đơn giá bán</label>
                                    <div class="input-group">
                                        <input id="prd_saleprice" name="dt_saleprice" type="text"
                                            class="form-control cc-cvc" value=""
                                            {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>

                                    </div><span class="text-danger small">
                                        @error('dt_saleprice')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="x_card_code" class="control-label mb-1">Số lượng</label>
                                    <div class="input-group">
                                        <input id="x_card_code " name="dt_quantity" type="text"
                                            class="form-control cc-cvc" value="" data-val="true"
                                            data-val-required="Please enter the security code"
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off"
                                            {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                    </div>
                                    <span class="text-danger small">
                                        @error('dt_quatity')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-4">
                                    <label for="x_card_code" class="control-label mb-1">Số lô</label>
                                    <div class="input-group">
                                        <input id="x_card_code " name="dt_lotnumber" type="text"
                                            class="form-control cc-cvc" value="" data-val="true"
                                            data-val-required="Please enter the security code"
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off"
                                            {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                    </div>
                                    <span class="text-danger small">
                                        @error('dt_lotnumber')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-4">
                                    <label for="x_card_code" class="control-label mb-1">Hạn dùng</label>
                                    <div class="input-group">
                                        <input id="dt_expried" name="dt_expried" type="date"
                                            class="form-control cc-cvc" value="" data-val="true"
                                            data-val-required="Please enter the security code"
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off"
                                            {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>

                                    </div>
                                    <span class="text-danger small">
                                        @error('dt_expried')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="col-4">
                                <label for="x_card_code" class="control-label mb-1" type="hidden"></label>
                                @if ($ip->ImportStatus == 0)
                                    <div class="input-group">
                                        <button type="submit " class="btn btn-success btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Thêm sản phẩm
                                        </button>
                                    </div>
                                @endif

                            </div>
                        </form>
                    </div>
                </span>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="card">
                <span class="border border-success">
                    <div class="card-header">Thông tin nhập hàng</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2" style="color: rgb(206, 15, 34)">Cập nhật phiếu nhập hàng</h3>
                        </div>
                        <hr>
                        <form action="{{ url('/phieu-nhap-hang/' . $ip->ip_id) }}" method="POST"
                            novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="ip_id" value="{{ $ip->ip_id }}">
                            {{-- @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif --}}

                            <div class="row">
                                <div class="col-8">
                                    <label for="cc-number" class="control-label mb-1">Nhà cung cấp</label>
                                    <select name="sp_id" class="form-control"
                                        {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                        <option value="0">Chọn nhà cung cấp</option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->sp_id }}"
                                                {{ $item->sp_id == $ip->sp_id ? 'selected' : '' }}>
                                                {{ $item->sp_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="cc-number" class="control-label mb-1">Thanh toán</label>
                                    <select name="ip_status" class="form-control" id="select" readonly>
                                        <option value="{{ $ip->ip_status }}">
                                            {{ $ip->ip_status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</option>
                                        <option value="0">Chưa thanh toán</option>
                                        <option value="1">Đã thanh toán</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="cc-payment" class="control-label mb-1">Số hóa đơn </label>
                                    <input id="cc-pament " name="ip_bill" type="text" class="form-control"
                                        aria-required="true" aria-invalid="false" value="{{ $ip->ip_bill }}"
                                        {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                    <span class="text-danger small">
                                        @error('ip_bill')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label for="cc-payment" class="control-label mb-1">VAT </label>
                                    <input name="ip_vat" type="text" class="form-control" aria-required="true"
                                        aria-invalid="false" value="{{ $ip->ip_vat }}"
                                        {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                    <span class="text-danger small">
                                        @error('ip_vat')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Ngày nhập: </label>
                                    <div class="input-group">
                                        <input id="x_card_code " name="ip_dateinput" type="date"
                                            class="form-control cc-cvc" value="{{ $ip->ip_dateinput }}" data-val="true"
                                            data-val-required="Please enter the security code"
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off"
                                            {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                    </div>
                                    <span class="text-danger small">
                                        @error('ip_dateinput')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Ngày tạo: </label>
                                    <div class="input-group">
                                        <input id="x_card_code " name="ip_datecreate" type="date"
                                            class="form-control cc-cvc" value="{{ $ip->ip_datecreate }}" data-val="true"
                                            data-val-required="Please enter the security code"
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off"
                                            {{ $ip->ImportStatus == 1 ? 'readonly' : '' }}>
                                    </div>
                                    <span class="text-danger small">
                                        @error('ip_datecreate')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-footer">
                                    @if ($ip->ImportStatus == 0)
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> Cập nhật
                                        </button>
                                    @endif

                                    <a href="{{ url('/phieu-nhap-hang') }}" type="reset"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-reply"></i> Trở lại
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </span>
            </div>
        </div>

    </div>
    <h4 style="color:red">Thông tin sản phẩm nhập hàng</h4>

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th style="width: 120px">Số lượng</th>
                            <th style="width:80px;">Đơn vị tính</th>
                            <th style="width:100px;">Số lô</th>
                            <th>Hạn dùng</th>
                            <th>Đơn giá nhập</th>
                            <th>Đơn giá VAT</th>
                            <th>Đơn giá bán</th>
                            <th>Thành tiền</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($inputdetail) && $inputdetail->count())
                            @foreach ($inputdetail as $dt)
                                <tr>
                                    <td>{{ $dt->prd_name }}</td>
                                    <td>{{ $dt->dt_quantity }}</td>
                                    <td>{{ $dt->dt_unit }}</td>
                                    <td>{{ $dt->dt_lotnumber }}</td>
                                    <td>{{ $dt->dt_expried }}</td>
                                    <td>{{ number_format($dt->dt_inputprice) . ' VND' }}</td>
                                    <td>{{ number_format($dt->dt_vat) . ' VND' }}</td>
                                    <td>{{ number_format($dt->dt_saleprice) . ' VND' }}</td>
                                    <td>{{ number_format($dt->dt_totalprice) . ' VND' }}</td>

                                    <td>
                                        @if ($ip->ImportStatus == 0)
                                            <form
                                                action="{{ url('/phieu-nhap-hang/' . $ip->ip_id . '/' . $dt->dt_id . '/delete') }}"
                                                method="POST">
                                                <div class="table-data-feature">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Xóa"
                                                        onclick="return confirm(&quot;Bạn thật sự muốn xóa phiếu này?&quot;)">
                                                        <i type="submit" class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">Không có dữ liệu.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="table-data__tool">
        <div class="table-data__tool-left"></div>
        <div class="table-data__tool-right button-container">

            @if ($ip->ip_status == 0 && $ip->ImportStatus == 1)
                <form id="delete-form" action="{{ url('/phieu-nhap-hang/' . $ip->ip_id . '/status') }}" method="POST">
                    @csrf
                    <button id="delete-form" class="btn btn-success" style="margin-right: 20px;" type="submit"
                        onclick="return confirm(&quot;xác nhận thanh toán ?&quot;)">Thanh toán</button>
                </form>
            @endif
            @if ($ip->ip_status == 1 && $ip->ImportStatus == 1)
                <form id="delete-form" action="{{ url('/phieu-nhap-hang/' . $ip->ip_id . '/status') }}" method="POST">
                    @csrf
                    <button id="delete-form" class="btn btn-danger" style="margin-right: 20px;" type="submit"
                        onclick="return confirm(&quot;xác nhận hủy thanh toán ?&quot;)">Hủy thanh toán</button>
                </form>
            @endif

            @if ($ip->ImportStatus == 1)
                <form id="delete-form" action="{{ url('/phieu-nhap-hang/' . $ip->ip_id . '/delete') }}" method="POST">
                    @csrf
                    <button id="delete-form" class="btn btn-danger" style="margin-right: 20px;" type="submit"
                        onclick="return confirm(&quot;Bạn thật sự muốn hủy phiếu này?&quot;)">Hủy nhập
                        kho</button>
                </form>
            @else
                <form id="add-form" action="{{ url('/phieu-nhap-hang/' . $ip->ip_id . '/add') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id_ctpn" name="dt_id[]" value="">
                    <input type="hidden" id="iv_begin" name="" value="">
                    <input type="hidden" name="iv_export" id="iv_export" value="12">
                    <input type="hidden" id="iv_saleprice" name="iv_saleprice" value="">
                    <input type="hidden" name="prd_id" id="prd_id" value="">
                    <input type="hidden" name="iv_final" id="iv_final" value="">
                    <button id="add-form" class="btn btn-warning" type="submit"
                        onclick="return confirm(&quot;Bạn thật sự muốn thêm phiếu này?&quot;)">Thêm vào
                        kho hàng</button>
                </form>
            @endif

        </div>
    </div>
@section('script')
    <script>
        // load auto date

        //show data
        $(document).on('change', '#prd_id', function() {
            var prd_id = $(this).val();

            var a = $(this).parent();
            console.log(prd_id);
            var op = "";

            $.ajax({
                type: 'get',
                url: '{!! URL::to('finddata') !!}',
                data: {
                    'prd_id': prd_id
                },
                dataType: 'json',
                success: function(data) {
                    // console.log("#prd_inputprice");

                    $("#prd_inputprice").val(data.prd_inputprice);
                    var x = Number($("#prd_inputprice").val());
                    var y = Number($("#ip_vat").val());
                    var vat = x + (x * (y / 100));
                    $("#dt_vat").val(vat);
                    $("#prd_saleprice").val(data.prd_saleprice);
                    $("#prd_unit").val(data.prd_unit);

                    var date = new Date();
                    var month = date.getMonth() + 1;
                    var day = date.getDate();
                    var output = (date.getFullYear() + 2) + '-' +
                        (month < 10 ? '0' : '') + month + '-' +
                        (day < 10 ? '0' : '') + day;
                    // console.log(output);
                    $("#dt_expried").val(output);

                },
                error: function() {

                }
            })
        });

        $(document).on('change', function() {
            $("#prd_inputprice").keyup(function() {

                var vat = 0;
                var x = Number($("#prd_inputprice").val());
                var y = Number($("#ip_vat").val());
                var vat = x + (x * (y / 100));
                $("#dt_vat").val(vat);
            });
        });
    </script>
@endsection
@endsection
