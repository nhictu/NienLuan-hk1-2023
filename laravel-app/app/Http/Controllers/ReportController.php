<?php

namespace App\Http\Controllers;

use App\Exports\salereportExport;
use App\Exports\inventoryReportExport;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Sale_detail;
use App\Models\sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

// namespace App\Http\Controllers;

// use App\Exports\productsExport;
// use App\Models\Product;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Blade;
// use Illuminate\Support\Facades\DB;
// // use Maatwebsite\Excel\Excel;
// use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function showrpsales()
    {

        $sale = DB::table('sales')
            // ->where('sales.sl_status', 0)
            ->selectRaw('sales.sl_id as id , sales.sl_date as date, sales.sl_name as name,  
            sales.sl_status as status, SUM(sale_details.sdt_totalprice) as total,
            (sale_details.sdt_quantity * sale_details.sdt_saleprice)-(sale_details.sdt_quantity * input_details.dt_inputprice) as dt')
            ->join('sale_details', 'sale_details.sl_id', '=', 'sales.sl_id')
            ->join('inventories', 'inventories.iv_id', '=', 'sale_details.iv_id')
            ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
            ->groupBy(
                'sales.sl_id',
                'sales.sl_date',
                'sales.sl_name',
                'sales.sl_status',
                'sale_details.sdt_quantity',
                'sale_details.sdt_saleprice',
                'input_details.dt_inputprice'
            )
            ->orderBy('sales.created_at', 'desc')
            ->get();

        return view('salereport.rp_sales', compact('sale'));
    }

    public function showrpinventory()
    {
        $data = DB::table('inventories')
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

        return view('salereport.rp_inventory', compact('data'));
    }
    //export
    public function export()
    {
        return Excel::download(new saleReportExport, 'DSBaoCaoBanHang.xlsx');
    }
    public function exportinventory()
    {
        return Excel::download(new inventoryReportExport, 'DSBaoCaoTonKho.xlsx');
    }

    //search
    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $status = $request->input('status');
        if ($status == null) {
            $sale = DB::table('sales')->select()
                ->where('sl_date', '>=', $fromDate)
                ->where('sl_date', '<=', $toDate)
                ->selectRaw('(sale_details.sdt_quantity * sale_details.sdt_saleprice)-(sale_details.sdt_quantity * input_details.dt_inputprice) as dt')
                ->join('sale_details', 'sale_details.sl_id', '=', 'sales.sl_id')
                ->join('inventories', 'inventories.iv_id', '=', 'sale_details.iv_id')
                ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
                ->orderBy('sales.sl_id', 'asc')
                ->paginate(5);
            return view('salereport.search', compact('sale', 'fromDate', 'toDate', 'status'));
        } else {
            $sale = DB::table('sales')->select()
                ->where('sl_date', '>=', $fromDate)
                ->where('sl_date', '<=', $toDate)
                ->where('sl_status', '=', $status)
                ->selectRaw('(sale_details.sdt_quantity * sale_details.sdt_saleprice)-(sale_details.sdt_quantity * input_details.dt_inputprice) as dt')
                ->join('sale_details', 'sale_details.sl_id', '=', 'sales.sl_id')
                ->join('inventories', 'inventories.iv_id', '=', 'sale_details.iv_id')
                ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
                ->orderBy('sales.sl_id', 'asc')
                ->paginate(5);
            return view('salereport.search', compact('sale', 'fromDate', 'toDate', 'status'));
        }
    }

    public function filterSale(Request $request)
    {

        if ($request->sl_status == 1) {
            $sale =  DB::table('sales')
                ->where('sales.sl_status', 1)
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
        } else {
            $sale =  DB::table('sales')
                ->where('sales.sl_status', 0)
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
        }

        return view('salereport.rp_sales', compact('sale'));
    }
}
