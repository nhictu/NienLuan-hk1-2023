@extends('app')
@section('content')
    @php
        
        use Carbon\Carbon;
        $inputValue = Carbon::now()->toDateString(); // Lấy ngày hiện tại
        
    @endphp
    <div class="card">
        <span class="border border-warning">
            <div class="card-header">Thông tin bán hàng</div>
            <div class="card-body">
                <form action="{{ url('/phieu-ban-hang') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <label for="x_card_code" class="control-label mb-1">Tên khách hàng</label>
                            <input id="cc-pament" name="sl_name" type="text" class="form-control" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger small">
                                @error('sl_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-4">
                            <label for="x_card_code" class="control-label mb-1">Số điện thoại</label>
                            <input id="cc-pament" name="sl_phone" type="text" class="form-control" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger small">
                                @error('sl_phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-4">
                            <label for="x_card_code" class="control-label mb-1">Địa chỉ</label>
                            <input id="cc-pament" name="sl_addr" type="text" class="form-control" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger small">
                                @error('sl_addr')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="cc-number" class="control-label mb-1">Thanh toán</label>
                            <select name="sl_status" class="form-control" id="select" readonly>
                                {{-- <option value="">Chọn thanh toán</option> --}}
                                <option value="0">Chưa thanh toán</option>
                                {{-- <option value="1">Đã thanh toán</option> --}}
                            </select>
                            {{-- <input type="text" name="ip_status" class="form-control" value="0"> --}}
                        </div>
                        <div class="col-3">
                            <label for="x_card_code" class="control-label mb-1">VAT</label>
                            <input id="cc-pament" name="sl_vat" type="text" class="form-control" aria-required="true"
                                aria-invalid="false">
                            <span class="text-danger small">
                                @error('sl_vat')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-5">
                            <label for="x_card_code" class="control-label mb-1">Ngày bán</label>
                            <input id="cc-pament" name="sl_date" type="date" class="form-control" aria-required="true"
                                aria-invalid="false" value="{{ $inputValue }}">
                            <span class="text-danger small">
                                @error('sl_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <label for="x_card_code" class="control-label mb-1">Ghi chú</label>
                            <textarea id="cc-number" name="sl_note" class="form-control cc-number identified visa" value="" data-val="true"
                                data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                                autocomplete="cc-number"></textarea>

                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Thêm
                    </button>
                    <a href="{{ url('/phieu-ban-hang') }}" type="reset" class="btn btn-danger btn-sm">
                        <i class="fas fa-reply"></i> Trở lại
                    </a>

                </form>
            </div>
        </span>
    </div>
@endsection
