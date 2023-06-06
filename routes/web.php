<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\InquiryController;

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\VacencyRequirementsController;


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




require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/vendor.php';


// Route::get('/', function(){

//     return view('comingsoon');
// });


Route::get('/',[WelcomeController::class, 'index'])->name('index');

//Shop page
Route::get('shop/product',[ShopController::class, 'productList'])->name('productallshop');

Route::get('shop/{category}',[ShopController::class, 'index'])->name('shopindex');
Route::get('shop/{category}/{subcategory}',[ShopController::class, 'subCategoryList'])->name('subcategory.list');
Route::post('filter-result',[ShopController::class, 'filterResult'])->name('filterResult');

Route::get('search',[ShopController::class, 'searchProduct'])->name('searchProduct');
Route::get('shop-by/{type}/{value}',[GiftController::class,'index'])->name('shopbyproduct');
Route::post('shopByFilter',[GiftController::class,'shopByFilter'])->name('shopByFilter');
Route::post('searchProductResult',[ShopController::class,'searchProductResult'])->name('searchProductResult');
//Product page

Route::get('product',[CustomerController::class, 'product'])->name('product');

Route::get('/myaccount', [CustomerController::class,'dashboard'])->middleware(['auth', 'verified'])->name('customer.myaccount');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	Route::get('catalogue',[WishlistController::class,'wishlist'])->name('wishlist');
	Route::get('catalogue/view/{id}',[WishlistController::class,'wishlistView'])->name('wishlistView');

	Route::get('inquiry',[InquiryController::class,'inquiryView'])->name('inquiry.view');
	Route::get('submitanenquiry',[InquiryController::class,'submitanenquiry'])->name('submitanenquiry');

Route::post('savesubmitanenquiry',[InquiryController::class,'savesubmitanenquiry'])->name('savesubmitanenquiry');

});
Route::post('wishlist/store',[WishlistController::class,'store'])->name('wishlist.store');

Route::post('wishlist/margin',[WishlistController::class,'setMargin'])->name('setMargin');

Route::post('product/subcategory',[ProductController::class,'getSubCategoryById'])->name('product.subCategory');

Route::post('product/brand',[ProductController::class,'getBrand'])->name('product.brand');

Route::get('product-detail/{id}',[ProductController::class,'getProductDetail'])->name('product.detail');

Route::get('contact-us',[ContactUsController::class,'index'])->name('contactus');
Route::post('contact-us/inquiry',[ContactUsController::class,'inquiry'])->name('inquiry');

Route::get('we-are-hiring',[ContactUsController::class,'weAreHiring'])->name('weAreHiring');
Route::get('about-us',[ContactUsController::class,'aboutUs'])->name('aboutUs');
Route::get('what-we-do/{type}',[ContactUsController::class,'whatWeDo'])->name('whatWeDo.send');




Route::get('userWishlist/{product_id}',[WishlistController::class,'getUserWishList'])->name('userwishlist');

Route::post('wishlist-assignProduct',[WishlistController::class,'assignProduct'])->name('userassignProduct');

Route::post('wishlist-download',[WishlistController::class,'wishlistDownload'])->name('wishlist.download');

Route::post('removeProductWishlist',[WishlistController::class,'removeProductWishlist'])->name('removeProductWishlist');

Route::post('savewishlist',[WishlistController::class,'savewishlist'])->name('savewishlist');
Route::post('removewishlist',[WishlistController::class,'removewishlist'])->name('removewishlist');
Route::post('customerInquiry',[InquiryController::class,'customerInquiry'])->name('customerInquiry');
Route::post('vacancy/store',[VacencyRequirementsController::class,'store'])->name('vacancy.store');

Route::post('subscription',[VacencyRequirementsController::class,'subscription'])->name('subscription');

Route::get('deals/product',[ShopController::class,'dealsProduct'])->name('deals.product');
