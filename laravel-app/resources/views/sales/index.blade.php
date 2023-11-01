@extends('app')
@section('content')
    <!-- DATA TABLE -->
    <h3 class="title-5 m-b-35">Phiếu bán hàng</h3>
    @php
        
        use Carbon\Carbon;
        $inputValue = Carbon::now()->toDateString(); // Lấy ngày hiện tại
        
    @endphp
    <div class="col-md-12">
        <form action="{{ url('phieu-ban-hang/search') }}" method="POST">
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
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-outline-info" title="search" name="search">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
        </form>

        <div class="table-data__tool-right">
            <a href="phieu-ban-hang/create" class="btn btn-primary"><i class="zmdi zmdi-plus"></i> Thêm mới</a>
            <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                <a href="/saleExportExcel" class="btn btn-success"><i class="fa fa-download"></i> Xuất Excel</a>
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
                            <th>Mã phiếu</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Ngày bán</th>
                            <th>VAT</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái</th>
                            <th>Trạng thái xuất kho</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data) && $data->count())
                            @foreach ($data as $sl)
                                <tr>
                                    <td>
                                        <span>{{ $sl->sl_id }}</span>
                                    </td>
                                    <td class="desc">{{ $sl->sl_name }}</td>
                                    <td>{{ $sl->sl_addr }}</td>
                                    <td>{{ $sl->sl_phone }}</td>
                                    <td>{{ $sl->sl_date }}</td>
                                    <td>{{ $sl->sl_vat . '%' }}</td>
                                    <td>{{ $sl->sl_note }}</td>
                                    <td>

                                        @if ($sl->sl_status == 0)
                                            <span class="badge badge-danger">Chưa thanh toán</span>
                                        @else
                                            <span class="badge badge-success">Đã thanh toán</span>
                                        @endif
                                    </td>
                                    <td style="font-size: 18px; margin-left: 15px">

                                        @if ($sl->ImportStatus == 0)
                                            <span class="badge badge-danger">Chờ</span>
                                        @else
                                            <span class="badge badge-success">Đã xuất</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ url('/phieu-ban-hang/' . $sl->sl_id) }}" method="POST">
                                            <div class="table-data-feature">
                                                <a href="{{ url('/phieu-ban-hang/' . $sl->sl_id . '/edit') }}"
                                                    class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Sửa">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>



                                                @csrf
                                                @method('DELETE')
                                                @if ($sl->sl_status == 0 && $sl->ImportStatus == 0)
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Xóa"
                                                        onclick="return confirm(&quot;Bạn thật sự muốn xóa phiếu này?&quot;)">
                                                        <i type="submit" class="zmdi zmdi-delete"></i>
                                                    </button>
                                                @else
                                                    <a href="" hidden></a>
                                                @endif
                                                {{-- <a href="{{ url('/phieu-ban-hang/' . $sl->sl_id) }}" class="item"
                                                        data-toggle="tooltip" data-placement="top" title="Xem chi tiết">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </a> --}}

                                                @if ($sl->ImportStatus == 1)
                                                    <a href="{{ url('/phieu-ban-hang/' . $sl->sl_id . '/print') }}"
                                                        class="item" data-toggle="tooltip" data-placement="top"
                                                        title="In đơn hàng">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                @endif



                                            </div>
                                        </form>
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
            <div class="row">{{ $data->appends(request()->all())->links() }}</div>
            <!-- END DATA TABLE-->
        </div>
    </div>
    <!-- END DATA TABLE -->
@endsection
