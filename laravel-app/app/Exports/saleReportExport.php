<?php

namespace App\Exports;

use App\Models\sale_detail;
use Illuminate\Support\Facades\DB;

// use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class saleReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sales =  DB::table('sales')
            ->selectRaw('sales.sl_id as id , sales.created_at as date, sales.sl_name as name,  
             sales.sl_status as status, SUM(sale_details.sdt_totalprice) as total,
            (sale_details.sdt_quantity * sale_details.sdt_saleprice)-(sale_details.sdt_quantity * input_details.dt_inputprice) as dt')
            ->join('sale_details', 'sale_details.sl_id', '=', 'sales.sl_id')
            ->join('inventories', 'inventories.iv_id', '=', 'sale_details.iv_id')
            ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
            ->groupBy(
                'sales.sl_id',
                'sales.created_at',
                'sales.sl_name',
                'sales.sl_status',
                'sale_details.sdt_quantity',
                'sale_details.sdt_saleprice',
                'input_details.dt_inputprice'
            )
            ->get();

        $transformedSales = $sales->map(function ($sale) {
            $sale->status = $sale->status === 0 ? 'Chưa thanh toán' : 'Đã thanh toán';
            // $sale->ImportStatus = $sale->ImportStatus === 0 ? 'Chưa nhập kho' : 'Đã nhập kho';
            return $sale;
        });
        return $transformedSales;
    }

    public function headings(): array
    {
        return ["Mã phiếu", "Ngày bán", "Tên khách hàng", "Trạng thái", "Thành tiền bán", "Doanh thu"];
    }
}
