<?php

namespace App\Exports;

use App\Models\Product;

class productsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('prd_id','prd_name', 'prd_unit', 'prd_inputprice', 'prd_saleprice', 'prd_desc')->get();
    }
    public function headings(): array
    {
        return ["Mã sản phẩm","Tên sản shẩm", "Đơn vị tính", "Đơn giá nhập", "Đơn giá bán", "Thông tin xuất xứ sản phẩm"];
    }
}
