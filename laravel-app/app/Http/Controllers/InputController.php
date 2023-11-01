<?php

namespace App\Http\Controllers;

use App\Exports\inputExport;
use App\Models\Input;
use App\Models\Input_detail;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('inputs')
            ->join('suppliers', 'suppliers.sp_id', '=', 'inputs.sp_id')
            ->orderBy('inputs.created_at', 'asc')
            ->paginate(5);

        return view('inputs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $prd = Product::all();

        return view('inputs.create', compact('supplier', 'prd'));
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
            'ip_bill' => 'required',
            'ip_vat' => 'required',
            'ip_dateinput' => 'required',
            'ip_datecreate' => 'required',
            'sp_id' => 'required',
            'ip_status' => 'required',
        ]);
        $ip = new Input();
        $ip->ip_bill = $request->ip_bill;
        $ip->ip_vat = $request->ip_vat;
        $ip->ip_dateinput = $request->ip_dateinput;
        $ip->ip_datecreate = $request->ip_datecreate;
        $ip->ip_status = $request->ip_status;
        $ip->sp_id = $request->sp_id;
        $ip->save();


        return redirect('/phieu-nhap-hang/create')->with('success', 'Thêm phiếu nhập hàng thành công!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ip = Input::where('ip_id', $id)
            ->join('suppliers', 'suppliers.sp_id', '=', 'inputs.sp_id')
            ->first();

        $inputdetail = DB::table('input_details')
            ->join('inputs', 'inputs.ip_id', '=', 'input_details.ip_id')
            ->join('products', 'products.prd_id', '=', 'input_details.prd_id')
            ->where('input_details.ip_id', 'LIKE', '%' . $id . '%')
            ->orderBy('input_details.dt_id', 'asc')
            ->paginate(5);

        $dt = DB::table('input_details')
            // ->select('dt_id')
            ->where('input_details.ip_id', '=', $id)
            ->get();
        // dd($inputdetail);
        return view('inputs.show', compact('ip', 'inputdetail', 'dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ip = Input::find($id);
        $supplier = Supplier::all();
        $prd = Product::all();
        $inputdetail = DB::table('input_details')
            ->join('inputs', 'inputs.ip_id', '=', 'input_details.ip_id')
            ->join('products', 'products.prd_id', '=', 'input_details.prd_id')
            ->where('input_details.ip_id', 'LIKE', '%' . $id . '%')
            ->orderBy('input_details.dt_id', 'asc')
            ->paginate(5);
        $date = Carbon::now()->addYears(2);
        return view('inputs.edit', compact('ip', 'supplier', 'prd', 'inputdetail', 'date'));
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
            'ip_bill' => 'required',
            'ip_vat' => 'required',
            'ip_dateinput' => 'required',
            'ip_datecreate' => 'required',
            'ip_status' => 'required',
            'sp_id' => 'required',
        ]);
        $ip = Input::where('ip_id', '=', $id)
            ->update([
                'ip_bill' => $request->ip_bill,
                'ip_vat' => $request->ip_vat,
                'ip_dateinput' => $request->ip_dateinput,
                'ip_datecreate' => $request->ip_datecreate,
                'ip_status' => $request->ip_status,
                'sp_id' => $request->sp_id
            ]);
        return redirect('/phieu-nhap-hang/' . $id . '/edit')->with('success', 'Cập nhật thành công!');
    }

    /**s
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ip = Input::find($id);
        $ip->delete();
        return redirect('/phieu-nhap-hang')->with('success', 'Đã xóa thành công!');
    }


    public function dataProduct(Request $request)
    {
        $p = Product::select('prd_inputprice', 'prd_saleprice', 'prd_unit')->where('prd_id', $request->prd_id)->first();


        return response()->json($p);
    }

    public function storeInputDetail(Request $request, $id)
    {
        $request->validate([
            'dt_quantity' => 'required',
            'dt_unit' => 'required',
            'dt_lotnumber' => 'required',
            'dt_expried' => 'required',
            'dt_vat' => 'required',
            'dt_inputprice' => 'required',
            'dt_saleprice' => 'required',
            'prd_id' => 'required',
            'ip_id' => 'required',
        ]);

        $dt = new Input_detail();

        $x = $request->dt_vat;
        $y = $request->dt_quantity;

        $dt->ip_id = $id;
        $dt->dt_quantity = $request->dt_quantity;
        $dt->dt_unit = $request->dt_unit;
        $dt->dt_lotnumber = $request->dt_lotnumber;
        $dt->dt_expried = $request->dt_expried;
        $dt->dt_vat = $request->dt_vat;
        $dt->dt_inputprice = $request->dt_inputprice;
        $dt->dt_saleprice = $request->dt_saleprice;
        $dt->dt_totalprice = $x * $y;
        $dt->prd_id = $request->prd_id;
        $dt->ip_id = $request->ip_id;
        $dt->save();
        return redirect('/phieu-nhap-hang/' . $id . '/edit')->with('success', 'Thêm phiếu nhập hàng thành công!!!');
    }
    public function destroyInputDetail($ip, $id)
    {
        $dt = Input_detail::find($id);
        $dt->delete();
        return redirect('/phieu-nhap-hang/' . $ip . '/edit')->with('success', 'Đã xóa thành công!');
    }
    //Inventory
    public function storeInventory(Request $request, $id)
    {
        // 
        $chiTietPhieuNhap = DB::table('input_details')
            ->where('input_details.ip_id', '=', $id)
            ->get();
        if ($chiTietPhieuNhap->count() > 0) {
            Input::where('ip_id', '=', $id)
                ->update([
                    'ip_status' => 0 // cập nhật trạng thái thanh toán
                ]);

            $total = 0;

            foreach ($chiTietPhieuNhap as $phieuNhap) {
                $idSanPham = $phieuNhap->prd_id;
                $donGiaBan = $phieuNhap->dt_saleprice;
                $soLuongNhap = $phieuNhap->dt_quantity;
                $idCTPN = $phieuNhap->dt_id;
                $donGiaNhap = $phieuNhap->dt_inputprice;
                $donGiaVAT = $phieuNhap->dt_vat;

                $total += ($soLuongNhap * $donGiaVAT);

                $tonKho = Inventory::where('prd_id', $idSanPham)
                    ->where('iv_saleprice', $donGiaBan)
                    ->first();

                // Tăng số lượng tồn
                $tonKho = new Inventory();
                $tonKho->dt_id = $idCTPN;
                $tonKho->prd_id = $idSanPham;
                $tonKho->iv_saleprice = $donGiaBan;
                $tonKho->iv_final = $soLuongNhap;
                $tonKho->iv_inputprice = $donGiaNhap;
                // $tonKho->iv_begin = $soLuongNhap;
                // $tonKho->iv_begin = $soLuongNhap;
                $tonKho->save();
                // dd($tonKho);
            }

            Input::where('ip_id', '=', $id)
                ->update([
                    'total' => $total,
                    'ImportStatus' => 1
                ]);
            return redirect('/phieu-nhap-hang/' . $id . '/edit')->with('success', 'Nhập hàng thành công!!!');
        }
        return redirect('/phieu-nhap-hang/' . $id . '/edit')->with('error', 'Nhập hàng không được trống');
    }
    public function updateStatus($id)
    {
        $phieuNhapHang = Input::findOrFail($id); // Tìm kiếm phiếu nhập hàng theo id

        if ($phieuNhapHang->ip_status == 0) {
            $phieuNhapHang->ip_status = 1; // Cập nhật giá trị ip_status
        } else {
            $phieuNhapHang->ip_status = 0; // Cập nhật giá trị ip_status
        }

        $phieuNhapHang->save(); // Lưu thay đổi vào cơ sở dữ liệu

        return redirect()->back(); // Chuyển hướng quay lại trang trước đó
    }
    //xóa nhập
    public function destroyEdit($id)
    {
        $chiTietPhieuNhaps = DB::table('input_details')
            ->where('input_details.ip_id', '=', $id)
            ->get();

        $prodIds = collect($chiTietPhieuNhaps)->pluck('prd_id')->toArray();
        $inventories = DB::table('inventories')
            ->whereIn('prd_id', $prodIds)
            ->get();

        $isExists = collect($inventories)->contains(function ($item) {
            return $item->iv_export !== 0 || $item->iv_realexport !== 0;
        });
        // dd($isExists);
        if ($isExists) {
            return redirect('/phieu-nhap-hang/' . $id . '/edit')->with('error', 'Không được xóa vì có sản phẩm đã bán');
        } else {
            $chiTietPhieuNhaps = DB::table('input_details')
                ->where('input_details.ip_id', '=', $id)
                ->get();

            foreach ($chiTietPhieuNhaps as $chiTietPhieuNhap) {
                Inventory::where('dt_id', $chiTietPhieuNhap->dt_id)->first()->delete();
                Input::where('ip_id', '=', $id)
                    ->update([
                        'total' => 0,
                        'ImportStatus' => 0
                    ]);
            }
            return redirect('/phieu-nhap-hang/' . $id . '/edit');
        }
    }

    //search
    public function search(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        $data = DB::table('inputs')->select()
            ->join('suppliers', 'suppliers.sp_id', '=', 'inputs.sp_id')
            ->orderBy('inputs.ip_id', 'asc')
            ->where('ip_dateinput', '>=', $fromDate)
            ->where('ip_dateinput', '<=', $toDate)
            ->paginate(5);

        return view('inputs.search', compact('data', 'fromDate', 'toDate'));
    }
    public function export()
    {
        return Excel::download(new inputExport, 'DanhSachPhieuNhapHang.xlsx');
    }
}
