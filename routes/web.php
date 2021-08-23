<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\SeederController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\Admin\IndexController as AIndexController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\CostsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\EmployeesController;
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
Route::get('/seeder', [SeederController::class, 'index'])->name('seeder');
Route::resource('/', IndexController::class)->only(['index', 'store']);
Route::get('/basket/index/{product_id?}', [BasketController::class, 'index'])->name('basketIndex');
Route::get('/contacts',[ContactsController::class, 'index'])->name('contacts');
Route::post('/basket/order', [BasketController::class, 'order'])->name('makeOrder');

Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/', [AIndexController::class, 'index'])->name('adminIndex');

    Route::get('/income', [IncomeController::class, 'index'])->name('admin_income_index');
    Route::get('/costs', [CostsController::class, 'index'])->name('admin_costs_index');

    Route::resource('employees', EmployeesController::class)->names([
        'index' => 'admin_employees_index',
    ]);
    Route::resource('orders', OrdersController::class)->names([
        'index' => 'admin_orders_index',
    ]);
    Route::resource('clients', ClientsController::class)->names([
        'index' => 'admin_clients_index',
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
