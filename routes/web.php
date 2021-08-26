<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\Transaction;
use PhpParser\Node\Expr\FuncCall;

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

Route::get('/', function () {
    return view('auth.login');
});



require __DIR__.'/auth.php';


Route::group(['middleware'=>['CheckUser']],function(){
    

    Route::get('/admin/dashboard',[AdminController::class,'index'])->middleware(['auth'])->name('dashboard');
    
    // Route for user--------------------------------------------------------------------------------

    Route::get('/admin/users',[UserController::class,'index']);
    Route::get('/admin/users/add',[UserController::class,'add']);
    Route::get('/admin/users/view/{slug}',[UserController::class,'view']);
    Route::get('/admin/users/edit/{slug}',[UserController::class,'edit']);
    Route::post('/admin/users/update',[UserController::class,'update']);
    Route::get('/admin/users/soft-delete/{slug}',[UserController::class,'soft_delete']);
    Route::post('/admin/users/submit',[UserController::class,'insert']);
    Route::get('/admin/restore/users',[UserController::class,'trash_user']);
    Route::get('/admin/restore/users/{slug}',[UserController::class,'restore_user']);
    Route::get('/admin/restore/users/delete/{slug}',[UserController::class,'destroy']);


    // End Route for user--------------------------------------------------------------------------------


    // For product===================================================================================

    Route::get('/admin/products',[ProductController::class,'index']);
    Route::get('/admin/products/view/{slug}',[ProductController::class,'view']);
    Route::get('/admin/products/edit/{slug}',[ProductController::class,'edit']);
    Route::post('/admin/products/update',[ProductController::class,'update']);
    Route::get('/admin/products/soft-delete/{slug}',[ProductController::class,'soft_delete']);
    Route::get('/admin/barcode',[ProductController::class,'barcode']);
    Route::get('/admin/restore/products',[ProductController::class,'trash_product']);
    Route::get('/admin/restore/products/{slug}',[ProductController::class,'restore_product']);
    Route::get('/admin/restore/products/delete/{slug}',[ProductController::class,'destroy']);


    // end Product=====================================================================================

    // Transactions Routes--------------------------------------------------------------------------

    Route::get('/admin/transactions',[TransactionController::class,'index']);
    Route::get('/admin/transactions/download',[TransactionController::class,'downloadPDF']);

    // End Transactions Route------------------------------------------------------------------------


    // Restore Routes--------------------------------------------------------------------------------

    Route::view('/admin/restore', 'admin.restore.index');

    // End Restore Route-----------------------------------------------------------------------------
    
    // Order Details Routes--------------------------------------------------------------------------

    Route::get('/admin/reports',[OrderDetailController::class,'get_report']);
    Route::post('/admin/reports/check',[OrderDetailController::class,'check_report']);
    Route::get('/admin/reports/check/today',[OrderDetailController::class,'todays_report']);
    Route::get('/admin/reports/daily/download/{date}',[OrderDetailController::class,'daily_downloadPDF']);
    Route::get('/admin/reports/monthly/download/{month}/{year}',[OrderDetailController::class,'monthly_downloadPDF']);
    Route::get('/admin/reports/yearly/download/{year}',[OrderDetailController::class,'yearly_downloadPDF']);


    // End Order Details Route----------------------------------------------------------------------

    // Supplier Routes----------------------------------------------------------------------------------

    Route::get('/admin/suppliers',[SupplierController::class,'index']);
    Route::get('/admin/suppliers/create',[SupplierController::class,'create']);
    Route::post('/admin/suppliers/submit',[SupplierController::class,'store']);
    Route::get('/admin/suppliers/view/{slug}',[SupplierController::class,'view']);
    Route::get('/admin/suppliers/edit/{slug}',[SupplierController::class,'edit']);
    Route::post('/admin/suppliers/update',[SupplierController::class,'update']);
    Route::get('/admin/suppliers/soft-delete/{slug}',[SupplierController::class,'soft_delete']);
    Route::get('/admin/restore/suppliers',[SupplierController::class,'trash_supplier']);
    Route::get('/admin/restore/suppliers/{slug}',[SupplierController::class,'restore_supplier']);
    Route::get('/admin/restore/suppliers/delete/{slug}',[SupplierController::class,'destroy']);


    // End Supplier Route-----------------------------------------------------------------------------------

});
// Route for product insert start-------------------------------------------------------------------------

Route::get('/admin/products/create',[ProductController::class,'create']);
Route::post('/admin/products/submit',[ProductController::class,'store']);

// Route for product insert end-------------------------------------------------------------------------

// Route::get('/admin/users/view/{slug}',[UserController::class,'view']);
Route::get('/admin/profile/user_profile/{slug}',[UserController::class,'user_profile']);
// Route::get('/admin/users/edit/{slug}',[UserController::class,'edit']);
Route::get('/admin/profile/edit_user_password/{slug}',[UserController::class,'edit_user_password']);
Route::get('/admin/profile/edit_user_profile/{slug}',[UserController::class,'edit_user_profile']);
// Route::post('/admin/users/update',[UserController::class,'update']);
Route::post('/admin/profile/profile_update',[UserController::class,'profile_update']);
Route::post('/admin/profile/password_update',[UserController::class,'password_update']);
// For Orders===================================================================================

Route::get('/admin/orders',[OrderController::class,'index']);
Route::post('/admin/orders/submit',[OrderController::class,'store']);
Route::get('/admin/cashier/receipt',[OrderController::class,'get_last_order_details']);
Route::get('/admin/cashier/receipt/download',[OrderController::class,'downloadPDF']);

// End Orders====================================================================================


