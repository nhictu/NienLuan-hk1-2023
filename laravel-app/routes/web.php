<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\InputController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


Route::get('/', [LoginController::class, 'login']);
Route::post('/dang-nhap', [LoginController::class, 'loginUser'])->name('dang-nhap');
Route::get('/dang-ki', [LoginController::class, 'register'])->middleware('alreadyLoggedIn');
// Route::get('/dang-ki', [LoginController::class, 'register']);
Route::post('/register-user', [LoginController::class, 'registerUser'])->name('register-user');

// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware(['isLoggedIn'])->group(function () {

    // Route::get('/homepage', function () { // Trang chu
    //     $data = DB::table('sales')
    //         ->orderBy('sales.sl_id', 'asc')
    //         ->paginate(5);
    //     // dd($data);
    //     return view('sales.index', compact('data'));
    // });
    // Route::get('/phieu-nhap-hang', [LoginController::class, 'getName']);

    // Danh sach san pham
    Route::resource('/products', ProductController::class);
    Route::get('/productsExport', [ProductController::class, 'export'])->name('productsExport');
    //Danh sach nha cung cap
    Route::resource('/suppliers', SupplierController::class);
    Route::get('/suppliersExport', [SupplierController::class, 'export'])->name('suppliersExport');
    //Danh sach phieu nhap hang
    Route::resource('/phieu-nhap-hang', InputController::class);
    Route::any('/phieu-nhap-hang/search', [InputController::class, 'search'])->name('search');
    Route::post('/phieu-nhap-hang/{ip_id}/delete', [InputController::class, 'destroyEdit']);
    Route::post('/phieu-nhap-hang/{ip_id}/status', [InputController::class, 'updateStatus']); // cập thật trạng thái thanh toán
    //Chi tiet phieu nhap hang
    Route::post('/phieu-nhap-hang/{ip_id}/create', [InputController::class, 'storeInputDetail']);
    Route::delete('/phieu-nhap-hang/{ip_id}/{dt_id}/delete', [InputController::class, 'destroyInputDetail']);
    Route::get('/finddata', [InputController::class, 'dataProduct']);
    Route::post('/phieu-nhap-hang/{ip_id}/add', [InputController::class, 'storeInventory']);
    Route::get('/inputExport', [InputController::class, 'export'])->name('inputExport');

    
    //Danh sach phieu ban hang
    Route::resource("/phieu-ban-hang", SaleController::class);
    Route::post('/phieu-ban-hang/{sl_id}/create', [SaleController::class, 'storeSaleDetail']);
    Route::delete('/phieu-ban-hang/{sl_id}/{sdt_id}/delete', [SaleController::class, 'destroySaleDetail']);
    Route::put('/phieu-ban-hang/{sl_id}/export', [SaleController::class, 'exportInvetory']);
    Route::get('/findsaledata', [SaleController::class, 'dataInventory']);
    Route::post('/phieu-ban-hang/{sl_id}/status', [SaleController::class, 'updateStatus']); // cập thật trạng thái thanh toán
    Route::get('/inputExport', [InputController::class, 'export'])->name('inputExport');
    Route::get('/saleExportExcel', [SaleController::class, 'export'])->name('saleExportExcel');
    Route::get('/phieu-ban-hang/{sl_id}/print', [SaleController::class, 'Saleprint']);
    Route::any('/phieu-ban-hang/search', [SaleController::class, 'searchSales'])->name('searchSales');
    Route::post('/salereport/search', [ReportController::class, 'search'])->name('search');
});
