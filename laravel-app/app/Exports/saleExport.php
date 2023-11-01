<?php

namespace App\Exports;

use App\Models\Sale;


class saleExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $sales = Sale::select('sl_id', 'sl_name', 'sl_addr', 'sl_phone', 'sl_vat', 'sl_date', 'sl_note', 'sl_status', 'ImportStatus')->get();

        $transformedSales = $sales->map(function ($sale) {
            $sale->sl_status = $sale->sl_status === 0 ? 'Chưa thanh toán' : 'Đã thanh toán';
            $sale->ImportStatus = $sale->ImportStatus === 0 ? 'Chưa xuất kho' : 'Đã xuất kho';
            return $sale;
        });
        return $transformedSales;
    }

    public function headings(): array
    {
        return ["Mã phiếu", "Tên khách hàng", "Địa Chỉ", "Số Điện Thoại", "VAT", "Ngày bán", "Ghi Chú", "Trạng thái"];
    }
}
