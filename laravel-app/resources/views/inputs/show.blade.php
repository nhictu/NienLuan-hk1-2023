@extends('app')
@section('content')
    <!-- DATA TABLE -->
    <h3 class="title-5 m-b-35">Xem chi tiết</h3>
    <div class="table-data__tool">
        <div class="table-data__tool-left">

        </div>
        <div class="table-data__tool-right">
            <a href="{{ url('/phieu-nhap-hang') }}" type="reset" class="btn btn-danger btn-sm">
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
                            <th>Mã</th>
                            <th>Số hóa đơn</th>
                            <th>VAT</th>
                            <th>Ngày nhập</th>
                            <th>Ngày tạo</th>
                            <th>Nhà cung cấp</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span>{{ $ip->ip_id }}</span>
                            </td>
                            <td class="desc">{{ $ip->ip_bill }}</td>
                            <td>{{ $ip->ip_vat * 100 . '%' }}</td>
                            <td>{{ $ip->ip_dateinput }}</td>
                            <td>{{ $ip->ip_datecreate }}</td>
                            <td>{{ $ip->sp_name }}</td>
                            <td>

                                @if ($ip->ip_status == 0)
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
                        <td>Đơn vị tính</td>
                        <td>Số lô</td>
                        <td>Hạn dùng</td>
                        <td>Đơn giá nhập</td>
                        <td>Đơn giá VAT</td>
                        <td>Đơn giá bán</td>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($inputdetail) && $inputdetail->count())
                        @foreach ($inputdetail as $dt)
                            <tr>
                                <td>{{ $dt->dt_id }}</td>
                                <td>{{ $dt->prd_name }}</td>
                                <td>{{ $dt->dt_quantity }}</td>
                                <td>{{ $dt->dt_unit }}</td>
                                <td>{{ $dt->dt_lotnumber }}</td>
                                <td>{{ $dt->dt_expried }}</td>
                                <td>{{ number_format($dt->dt_inputprice) . ' VND' }}</td>
                                <td>{{ number_format($dt->dt_vat) . ' VND' }}</td>
                                <td>{{ number_format($dt->dt_saleprice) . ' VND' }}</td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">Không có dữ liệu.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- </div>
            <!-- END USER DATA-->
        </div> --}}
    @endsection
