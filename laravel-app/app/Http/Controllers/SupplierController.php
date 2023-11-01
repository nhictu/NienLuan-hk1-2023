<?php

namespace App\Http\Controllers;

use App\Exports\suppliersExport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('suppliers')->orderBy('sp_id', 'asc')->paginate(5);
        return view('suppliers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
            'sp_name' => 'required',
            'sp_contact' => 'required',
            'sp_phone' => 'required',
            'sp_addr' => 'required',
        ]);
        $sp = new Supplier();
        $sp->sp_name = $request->sp_name;
        $sp->sp_contact = $request->sp_contact;
        $sp->sp_phone = $request->sp_phone;
        $sp->sp_addr = $request->sp_addr;

        $sp->save();
        return redirect('/suppliers/create')->with('success', 'Thêm nhà cung cấp thành công!!!');
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
        $sp = Supplier::find($id);

        return view('suppliers.edit')->with('sp', $sp);
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
            'sp_name' => 'required',
            'sp_contact' => 'required',
            'sp_phone' => 'required',
            'sp_addr' => 'required',
        ]);
        $sp = Supplier::where('sp_id', '=', $id)
            ->update([
                'sp_name' => $request->sp_name,
                'sp_contact' => $request->sp_contact,
                'sp_phone' => $request->sp_phone,
                'sp_addr' => $request->sp_addr,
            ]);
        return redirect('/suppliers')->with('success', 'Câp nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nhaCungCap = DB::table('inputs')->where('inputs.sp_id', '=', $id)->first();

        // dd($nhaCungCap);

        // $isExists = collect($kho)->contains(function ($item) {
        //     return $item->iv_final > 0;
        // });

        if ($nhaCungCap) {
            return redirect('/suppliers')->with('error', 'Không được xóa vì đã nhập hàng từ nhà cung cấp này!');
        } else {
            $sp = Supplier::find($id);
            $sp->delete();
            return redirect('/suppliers')->with('success', 'Đã xóa thành công!');
        }
    }
    //export
    public function export()
    {
        return Excel::download(new suppliersExport, 'suppliersExport.xlsx');
    }
}
