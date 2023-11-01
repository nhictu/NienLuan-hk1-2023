@extends('app')
@section('content')
    <!-- DATA TABLE -->
    <h3 class="title-5 m-b-35">Xem chi tiết</h3>
    <div class="table-data__tool">
        <div class="table-data__tool-left">

        </div>
        <div class="table-data__tool-right">
            <a href="{{ url('/phieu-ban-hang') }}" type="reset" class="btn btn-danger btn-sm">
                <i class="fas fa-reply"></i> Trở lại
            </a>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Mã phiếu</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>VAT</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span>{{ $sl->sl_id }}</span>
                            </td>
                            <td class="desc">{{ $sl->cus_name }}</td>
                            <td>{{ $sl->cus_addr }}</td>
                            <td>{{ $sl->cus_phone }}</td>
                            <td>{{ $sl->sl_vat * 100 . '%' }}</td>
                            <td>{{ $sl->sl_note }}</td>
                            <td>

                                @if ($sl->sl_status == 0)
                                    <span class="badge badge-danger">Chưa thanh toán</span>
                                @else
                                    <span class="badge badge-success">Đã thanh toán</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <h3 class="title-5 m-b-35">Chi tiết phiếu nhập hàng</h3> --}}


    {{-- <div class="row">
        <div class="col-lg-12"> --}}
    <!-- USER DATA-->
    <div class="user-data m-b-30">
        <h3 class="title-3 m-b-30" style="color:rgb(247, 21, 21)">
            <i class="zmdi zmdi-account-calendar"></i>Chi tiết phiếu nhập hàng
        </h3>
        <div class="table-responsive table-data">
            <table class="table">
                <thead>
                    <tr>
                        <td>Mã</td>
                        <td>Tên sản phẩm</td>
                        <td>Số lượng</td>
                        <td>Đơn giá</td>
                        <td>Thành tiền</td>

                    </tr>
                </thead>
                <tbody>
                    @if (!empty($saledetails) && $saledetails->count())
                        @foreach ($saledetails as $sdt)
                            <tr>
                                <td>{{ $sdt->sdt_id }}</td>
                                <td>{{ $sdt->prd_name }}</td>
                                <td>{{ $sdt->sdt_quantity }}</td>
                                <td>{{ number_format($sdt->sdt_saleprice) . ' VND' }}</td>
                                <td>{{ number_format($sdt->sdt_totalprice) . ' VND' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Không có dữ liệu.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- </div>
            <!-- END USER DATA-->
        </div> --}}
    @endsection
