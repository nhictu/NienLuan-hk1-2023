<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;

class inventoryReportExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('inventories')
            ->selectRaw('inventories.prd_id as id , products.prd_name as name, products.prd_unit as unit,inventories.iv_saleprice as saleprice, 
         SUM(inventories.iv_final) as begin, SUM(inventories.iv_realexport) as export, 
         SUM(inventories.iv_final) - SUM(inventories.iv_realexport) as final ')
            ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
            ->join('products', 'products.prd_id', '=', 'input_details.prd_id')
            ->groupBy(
                'inventories.prd_id',
                'inventories.iv_saleprice',
                // 'products.prd_id',
                'products.prd_name',
                'products.prd_unit',
                // 'inventories.iv_final',
                // 'inventories.iv_realexport1',
            )
            ->get();
    }
    public function headings(): array
    {
        return ["Mã sản phẩm", "Tên sản phẩm", "Đơn vị tính", "Đơn giá", "Số lượng tồn đầu kì", "Số lượng xuất", "Số lượng tồn cuối"];
    }
}
