<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\OccasionsController;
use App\Http\Controllers\BannerController;

use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\WeAreHiringController;

use App\Http\Controllers\VacencyRequirementsController;


Route::group(['prefix' => 'admin'], function(){
	Route::group(['middleware' => 'admin-guest'], function () {
		Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
		Route::post('login', [AuthenticatedSessionController::class, 'store']);
		
	});
	
	Route::group(['middleware' => 'admin-auth'], function () {
		 Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
	
		Route::get('/', function () {
			return redirect('admin/dashboard');
		})->name('admindashboard');

		Route::get('customers',[VendorController::class,'customerList'])->name('customer.customerList');

		Route::get('users',[VendorController::class,'index'])->name('vendor.index');

		Route::get('user/add',[VendorController::class,'create'])->name('vendor.create');

		Route::post('user/store',[VendorController::class,'store'])->name('vendor.store');
		Route::get('user/edit/{id}',[VendorController::class,'edit'])->name('vendor.edit');
		Route::post('user/status-change',[VendorController::class,'statusChange'])->name('vendorstatus-change');
		Route::post('user/product-status-change',[VendorController::class,'productStatusChange'])->name('vendor-product-status-change');


		//feature
		Route::get('features',[FeatureController::class,'index'])->name('feature.index');
		Route::get('feature/add',[FeatureController::class,'create'])->name('feature.create');

		Route::post('feature/store',[FeatureController::class,'store'])->name('feature.store');
		Route::get('feature/edit/{id}',[FeatureController::class,'edit'])->name('feature.edit');
		Route::delete('feature/{id}', [FeatureController::class,'destroy'])->name('feature.delete');
		Route::post('feature/update',[FeatureController::class,'update'])->name('feature.update');


		Route::get('categories',[CategoryController::class,'index'])->name('category.index');

		Route::get('category/add',[CategoryController::class,'create'])->name('category.create');
		Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
		Route::delete('category/{id}', [CategoryController::class,'destroy'])->name('category.delete');
		Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
		Route::post('category/status-change',[CategoryController::class,'categoryStatusChange'])->name('categorystatus-change');

		//sub category
		Route::get('category/{id}/sub-cat',[SubCategoryController::class,'index'])->name('subcategory.index');
		Route::get('category/{id}/sub-cat/add',[SubCategoryController::class,'create'])->name('subcategory.add');
		Route::post('category/sub-cat/store',[SubCategoryController::class,'store'])->name('subcategory.store');
		Route::get('category/sub-cat/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
		Route::post('category/sub-cat/update/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');
		Route::delete('subcategory/{id}', [SubCategoryController::class,'destroy'])->name('subcategory.destroy');


		//Product
		Route::get('products',[ProductController::class,'index'])->name('product-index');
		Route::get('product/add',[ProductController::class,'create'])->name('product-create');
		Route::post('product/store',[ProductController::class,'store'])->name('product-store');
		Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('product-edit');
		Route::post('product/status-change',[ProductController::class,'statusChange'])->name('status-change');

		Route::get('product/image',[ProductController::class,'productImage'])->name('productimage');

		Route::post('product/image',[ProductController::class,'saveImage'])->name('saveImage');
		Route::post('product/image/remove',[ProductController::class,'productimageremove'])->name('productImageRemove');
		Route::post('import',[ProductController::class,'import'])->name('import');
		Route::post('product/remove',[ProductController::class,'productRemove'])->name('productRemove');
		Route::post('product/subCategoryFeatures',[ProductController::class,'subCategoryFeatures'])->name('product.subCategoryFeatures');



		//exportdata
		Route::post('ProductEditExport',[ProductController::class,'ProductEditExport'])->name(
			'ProductEditExport');

		Route::get('product-sample-download-subcat/{id}',[ProductController::class,'ProductSampleDownload'])->name('Productsamplesownload');
		Route::get('product-import',[ProductController::class,'ProductImport'])->name('Productimport"');
		Route::post('product/changeStatus',[ProductController::class,'changeStatus'])->name('product.changeStatus');

		Route::get('deals',[DealController::class,'index'])->name('deal.index');
		Route::get('product/deal/{id}',[DealController::class,'productDeals'])->name('product.deal');
		Route::post('product/deal-save',[DealController::class,'dealSave'])->name('product.deal.save');


		Route::get('deal/add',[DealController::class,'create'])->name('deal.create');
		Route::post('deal/store',[DealController::class,'store'])->name('deal.store');
		Route::get('deal/edit/{id}',[DealController::class,'edit'])->name('deal.edit');
		Route::delete('deal/{id}', [DealController::class,'destroy'])->name('deal.delete');

		Route::get('occasions',[OccasionsController::class,'index'])->name('occasions.index');
		Route::get('occasion/add',[OccasionsController::class,'create'])->name('occasion.create');
		Route::post('occasion/store',[OccasionsController::class,'store'])->name('occasion.store');
		Route::get('occasion/edit/{id}',[OccasionsController::class,'edit'])->name('occasion.edit');
		Route::delete('occasion/{id}', [OccasionsController::class,'destroy'])->name('occasion.delete');
		Route::get('product/occasion/{id}',[OccasionsController::class,'occasionDeals'])->name('product.occasion');
		Route::post('product/occasion-save',[OccasionsController::class,'occasionSave'])->name('product.occasion.save');

		Route::get('banners',[BannerController::class,'index'])->name('banners.index');
		Route::get('banner/add',[BannerController::class,'create'])->name('banner.create');
		Route::post('banner/store',[BannerController::class,'store'])->name('banner.store');
		Route::get('banner/edit/{id}',[BannerController::class,'edit'])->name('banner.edit');
		Route::delete('banner/{id}', [BannerController::class,'destroy'])->name('banner.delete');

		Route::get('inquiry',[InquiryController::class,'inquirylist'])->name('inquirylist');
		Route::get('inquiry/view/{id}',[InquiryController::class,'inquiryview'])->name('inquiryview');
		Route::get('rfq',[InquiryController::class,'rfqlist'])->name('rfqlist');


		Route::get('contact-us/add',[ContactUsController::class,'addContactUs'])->name('contactus.add');

		Route::post('contact-us/store',[ContactUsController::class,'contactusSave'])->name('contactusSave');

		Route::get('faqs',[FaqController::class,'index'])->name('faq.list');
		Route::get('faq/add',[FaqController::class,'create'])->name('faq.add');
		Route::post('faq/store',[FaqController::class,'store'])->name('faq.save');
		Route::get('faq/edit/{id}',[FaqController::class,'edit'])->name('faq.edit');
		Route::delete('faq/{id}', [FaqController::class,'destroy'])->name('faq.delete');

		Route::get('we-are-hirings',[WeAreHiringController::class,'index'])->name('weAreHiring.list');
		Route::get('we-are-hiring/add',[WeAreHiringController::class,'create'])->name('weAreHiring.add');
		Route::post('we-are-hiring/store',[WeAreHiringController::class,'store'])->name('weAreHiring.save');
		Route::get('we-are-hiring/edit/{id}',[WeAreHiringController::class,'edit'])->name('weAreHiring.edit');
		Route::delete('we-are-hiring/{id}', [WeAreHiringController::class,'destroy'])->name('weAreHiring.delete');

		Route::get('job-post',[VacencyRequirementsController::class,'index'])->name('jobpost.index');
		Route::get('subscription/list',[VacencyRequirementsController::class,'subscriptionList'])->name('subscription.list');
		Route::get('leads',[ContactUsController::class,'leads'])->name('leads');
		Route::get('job-post/download/{id}',[VacencyRequirementsController::class,'jobDownload'])->name('jobpost.download');
		Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
				->name('admin.logout');
		});
	
  });

?>