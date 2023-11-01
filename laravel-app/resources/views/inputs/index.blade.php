@extends('app')
@section('content')
    <!-- DATA TABLE -->
    <h3 class="title-5 m-b-35">Phiếu nhập hàng</h3>
    @php
        
        use Carbon\Carbon;
        $inputValue = Carbon::now()->toDateString(); // Lấy ngày hiện tại
        
    @endphp
    <div class="col-md-12">
        <form action="{{ route('search') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="date" class="col-form-label "> Tìm từ ngày</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control input-sm"
                        value="{{ request()->input('fromDate') ? $fromDate : $inputValue }}" id="fromDate" name="fromDate"
                        required />
                </div>
                <label for="date" class="col-form-label "> Đến ngày</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control input-sm"
                        value="{{ request()->input('toDate') ? $toDate : $inputValue }}" id="toDate" name="toDate"
                        required />
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-outline-info" title="search" name="search">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
        </form>
        <div class="table-data__tool-right">
            <a href="phieu-nhap-hang/create" class="btn btn-primary"><i class="zmdi zmdi-plus"></i> Thêm mới</a>
            <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                <a href="/inputExport" class="btn btn-success"><i class="fa fa-download"></i> Xuất Excel</a>
            </div>
        </div>
    </div>

    <div class="row m-t-30">
        <div class="col-md-12">

            <br>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3 table-bordered">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Số hóa đơn</th>
                            <th>VAT</th>
                            <th>Ngày nhập</th>
                            <th>Ngày tạo</th>
                            <th>Nhà cung cấp</th>
                            <th>Trạng thái</th>
                            <th>Trạng thái nhập kho</th>
                            <th>Thành tiền</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data) && $data->count())
                            @foreach ($data as $ip)
                                <tr>
                                    <td>
                                        <span>{{ $ip->ip_id }}</span>
                                    </td>
                                    <td class="desc">{{ $ip->ip_bill }}</td>
                                    <td>{{ $ip->ip_vat . '%' }}</td>
                                    <td>{{ $ip->ip_dateinput }}</td>
                                    <td>{{ $ip->ip_datecreate }}</td>
                                    <td>{{ $ip->sp_name }}</td>
                                    <td style="font-size: 18px;">

                                        @if ($ip->ip_status == 0)
                                            <span class="badge badge-danger">Chưa thanh toán</span>
                                        @else
                                            <span class="badge badge-success">Đã thanh toán</span>
                                        @endif
                                    </td>
                                    <td style="font-size: 18px; margin-left: 15px">

                                        @if ($ip->ImportStatus == 0)
                                            <span class="badge badge-danger">Chờ</span>
                                        @else
                                            <span class="badge badge-success">Đã nhập</span>
                                        @endif
                                    </td>
                                    <td>{{ $ip->total ? number_format($ip->total) . ' VND' : '' }}</td>
                                    <td>

                                        <form action="{{ url('/phieu-nhap-hang/' . $ip->ip_id) }}" method="POST">
                                            <div class="table-data-feature">

                                                {{-- <span class="badge badge-danger">Chưa thanh toán</span> --}}
                                                <a href="{{ url('/phieu-nhap-hang/' . $ip->ip_id . '/edit') }}"
                                                    class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Sửa">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>




                                                @csrf
                                                @method('DELETE')
                                                @if ($ip->ip_status == 0 && $ip->ImportStatus == 0)
                                                    {{-- <span class="badge badge-danger">Chưa thanh toán</span> --}}
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Xóa" {{-- disabled={{{ $ip->ip_status == "1" }}} --}}
                                                        onclick="return confirm(&quot;Bạn thật sự muốn xóa phiếu này?&quot;)">
                                                        <i type="submit" class="zmdi zmdi-delete"></i>
                                                    </button>
                                                @else
                                                    <a href="" hidden></a>
                                                @endif


                                                {{-- <a href="{{ url('/phieu-nhap-hang/' . $ip->ip_id) }}" class="item"
                                                    data-toggle="tooltip" data-placement="top" title="Xem chi tiết">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a> --}}
                                            </div>
                                        </form>
                                    </td>
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
            <div class="row">{{ $data->appends(request()->all())->links() }}</div>
            <!-- END DATA TABLE-->
        </div>
    </div>
    <!-- END DATA TABLE -->
@endsection
