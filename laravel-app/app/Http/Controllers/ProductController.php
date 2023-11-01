<?php

namespace App\Http\Controllers;

use App\Exports\productsExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('products')->orderBy('prd_id', 'asc')->paginate(5);
        return view('products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'prd_name' => 'required',
            'prd_unit' => 'required',
            'prd_inputprice' => 'required',
            'prd_saleprice' => 'required',
            'prd_desc' => 'required'
        ]);
        $prd = new Product();
        $prd->prd_name = $request->prd_name;
        $prd->prd_unit = $request->prd_unit;
        $prd->prd_inputprice = $request->prd_inputprice;
        $prd->prd_saleprice = $request->prd_saleprice;
        $prd->prd_desc = $request->prd_desc;

        $prd->save();
        return redirect('/products/create')->with('success', 'Thêm sản phẩm thành công!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prd = Product::find($id);

        return view('products.edit')->with('prd', $prd);
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
            'prd_name' => 'required',
            'prd_unit' => 'required',
            'prd_inputprice' => 'required',
            'prd_saleprice' => 'required',
            'prd_desc' => 'required'
        ]);
        $prd = Product::where('prd_id', '=', $id)
            ->update([
                'prd_name' => $request->prd_name,
                'prd_unit' => $request->prd_unit,
                'prd_inputprice' => $request->prd_inputprice,
                'prd_saleprice' => $request->prd_saleprice,
                'prd_desc' => $request->prd_desc
            ]);
        return redirect('/products')->with('success', 'Câp nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $kho = DB::table('inventories')->where('inventories.prd_id', '=', $id)->get();

        $isExists = collect($kho)->contains(function ($item) {
            return $item->iv_final > 0;
        });

        if ($isExists) {
            return redirect('/products')->with('error', 'Không được xóa vì sản phẩm này đã nhập hàng');
        } else {
            $prd = Product::find($id);
            $prd->delete();
            return redirect('/products')->with('success', 'Đã xóa thành công!');
        }
        // dd($kho);
        // $prd = Product::find($id);
        // $prd->delete();
        // return redirect('/products')->with('success', 'Đã xóa thành công!');
    }
    //export
    public function export()
    {
        return Excel::download(new productsExport, 'productsExport.xlsx');
    }
}
