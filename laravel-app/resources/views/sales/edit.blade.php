@extends('app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <br>
            <div class="card">
                <span class="border border-danger">
                    <div class="card-header">
                        Thêm sản phẩm vào
                        <strong style="color: rgb(229, 18, 134)">Phiếu bán hàng</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ url('/phieu-ban-hang/' . $sl->sl_id . '/create') }}" method="post"
                            class="form-horizontal">
                            @csrf
                            {{-- @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif --}}
                            <input type="hidden" name="sl_id" value="{{ $sl->sl_id }}">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Sản phẩm</label>
                                        <select name="iv_id" id="iv_id" class="form-control">
                                            {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>
                                            <option value="0">Chọn sản phẩm</option>
                                            @foreach ($kho as $item)
                                                <option value="{{ $item->iv_id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger small">
                                            @error('prd_id')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Đơn vị tính</label>
                                        <div class=" form-control-label">
                                            <select name="sdt_unit" id="dvt" class="form-control"
                                                {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>
                                                <option value="0">Chọn đơn vị tính</option>
                                                <option value="Kg">Kg</option>
                                                <option value="Lon">Lon</option>
                                                <option value="Cái">Cái</option>
                                                <option value="Chai">Chai</option>
                                                <option value="Bịch">Gói</option>
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
                                <div class="col-3">
                                    <label for="x_card_code" class="control-label mb-1">Số lượng bán</label>
                                    <div class="input-group">
                                        <input id="sdt_quantity" name="sdt_quantity" type="number"
                                            class="form-control cc-cvc" value="" data-val="true"
                                            data-val-required="Please enter the security code"
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off"
                                            {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>
                                    </div>
                                    <span class="text-danger small">
                                        @error('sdt_quantity')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-3">
                                    <label for="x_card_code" class="control-label mb-1">Số lượng tồn</label>
                                    <div class="input-group">
                                        <input id="slt" name="iv_final" type="number" class="form-control cc-cvc"
                                            value="" data-val="true"
                                            data-val-required="Please enter the security code"
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off"
                                            readonly>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <label for="x_card_code" class="control-label mb-1">Đơn giá bán</label>
                                    <div class="input-group">
                                        <input id="dgb" name="sdt_saleprice" type="text"
                                            class="form-control cc-cvc" value="" data-val="true"
                                            data-val-required="Please enter the security code"
                                            data-val-cc-cvc="Please enter a valid security code" autocomplete="off"
                                            {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>

                                    </div><span class="text-danger small">
                                        @error('sdt_saleprice')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-3">
                                    <label for="x_card_code" class="control-label mb-1">Thành tiền</label>
                                    <div class="input-group">
                                        <input name="sdt_totalprice" type="text" class="form-control cc-cvc"
                                            value="" id="sdt_totalprice" readonly>
                                    </div>
                                    <span class="text-danger small">
                                        @error('sdt_totalprice')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="col-4">
                                <label for="x_card_code" class="control-label mb-1" type="hidden"></label>
                                @if ($sl->ImportStatus == 0)
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-success btn-sm">
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
                    <div class="card-header">Thông tin bán hàng</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2" style="color: rgb(206, 15, 34)">Cập nhật bán nhập hàng</h3>
                        </div>
                        <hr>
                        <form action="{{ url('/phieu-ban-hang/' . $sl->sl_id) }}" method="POST"
                            novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="sl_id" value="{{ $sl->sl_id }}">
                            {{-- @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif --}}

                            <div class="row">
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Tên khách hàng</label>
                                    <input id="cc-pament" name="sl_name" type="text" class="form-control"
                                        aria-required="true" aria-invalid="false" value="{{ $sl->sl_name }}"
                                        {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>
                                    <span class="text-danger small">
                                        @error('sl_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Số điện thoại</label>
                                    <input id="cc-pament" name="sl_phone" type="text" value="{{ $sl->sl_phone }}"
                                        class="form-control" aria-required="true" aria-invalid="false"
                                        {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>
                                    <span class="text-danger small">
                                        @error('sl_phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-10">
                                    <label for="x_card_code" class="control-label mb-1">Địa chỉ</label>
                                    <input id="cc-pament" name="sl_addr" type="text" class="form-control"
                                        aria-required="true" value="{{ $sl->sl_addr }}" aria-invalid="false"
                                        {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>
                                    <span class="text-danger small">
                                        @error('sl_addr')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label for="cc-number" class="control-label mb-1">Thanh toán</label>
                                    <select name="ip_status" class="form-control" id="select" readonly>
                                        <option value="{{ $sl->sl_status }}">
                                            {{ $sl->sl_status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}</option>
                                        <option value="0">Chưa thanh toán</option>
                                        <option value="1">Đã thanh toán</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="x_card_code" class="control-label mb-1">VAT</label>
                                    <input id="cc-pament" name="sl_vat" type="text" class="form-control"
                                        aria-required="true" value="{{ $sl->sl_vat }}" aria-invalid="false"
                                        {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>
                                    <span class="text-danger small">
                                        @error('sl_vat')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-4">
                                    <label for="x_card_code" class="control-label mb-1">Ngày bán</label>
                                    <input id="cc-pament" name="sl_date" type="date" class="form-control"
                                        aria-required="true" value="{{ $sl->sl_date }}" aria-invalid="false"
                                        {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>
                                    <span class="text-danger small">
                                        @error('sl_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <label for="x_card_code" class="control-label mb-1">Ghi chú</label>
                                    <textarea id="cc-number" name="sl_note" class="form-control cc-number identified visa" value=""
                                        data-val="true" data-val-required="Please enter the card number"
                                        data-val-cc-number="Please enter a valid card number" autocomplete="cc-number"
                                        {{ $sl->ImportStatus == 1 ? 'readonly' : '' }}>{{ $sl->sl_note }}</textarea>
                                    <span class="text-danger small">
                                        @error('sl_note')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <br>
                            @if ($sl->ImportStatus == 0)
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Cập nhật
                                </button>
                            @endif
                            <a href="{{ url('/phieu-ban-hang') }}" type="reset" class="btn btn-danger btn-sm">
                                <i class="fas fa-reply"></i> Trở lại
                            </a>
                        </form>
                    </div>
                </span>
            </div>
        </div>

    </div>
    <h4 style="color:red">Thông tin sản phẩm bán hàng</h4>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá bán</th>
                            <th>Thành tiền</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($saledetails) && $saledetails->count())
                            @foreach ($saledetails as $sdt)
                                <tr>
                                    <td>{{ $sdt->name }}</td>
                                    <td>{{ $sdt->quantity }}</td>
                                    <td>{{ number_format($sdt->saleprice) . ' VND' }}</td>
                                    <td>{{ number_format($sdt->totalprice) . ' VND' }}</td>

                                    <td>
                                        @if ($sl->ImportStatus == 0)
                                            <form
                                                action="{{ url('/phieu-ban-hang/' . $sl->sl_id . '/' . $sdt->sdt_id . '/delete') }}"
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

            @if ($sl->sl_status == 0 && $sl->ImportStatus == 1)
                <form id="delete-form" action="{{ url('/phieu-ban-hang/' . $sl->sl_id . '/status') }}" method="POST">
                    @csrf
                    <button id="delete-form" class="btn btn-success" style="margin-right: 20px;" type="submit"
                        onclick="return confirm(&quot;xác nhận thanh toán ?&quot;)">Thanh toán</button>
                </form>
            @endif
            @if ($sl->sl_status == 1 && $sl->ImportStatus == 1)
                <form id="delete-form" action="{{ url('/phieu-ban-hang/' . $sl->sl_id . '/status') }}" method="POST">
                    @csrf
                    <button id="delete-form" class="btn btn-danger" style="margin-right: 20px;" type="submit"
                        onclick="return confirm(&quot;xác nhận hủy thanh toán ?&quot;)">Hủy thanh toán</button>
                </form>
            @endif

            @if ($sl->ImportStatus == 1)
                {{-- <form id="delete-form" action="{{ url('/phieu-ban-hang/' . $sl->sl_id . '/delete') }}" method="POST">
                    @csrf
                    <button id="delete-form" class="btn btn-danger" style="margin-right: 20px;" type="submit"
                        onclick="return confirm(&quot;Bạn thật sự muốn hủy xuất kho?&quot;)" disabled>Hủy xuất
                        kho</button>
                </form> --}}
            @else
                <form action="{{ url('/phieu-ban-hang/' . $sl->sl_id . '/export') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="" name="iv_id" value="">
                    <button id="add-form" class="btn btn-warning" type="submit"
                        onclick="return confirm(&quot;Bạn thật sự muốn xuất kho này?&quot;)">Xuất kho hàng</button>

                </form>
            @endif


        </div>
    </div>
@section('script')
    <script>
        $(document).on('change', '#iv_id', function() {
            var iv_id = $(this).val();

            var a = $(this).parent();
            console.log(iv_id);
            var op = "";

            $.ajax({
                type: 'get',
                url: '{!! URL::to('findsaledata') !!}',
                data: {
                    'iv_id': iv_id
                },
                dataType: 'json',
                success: function(data) {

                    $("#dvt").val(data.unit);
                    $("#dgb").val(data.iv_saleprice);

                    // console.log(data.iv_export);
                    if (data.iv_export == 0) {
                        $("#slt").val(data.iv_final);

                    } else {
                        $("#slt").val(data.iv_final - data.iv_export);
                    }
                },
                error: function() {

                }
            })
        });
        $(document).ready(function() {
            $("#sdt_quantity").keyup(function() {

                var y = Number($("#sdt_quantity").val());
                var z = Number($("#slt").val());
                var x = Number($("#dgb").val());

                if (y <= z) {
                    // alert("OK");
                    var tt = 0;
                    var tt = x * y;
                    $("#sdt_totalprice").val(tt);
                } else if (y = 0) {
                    alert("Số lượng bán không được bằng 0!!!");
                } else {
                    alert("Số lượng bán không được lớn hơn số lượng tồn!!!")
                }
            });
        });
    </script>
@endsection
@endsection
