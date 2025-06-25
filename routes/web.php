<?php
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\TransferController;
use App\Http\Controllers\Web\WithdrawController;
use App\Http\Controllers\Web\DepositController;
use App\Http\Controllers\Web\TransactionController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' => ['guest'], 'namespace' => 'Web'], function() {

     Route::get('/', [HomeController::class, 'index'])->name('login');  
      Route::get('/register', [HomeController::class, 'register'])->name('register-user');  
      Route::post('/registerCustomer', [CustomerController::class, 'registerCustomer'])->name('customer.register');  
      Route::get('/loginCustomer', [CustomerController::class, 'customerLogin'])->name('customer-login');  
      Route::get('/customerHome', [CustomerController::class, 'customerHome'])->name('customer-home'); 
      Route::get('/logout',[CustomerController::class, 'logout'])->name('logout');
      Route::get('/customerDeposit', [CustomerController::class, 'customerDeposit'])->name('customer-deposit');
      Route::get('/customerWithdraw', [WithdrawController::class, 'customerWithdraw'])->name('customer-withdraw'); 
      Route::get('/customerTransfer', [TransferController::class, 'customerTransfer'])->name('customer-transfer');
      Route::get('/customerStatement', [TransactionController::class, 'customerStatement'])->name('customer-statement');
      Route::post('/add-customer-withdraw', [WithdrawController::class, 'withdrawAmount'])->name('add-customer-withdraw');
      Route::post('/add-customer-deposit', [DepositController::class, 'addDeposit'])->name('add-customer-deposit');
      Route::post('/add-customer-transfer', [TransferController::class, 'transferAmount'])->name('add-customer-transfer');
 



     
});

