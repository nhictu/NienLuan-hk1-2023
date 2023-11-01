@extends('app')
@section('content')
    @php
        
        use Carbon\Carbon;
        $inputValue = Carbon::now()->toDateString(); // Lấy ngày hiện tại
        
    @endphp
    <div class="card">
        <span class="border border-warning">
            <div class="card-header">Thông tin nhập hàng</div>
            <div class="card-body">
                <form action="{{ url('/phieu-nhap-hang') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <label for="x_card_code" class="control-label mb-1">Số hóa đơn </label>
                            <input id="cc-pament" name="ip_bill" type="text" class="form-control" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger small">
                                @error('ip_bill')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-6">
                            <label for="x_card_code" class="control-label mb-1">Nhà cung cấp</label>
                            <select name="sp_id" class="form-control">
                                <option value="0">Chọn nhà cung cấp</option>
                                @foreach ($supplier as $item)
                                    <option value="{{ $item->sp_id }}">{{ $item->sp_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="cc-number" class="control-label mb-1">Thanh toán</label>
                            <select name="ip_status" class="form-control" id="select" readonly>
                                {{-- <option value="">Chọn thanh toán</option> --}}
                                <option value="0">Chưa thanh toán</option>
                                {{-- <option value="1">Đã thanh toán</option> --}}
                            </select>
                            {{-- <input type="text" name="ip_status" class="form-control" value="0"> --}}
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="x_card_code" class="control-label mb-1">VAT</label>
                            <input id="cc-pament" name="ip_vat" type="text" class="form-control" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger small">
                                @error('ip_vat')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-4">
                            <label for="x_card_code" class="control-label mb-1">Ngày nhập: </label>
                            <div class="input-group">
                                <input id="x_card_code myDate" name="ip_dateinput" type="date"
                                    class="form-control cc-cvc" value="{{ $inputValue }}" data-val="true"
                                    data-val-required="Please enter the security code"
                                    data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                            </div>
                            <span class="text-danger small">
                                @error('ip_dateinput')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-4">
                            <label for="x_card_code" class="control-label mb-1">Ngày tạo: </label>
                            <div class="input-group">
                                <input id="x_card_code myDate" name="ip_datecreate" type="date"
                                    class="form-control cc-cvc" value="{{ $inputValue }}" data-val="true"
                                    data-val-required="Please enter the security code"
                                    data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                            </div>
                            <span class="text-danger small">
                                @error('ip_datecreate')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <br><br>
                    {{-- </span> --}}


                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        <a href="{{ url('/phieu-nhap-hang') }}" type="reset" class="btn btn-danger btn-sm">
                            <i class="fas fa-reply"></i> Trở lại
                        </a>
                    </div>

                </form>
            </div>
    </div>
@endsection
