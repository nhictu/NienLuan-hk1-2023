@extends('app')
@section('content')
    <div class="card">
        <div class="card-header">Thông tin sản phẩm</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Cập nhật sản phẩm</h3>
            </div>
            <hr>
            <form action="{{ url('/products/' . $prd->prd_id) }}" method="POST" novalidate="novalidate">
                @csrf
                @method('PUT')
                <input type="hidden" name="prd_id" value="{{ $prd->prd_id }}">
                {{-- @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif --}}
                <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1">Tên sản phẩm</label>
                    <input id="cc-pament" name="prd_name" type="text" class="form-control" aria-required="true"
                        aria-invalid="false" value="{{ $prd->prd_name }}">
                    <span class="text-danger small">
                        @error('prd_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group ">
                    <label for="select" class=" form-control-label">Đơn vị tính</label>
                    <div class=" form-control-label">
                        <select name="prd_unit" id="select" class="form-control">
                            <option value="{{ $prd->prd_unit }}">{{ $prd->prd_unit }}</option>
                            <option value="Kg">Kg</option>
                            <option value="Lon">Lon</option>
                            <option value="Cái">Cái</option>
                            <option value="Chai">Chai</option>
                            <option value="Bịch">Gói</option>
                        </select>
                    </div>
                    <span class="text-danger small">
                        @error('prd_unit')
                            {{ $message }}
                        @enderror
                    </span>
                </div>


                <div class="row">
                    <div class="col-6">
                        <label for="x_card_code" class="control-label mb-1">Đơn giá nhập</label>
                        <div class="input-group">
                            <input id="x_card_code" name="prd_inputprice" type="tel" class="form-control cc-cvc"
                                value="{{ $prd->prd_inputprice }}" data-val="true"
                                data-val-required="Please enter the security code"
                                data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                        </div>
                        <span class="text-danger small">
                            @error('prd_inputprice')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-6">
                        <label for="x_card_code" class="control-label mb-1">Đơn giá bán</label>
                        <div class="input-group">
                            <input id="x_card_code" name="prd_saleprice" type="tel" class="form-control cc-cvc"
                                value="{{ $prd->prd_saleprice }}" data-val="true"
                                data-val-required="Please enter the security code"
                                data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                        </div>
                        <span class="text-danger small">
                            @error('prd_saleprice')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cc-number" class="control-label mb-1">Thông tin xuất xứ sản phẩm</label>
                    <textarea id="cc-number" name="prd_desc" class="form-control cc-number identified visa" value="" data-val="true"
                        data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                        autocomplete="cc-number">{{ $prd->prd_desc }}</textarea>
                    <span class="text-danger small">
                        @error('prd_desc')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Cập nhật
                        </button>
                        <a href="{{ url('/products') }}" type="reset" class="btn btn-danger btn-sm">
                            <i class="fas fa-reply"></i> Trở lại
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
