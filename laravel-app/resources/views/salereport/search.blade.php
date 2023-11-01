@extends('app')
@section('content')
    <h3 class="title-5 m-b-35">Báo cáo bán hàng</h3>
    @php
        
    use Carbon\Carbon;
    $inputValue = Carbon::now()->toDateString(); // Lấy ngày hiện tại
    
@endphp
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


    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <form action="">
                    <label for="date" class="col-form-label "> Tìm trạng thái</label>
                <select name="status" class="form-control" id="status" value="{{ request()->input('status') ? $status : ' ' }}">
                        @if($status == null)
                        {{-- <option value=" ">Chọn tất cả</option> --}}
                        <option value="0">Chưa thanh toán</option>
                        <option value="1">Đã thanh toán</option>
                        @elseif($status == 1)
                        <option value="1">Đã thanh toán</option>
                        <option value="0">Chưa thanh toán</option>
                        <option value=" ">Chọn tất cả</option>
                        @else
                        <option value="0">Chưa thanh toán</option>
                        <option value="1">Đã thanh toán</option>
                        <option value=" ">Chọn tất cả</option>
                        @endif
                    
                {{-- <option value="">Chọn thanh toán</option> --}}
                    
                   
                </select>
            </div>
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-outline-info" title="search" name="search">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
            </form>
        </form>
        </div>
        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
            <a href="/saleReportExport" class="btn btn-success"><i class="fa fa-download"></i> Xuất Excel</a>
        </div>
    </div>
    
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3 table-bordered">
                    <thead>
                        <tr>
                            <th>Mã phiếu</th>
                            <th>Ngày bán</th>
                            <th>Tên khách hàng</th>
                            <th>Trạng thái đơn hàng </th>
                            <th>Thành tiền bán</th>
                            <th>Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody class="seach-result">

                        @if (!empty($sale) && $sale->count())
                            @foreach ($sale as $sl)
                                <tr>
                                    <td>
                                        <span>{{ $sl->sl_id }}</span>
                                    </td>
                                    <td class="desc">{{ $sl->sl_date }}</td>
                                    <td>{{ $sl->sl_name }}</td>

                                    <td>

                                        @if ($sl->sl_status == 0)
                                            <span class="badge badge-danger">Chưa thanh toán</span>
                                        @else
                                            <span class="badge badge-success">Đã thanh toán</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($sl->sdt_totalprice) . ' VND' }}</td>
                                    <td>{{ number_format($sl->dt) . ' VND' }}</td>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">Không có dữ liệu.</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
