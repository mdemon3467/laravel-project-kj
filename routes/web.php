<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UpcomingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

//frontend pages
route::get('/',[FrontendController::class , 'welcome'])->name('welcome');
Route::get('/product/details/{slug}', [FrontendController::class , 'product_details'])->name('product.details');
Route::post('getsizes', [FrontendController::class, 'get_color']);
Route::get('/category/wise/product/{slug}', [FrontendController::class , 'category_wise_product'])->name('category.wise.product');
Route::get('/subcategory/wise/product/{id}', [FrontendController::class , 'subcategory_wise_product'])->name('subcategory.wise.product');
Route::get('/discount/product/50', [FrontendController::class , 'discount_product_50'])->name('discount.product.50');
Route::get('/discount/product/70', [FrontendController::class , 'discount_product_70'])->name('discount.product.70');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//user
route::post('/add/user', [UserController::class , 'add_user'])->name('add.user');
route::get('/user/list',[UserController::class , 'user_list'])->name('user.list');
route::get('/edit/profile',[UserController::class , 'edit_profile'])->name('edit.profile');
route::post('/update/profile',[UserController::class , 'update_profile'])->name('update.profile');
route::post('/update/password',[UserController::class , 'update_password'])->name('update.password');
route::post('/update/image', [UserController::class , 'update_image'])->name('update.image');
route::get('/delate/user/{id}', [UserController::class , 'delate_user'])->name('delate.user');


//category 
route::get('/add/category/', [CategoryController::class , 'add_category'])->name('add.category');
route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
route::get('/category/list', [CategoryController::class, 'category_list'])->name('category.list');
route::get('/category/delete/{id}', [CategoryController::class, 'category_delete'])->name('category.delete');
route::get('/category/edit/{id}', [CategoryController::class, 'category_edit'])->name('category.edit');
route::post('/category/update/{id}', [CategoryController::class, 'category_update'])->name('category.update');
route::get('/category/trash', [CategoryController::class, 'category_trash'])->name('category.trash');
route::get('/category/restore/{id}', [CategoryController::class, 'category_restore'])->name('category.restore');
route::post('/category/check/delete', [CategoryController::class, 'category_check_delete'])->name('category.check.delete');
route::post('/category/check/restore', [CategoryController::class, 'category_check_restore'])->name('category.check.restore');
route::get('/category/parmanent/delete/{id}', [CategoryController::class, 'category_parmanent_delete'])->name('category.parmanent.delete');

//subcategory 
route::get('/subcategory', [SubcategoryController::class , 'sub_category'])->name('sub.category');
route::post('/subcategory/store', [SubcategoryController::class , 'subcategory_store'])->name('subcategory.store');
route::get('/subcategory/edit/{id}', [SubcategoryController::class , 'subcategory_edit'])->name('subcategory.edit');
route::post('/subcategory/edit_store/{id}', [SubcategoryController::class , 'subcategory_edit_store'])->name('subcategory.edit.store');
route::get('/subcategory/delete/{id}', [SubcategoryController::class , 'subcategory_delete'])->name('subcategory.delete');


//brands
route::get('/brand', [BrandController::class, 'brand'])->name('brand');
route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
route::get('/brand/delete/{id}', [BrandController::class, 'brand_delete'])->name('brand.delete');

//tags
Route::get('/tags', [TagController::class, 'tags'])->name('tags');
Route::post('/tags.store', [TagController::class, 'tag_store'])->name('tag.store');
Route::get('/tags.delete/{id}', [TagController::class, 'tag_delete'])->name('tag.delete');

//product
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/getsubcategory', [ProductController::class, 'getsubcategory']);
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('/product/view/{id}', [ProductController::class, 'product_view'])->name('product.view');
Route::get('/product/delete/{id}', [ProductController::class, 'product_delete'])->name('product.delete');
Route::get('/product/edit/{id}', [ProductController::class, 'product_edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'product_update'])->name('product.update');

//variation
Route::get('/add/variation', [VariationController::class, 'add_variation'])->name('add.variation');
Route::post('/add/color', [VariationController::class, 'add_color'])->name('add.color');
Route::post('/add/size', [VariationController::class, 'add_size'])->name('add.size');
Route::get('/color/delete/{id}', [VariationController::class, 'color_delete'])->name('color.delete');
Route::get('/size/delete/{id}', [VariationController::class, 'size_delete'])->name('size.delete');

//inventory
Route::get('/add/inventory/{id}', [VariationController::class, 'add_inventory'])->name('add.inventory');
Route::post('/inventory/store/{id}', [VariationController::class, 'inventory_store'])->name('inventory.store');
Route::get('/inventory/delete/{id}', [VariationController::class, 'inventory_delete'])->name('inventory.delete');

//banner part
Route::get('/banner', [BannerController::class, 'banner'])->name('banner');
Route::post('/banner/store', [BannerController::class, 'banner_store'])->name('banner.store');
Route::get('/banner/delete/{id}', [BannerController::class, 'banner_delete'])->name('banner.delete');

//Exciting Offers
Route::get('/count/down', [OfferController::class, 'count_down'])->name('count.down');
Route::post('/count/down/store/{id}', [OfferController::class, 'count_down_store'])->name('countdown.store');
Route::get('/discount/event', [OfferController::class, 'discount_event'])->name('discount.event');
Route::post('/discount/event/store/{id}', [OfferController::class, 'discount_event_store'])->name('discount.event.store');

//upcoming Event
Route::get('/upcoming/event', [UpcomingController::class, 'upcoming_event'])->name('upcoming.event');
Route::post('/upcoming/event/store/{id}', [UpcomingController::class, 'upcoming_event_store'])->name('upcoming.event.store');

//Customer Auth
Route::get('customer/login/page',[CustomerAuthController::class, 'customer_login_page'])->name('customer.login.page');
Route::get('customer/registar/page',[CustomerAuthController::class, 'customer_registar_page'])->name('customer.registar.page');
Route::post('/customer/register/post', [CustomerAuthController::class, 'customer_register_post'])->name('customer.register.post');
Route::post('/customer/login/post', [CustomerAuthController::class, 'customer_login_post'])->name('customer.login.post');
Route::get('/customer/logout', [CustomerAuthController::class, 'customer_logout'])->name('customer.logout');
Route::get('/customer/profile', [CustomerAuthController::class, 'customer_profile'])->name('customer.profile');

//customer
Route::get('/customer/profile/edit', [CustomerController::class, 'customer_profile_edit'])->name('customer.profile.edit');
Route::post('/country/wise/city', [CustomerController::class, 'country_wise_city'])->name('country.wise.city');
Route::post('/customer/profile/change', [CustomerController::class, 'customer_profile_change'])->name('customer.profile.change');
Route::get('/customer/password/change', [CustomerController::class, 'customer_password_change'])->name('customer.password.change');
Route::post('/customer/new/password', [CustomerController::class, 'customer_new_password'])->name('customer.new.password');

//Cart section
Route::post('/add/to/cart/{product_id}', [CartController::class, 'add_cart'])->name('add.cart');
Route::get('/delete/cart/{cart_id}', [CartController::class, 'delete_cart'])->name('delete.cart');