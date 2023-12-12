<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [FrontendController::class, 'homepage']);
Route::get('/category/{slug}', [FrontendController::class, 'categorywiseProduct'])->name('category.products');
Route::get('/product/{slug}', [FrontendController::class, 'productDetails'])->name('product.details');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FrontendController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/add-to-cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/my-cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/place-order', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('orders.success');
});

Route::get('/users', function () {
    return view('backend.users');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('backend.dashboard');
    });

    // Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    // Route::get('/categories/create',[ CategoryController::class, 'create'])->name('categories.create');
    // Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    // Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    // Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    // Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    // Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');

    Route::resource('categories', CategoryController::class);

    Route::get('/products',[ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create',[ProductController::class, 'create'])->name('products.create');
    Route::post('/product_store',[ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::post('/update/{id}',[ProductController::class, 'update'])->name('product.update');

    // report
    Route::get('/category_pdf_report',[ReportController::class, 'categoryReport'])->name('category.report');
    Route::get('/category_excel_report',[ReportController::class, 'categoryExcelReport'])->name('category.excel_report');

    Route::get('/category_wise_product/{id}',[FrontendController::class, 'categoryWiseProduct'])->name('categorywiseproduct');
});

require __DIR__.'/auth.php';





