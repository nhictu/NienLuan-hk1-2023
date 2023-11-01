<?php

namespace App\Exports;

use App\Models\Supplier;


class suppliersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Supplier::select('sp_id','sp_name', 'sp_contact', 'sp_phone', 'sp_addr')->get();
    }
    public function headings(): array
    {
        return ["Mã nhà cung cấp","Tên nhà cung cấp", "Thông tin liên hệ", "Số điện thoại", "Địa chỉ"];
    }
}
