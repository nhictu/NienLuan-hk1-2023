@extends('app')
@section('content')
    <div class="card">
        <div class="card-header">Thông tin nhà cung cấp</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Thêm nhà cung cấp</h3>
            </div>
            <hr>
            <form action="{{ url('/suppliers') }}" method="POST" novalidate="novalidate">
                @csrf
                {{-- @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif --}}
                <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1">Tên nhà cung cấp</label>
                    <input id="cc-pament" name="sp_name" type="text" class="form-control" aria-required="true"
                        aria-invalid="false">
                    <span class="text-danger small">
                        @error('sp_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1">Thông tin người liên hệ</label>
                    <input id="cc-pament" name="sp_contact" type="text" class="form-control" aria-required="true"
                        aria-invalid="false">
                    <span class="text-danger small">
                        @error('sp_contact')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1">Số điện thoại</label>
                    <input id="cc-pament" name="sp_phone" type="text" class="form-control" aria-required="true"
                        aria-invalid="false">
                    <span class="text-danger small">
                        @error('sp_phone')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="cc-number" class="control-label mb-1">Địa chỉ</label>
                    <textarea id="cc-number" name="sp_addr" class="form-control cc-number identified visa" value="" data-val="true"
                        data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number"
                        autocomplete="cc-number"></textarea>
                    <span class="text-danger small">
                        @error('sp_addr')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Thêm
                        </button>
                        <a href="{{ url('/suppliers') }}" type="reset" class="btn btn-danger btn-sm">
                            <i class="fas fa-reply"></i> Trở lại
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
