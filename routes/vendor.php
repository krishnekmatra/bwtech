<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InquiryController;

Route::group(['prefix' => 'vendor'], function(){

	Route::group(['middleware' => 'vendor-guest'], function () {
		Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('Vendor.login');
		Route::post('login', [AuthenticatedSessionController::class, 'store']);
	});
	
	Route::group(['middleware' => 'vendor-auth'], function () {
		 Route::get('dashboard',[VendorController::class,'dashboard'])->name('VendorDashboard');
	
		// Route::get('/', function () {
		// 	return redirect('vendor/dashboard');
		// })->name('VendorDashboard');

		Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
				->name('vendor.logout');
		});

		Route::get('products',[ProductController::class,'index'])->name('product.index');

		Route::get('product/add',[ProductController::class,'create'])->name('product.create');
		Route::post('product/store',[ProductController::class,'store'])->name('product.store');
		Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
	
		Route::get('inquiry',[InquiryController::class,'inquirylist'])->name('inquiry.list');

		Route::get('product/image',[ProductController::class,'productImage'])->name('productimagevendor');
Route::post('product/image/remove',[ProductController::class,'productImageRemove'])->name('productimageremovevendor');
		Route::post('product/image',[ProductController::class,'saveImage'])->name('saveimagevendor');
		Route::post('import',[ProductController::class,'import'])->name('importvendor');


		//exportdata
		Route::get('product-sample-download',[ProductController::class,'ProductSampleDownload'])->name('productsampledownloadvendor');
		Route::get('product-import',[ProductController::class,'ProductImport'])->name('productimportvendor"');

  });

?>