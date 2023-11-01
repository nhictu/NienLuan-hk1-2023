<?php

namespace App\Http\Controllers;

use App\Exports\saleExport;
use App\Exports\saleReportExport;
use App\Models\Input;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Sale_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('sales')
            ->orderBy('sales.created_at', 'asc')

            ->paginate(5);
        // dd($data);
        return view('sales.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sl_vat' => 'required',
            'sl_name' => 'required',
            'sl_date' => 'required',
            'sl_phone' => 'required',
            'sl_addr' => 'required',
            'sl_status' => 'required',

        ]);
        $sl = new Sale();
        $sl->sl_vat = $request->sl_vat;
        $sl->sl_note = $request->sl_note;
        $sl->sl_status = $request->sl_status;
        $sl->sl_name = $request->sl_name;
        $sl->sl_date = $request->sl_date;
        $sl->sl_phone = $request->sl_phone;
        $sl->sl_addr = $request->sl_addr;
        $sl->sl_status = $request->sl_status;
        $sl->save();


        return redirect('/phieu-ban-hang/create')->with('success', 'Thêm phiếu bán hàng thành công!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sl = Sale::where('sl_id', $id)
            // ->join('customers', 'customers.cus_id', '=', 'sales.cus_id')
            ->first();

        $saledetails = DB::table('sale_details')
            ->join('sales', 'sales.sl_id', '=', 'sale_details.sl_id')
            ->join('inventories', 'inventories.iv_id', '=', 'sale_details.iv_id')
            ->where('sale_details.sl_id', 'LIKE', '%' . $id . '%')
            ->orderBy('sale_details.sl_id', 'asc')
            ->paginate(5);
        return view('sales.show', compact('sl', 'saledetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $sl = Sale::find($id);
        $prd = Product::all();
        $saledetails = DB::table('sale_details')
            ->selectRaw('products.prd_name as name, products.prd_unit as unit, sale_details.sdt_quantity as quantity,
             sale_details.sdt_id ,sale_details.sdt_saleprice as saleprice, sale_details.sdt_totalprice as totalprice')
            ->join('sales', 'sales.sl_id', '=', 'sale_details.sl_id')
            ->join('inventories', 'inventories.iv_id', '=', 'sale_details.iv_id')
            ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
            ->join('products', 'products.prd_id', '=', 'input_details.prd_id')
            ->where('sale_details.sl_id', 'LIKE', '%' . $id . '%')
            ->groupBy(
                'products.prd_name',
                'products.prd_unit',
                'sale_details.sdt_quantity',
                'sale_details.sdt_saleprice',
                'sale_details.sdt_totalprice',
                'sale_details.sdt_id'
            )
            ->get();

        $kho = DB::table('inventories')
            ->selectRaw('inventories.* , products.prd_name as name, products.prd_unit as unit')
            ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
            ->join('products', 'products.prd_id', '=', 'input_details.prd_id')
            ->groupBy(
                'inventories.iv_id',
                'inventories.iv_saleprice',
                'inventories.prd_id',
                'inventories.iv_final',
                'inventories.iv_export',
                'inventories.iv_realexport',
                'inventories.dt_id',
                'inventories.created_at',
                'inventories.updated_at',
                'products.prd_name',
                'products.prd_unit',
                'inventories.iv_inputprice'

            )
            ->get();
        return view('sales.edit', compact('sl', 'prd', 'saledetails', 'kho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sl_vat' => 'required',
            'sl_name' => 'required',
            'sl_date' => 'required',
            'sl_phone' => 'required',
            'sl_addr' => 'required',

        ]);
        $sl = Sale::where('sl_id', '=', $id)
            ->update([
                'sl_vat' => $request->sl_vat,
                'sl_note' => $request->sl_note,
                'sl_name' => $request->sl_name,
                'sl_date' => $request->sl_date,
                'sl_phone' => $request->sl_phone,
                'sl_addr' => $request->sl_addr
            ]);
        return redirect('/phieu-ban-hang/' . $id . '/edit')->with('success', 'Câp nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sl = Sale::find($id);
        $sl->delete();
        return redirect('/phieu-ban-hang')->with('success', 'Đã xóa thành công!');
    }

    //Them phieu chi tiet
    public function storeSaleDetail(Request $request, $id)
    {
        $request->validate([
            'sdt_quantity' => 'required',
            'sdt_saleprice' => 'required',
            'sdt_totalprice' => 'required',
            'sl_id' => 'required',
            'iv_id' => 'required',
        ]);

        $sdt = new Sale_detail();
        $sdt->sl_id = $id;
        $sdt->sdt_quantity = $request->sdt_quantity;
        $sdt->sdt_saleprice = $request->sdt_saleprice;
        $sdt->sdt_totalprice = $request->sdt_totalprice;
        $sdt->iv_id = $request->iv_id;
        $sdt->save();

        $kho = Inventory::where('iv_id', '=', $request->iv_id)->first();
        $kho->iv_export += $request->sdt_quantity;
        $kho->save();
        Sale::where('sl_id', '=', $id)
            ->update([
                'ImportStatus' => 0
            ]);
        return redirect('/phieu-ban-hang/' . $id . '/edit')->with('success', 'Thêm phiếu bán hàng thành công!!!');
    }
    public function destroySaleDetail($sl, $id)
    {
        $sdt = Sale_detail::find($id);
        $sdt->delete();
        return redirect('/phieu-ban-hang/' . $sl . '/edit')->with('success', 'Đã xóa thành công!');
    }

    public function dataInventory(Request $request)
    {
        // $p = Inventory::select('iv_saleprice')->where('iv_id', $request->iv_id)->first();


        $p = DB::table('inventories')
            ->where('iv_id', $request->iv_id)
            ->selectRaw('inventories.* , products.prd_name as name, products.prd_unit as unit')
            ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
            ->join('products', 'products.prd_id', '=', 'input_details.prd_id')
            ->groupBy(
                'inventories.iv_id',
                'inventories.iv_saleprice',
                'inventories.prd_id',
                'inventories.iv_final',
                'inventories.iv_export',
                'inventories.iv_realexport',
                'inventories.dt_id',
                'inventories.created_at',
                'inventories.updated_at',
                'products.prd_name',
                'products.prd_unit',
                'inventories.iv_inputprice'
            )
            ->first();

        // dd($p);
        return response()->json($p);
    }
    public function exportInvetory($id)
    {
        $chiTietPhieuBan = DB::table('sale_details')
            ->where('sale_details.sl_id', '=', $id)
            ->join('inventories', 'inventories.iv_id', '=', 'sale_details.iv_id')
            ->get();

        foreach ($chiTietPhieuBan as $phieuBan) {
            $idKho =  $phieuBan->iv_id;
            $slXuat = $phieuBan->iv_export;
            // dd($idKho);
            $xuatKho = Inventory::where('iv_id', '=', $idKho)->first();
            $xuatKho->iv_realexport = $slXuat;
            $xuatKho->save();
        }
        Sale::where('sl_id', '=', $id)
            ->update([
                'ImportStatus' => 1
            ]);
        return redirect('/phieu-ban-hang/' . $id . '/edit')->with('success', 'Đã xuất kho thành công!');
    }
    public function updateStatus($id)
    {
        $phieuNhapHang = Sale::findOrFail($id); // Tìm kiếm phiếu nhập hàng theo id

        if ($phieuNhapHang->sl_status == 0) {
            $phieuNhapHang->sl_status = 1; // Cập nhật giá trị ip_status
        } else {
            $phieuNhapHang->sl_status = 0; // Cập nhật giá trị ip_status
        }

        $phieuNhapHang->save(); // Lưu thay đổi vào cơ sở dữ liệu

        return redirect()->back(); // Chuyển hướng quay lại trang trước đó
    }
    //Export
    public function export()
    {
        return Excel::download(new saleExport, 'DanhSachBanHang.xlsx');
    }
    //Print
    public function Saleprint($id)
    {
        $printData = DB::table('sale_details')
            ->selectRaw('products.prd_name as name, products.prd_unit as unit, sale_details.sdt_quantity as quantity,
            sales.sl_name as cus_name, sales.sl_addr as address, sale_details.sdt_id ,sale_details.sdt_saleprice as saleprice, 
            sale_details.sdt_totalprice as totalprice, SUM(sale_details.sdt_totalprice) as total')
            ->join('sales', 'sales.sl_id', '=', 'sale_details.sl_id')
            ->join('inventories', 'inventories.iv_id', '=', 'sale_details.iv_id')
            ->join('input_details', 'input_details.dt_id', '=', 'inventories.dt_id')
            ->join('products', 'products.prd_id', '=', 'input_details.prd_id')
            ->where('sale_details.sl_id', 'LIKE', '%' . $id . '%')
            ->groupBy(
                'products.prd_name',
                'products.prd_unit',
                'sale_details.sdt_quantity',
                'sale_details.sdt_saleprice',
                'sale_details.sdt_totalprice',
                'sale_details.sdt_id',
                'sales.sl_name',
                'sales.sl_addr'
            )
            ->get();


        $printSale = DB::table('sales')->where('sales.sl_id', $id)->first();

        $printSum = DB::table('sale_details')
            ->selectRaw('SUM(sale_details.sdt_totalprice) as total')
            ->where('sale_details.sl_id', $id)->first();

        // dd($printSum);
        $printUer = DB::table('users')->first();
        $pdf = Pdf::loadView('sales/print', compact('printData', 'printSale', 'printSum', 'printUer'));

        return $pdf->download('HoaDonBanHang.pdf');
    }
    public function searchSales(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $data = DB::table('sales')->select()
            ->orderBy('sales.sl_id', 'asc')
            ->where('sl_date', '>=', $fromDate)
            ->where('sl_date', '<=', $toDate)
            ->paginate(5);

        return view('sales.search', compact('data', 'fromDate', 'toDate'));
    }
}
