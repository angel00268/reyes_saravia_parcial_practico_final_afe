<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('generateSummary/{id}', [PDFController::class, 'generateSummary']);

    Route::resource('api/supplier', SupplierController::class);
    Route::resource('api/document', DocumentController::class);
    Route::resource('api/bank', BankController::class);

    Route::resource('api/auditores', UserController::class);
    Route::resource('api/productos', ProductController::class);


    Route::get('/suppliers', function () {
        return view('supplier.index');
    })->name('supp.index');

    Route::get('/documents', function () {
        return view('document.index');
    });

    Route::get('/banks', function () {
        return view('bank.index');
    });

    Route::get('/productos', function () {
        return view('product.index');
    });

    Route::get('/auditores', function () {
        return view('auditor.index');
    })->middleware('can_view:user');

    Route::get('/reports', function () {
        return view('reports');
    });

    Route::get('/summary', function () {
        return view('summary.index');
    });

    /*Landing Page para Reportes*/
    Route::get('/landing',[PDFController::class,'index'])->name('landing.index');
    Route::get('/productsReportsAuditor', [PDFController::class, 'auditorReport']);
    Route::get('/productsReportsVendedor/{id}', [PDFController::class, 'vendedorReport']);
    Route::get('/sellerReports', [PDFController::class, 'sellerReport']);    
    Route::get('/paramReport/{id}', [PDFController::class, 'parametrizadoReport'])->name('PDF.param');    

});


Auth::routes(['reset'=>false]);
