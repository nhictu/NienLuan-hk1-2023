<?php

namespace App\Exports;

use App\Models\Input;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class inputExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $inputs = Input::select(
            'ip_id',
            'ip_bill',
            'ip_vat',
            'ip_dateinput',
            'ip_datecreate',
            'suppliers.sp_name',
            'ip_status',
            'ImportStatus',
            'total',
        )
            ->join('suppliers', 'suppliers.sp_id', '=', 'inputs.sp_id')
            ->get();
        $transformedInputs = $inputs->map(function ($input) {
            $input->ip_status = $input->ip_status === 0 ? 'Chưa thanh toán' : 'Đã thanh toán';
            $input->ImportStatus = $input->ImportStatus === 0 ? 'Chưa nhập kho' : 'Đã nhập kho';
            return $input;
        });
        return $transformedInputs;
        // return Input::select('ip_id', 'ip_bill', 'ip_vat', 'ip_dateinput', 'ip_datecreate', 'ip_status', 'ImportStatus', 'total')->get();
    }
    public function headings(): array
    {
        return ["Mã", "Số hóa đơn", "VAT", "Ngày nhập", "Ngày tạo", "Nhà cung cấp", "trạng thái", "trạng thái nhập kho", "thành tiền"];
    }
}
