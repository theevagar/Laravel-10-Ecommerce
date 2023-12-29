<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Models\Brand;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

// Route::get('/', function () {

//     return view('welcome');
// });


// Route::get('/test', function () {

//     orderEmail(2);
// });


Route::get('/',[FrontController::class, 'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{subCatgorySlug?}',[ShopController::class, 'index'])->name('front.shop');
Route::get('/product/{slug}',[ShopController::class,'product'])->name('front.product');


Route::get('/cart',[CartController::class, 'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartController::class, 'addToCart'])->name('front.addToCart');
Route::post('/update-cart',[CartController::class, 'updateCart'])->name('front.updateCart');
Route::post('/delete-item',[CartController::class, 'deleteItem'])->name('front.deleteCart');
Route::get('/checkout',[CartController::class, 'checkout'])->name('front.checkout');
Route::post('/process-checkout',[CartController::class, 'processCheckout'])->name('front.processCheckout');
Route::get('/thanks/{orderId}',[CartController::class, 'thankyou'])->name('front.thankyou');
Route::post('/get-order-summery',[CartController::class, 'getOrderSummery'])->name('front.getOrderSummery');




//apply discount
Route::post('/apply-discount',[CartController::class, 'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount',[CartController::class, 'removeCoupon'])->name('front.removeCoupon');


//add to wishlist
Route::post('/add-to-wishlist',[FrontController::class, 'addToWishlist'])->name('front.addToWishlist');

//front page route
Route::get('/page/{slug}',[FrontController::class, 'page'])->name('front.page');

//send email
Route::post('/send-contact-email',[FrontController::class, 'sendContactEmail'])->name('front.sendContactEmail');

//forget password
Route::get('/forget-password',[AuthController::class, 'forgetPassword'])->name('front.forgetPassword');
Route::post('/process-forget-password',[AuthController::class, 'processForgetPassword'])->name('front.processForgetPassword');
Route::get('/reset-password/{token}',[AuthController::class, 'resetPassword'])->name('front.resetPassword');
Route::post('/process-reset-password}',[AuthController::class, 'processResetPassword'])->name('front.processResetPassword');


//ratings route
Route::post('/save-rating/{productId}',[ShopController::class, 'saveRating'])->name('front.saveRating');






// FRONT END SECTION
Route::group(['prefix' => 'account'], function(){

    Route::group(['middleware' => 'guest'], function(){


        Route::get('/login',[AuthController::class,'login'])->name('account.login');
        Route::post('/login',[AuthController::class,'authenticate'])->name('account.authenticate');

        Route::get('/register',[AuthController::class,'register'])->name('account.register');
        Route::post('/process-register',[AuthController::class, 'processRegister'])->name('front.processRegister');




    });

    Route::group(['middleware' => 'auth'], function(){

        Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
        Route::post('/update-profile',[AuthController::class,'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address',[AuthController::class,'updateAddress'])->name('account.updateAddress');
        Route::get('/change-password',[AuthController::class,'showChangePasswordForm'])->name('account.showChangePasswordForm');
        Route::post('/process-change-password',[AuthController::class,'changePassword'])->name('account.processChangePassword');


        Route::get('/my-orders',[AuthController::class,'orders'])->name('account.orders');
        Route::get('/my-wishlist',[AuthController::class,'wishlist'])->name('account.wishlist');
        Route::post('/remove-product-from-wishlist',[AuthController::class,'removeProductFromWishlist'])->name('account.removeProductFromWishlist');
        Route::get('/order-detail/{orderId}',[AuthController::class,'orderDetail'])->name('account.orderDetail');
        Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');

    });


});



// ADMIN OR BACKEND SECTION

Route::group(['prefix' => 'admin'] , function(){


        Route::group(['middleware' => 'admin.guest'], function(){

            Route::get('/login',[AdminController::class,'index'])->name('admin.login');
            Route::post('/authenticate',[AdminController::class,'authenticate'])->name('authenticate.login');

        });


        Route::group(['middleware' => 'admin.auth'], function(){

            Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
            Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');


            // Category Route
            Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
            Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
            Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
            Route::get('/categories/{category}/edit',[CategoryController::class,'edit'])->name('categories.edit');
            Route::put('/categories/{category}',[CategoryController::class,'update'])->name('categories.update');
            Route::delete('/categories/{category}',[CategoryController::class,'destroy'])->name('categories.delete');


            // Sub Category route
            Route::get('/sub-categories',[SubCategoryController::class,'index'])->name('sub-categories.index');
            Route::get('/sub-categories/create',[SubCategoryController::class,'create'])->name('sub-categories.create');
            Route::post('/sub-categories',[SubCategoryController::class,'store'])->name('sub-categories.store');
            Route::get('/sub-categories/{subCategory}/edit',[SubCategoryController::class,'edit'])->name('sub-categories.edit');
            Route::put('/sub-categories/{subCategory}',[SubCategoryController::class,'update'])->name('sub-categories.update');
            Route::delete('/sub-categories/{subCategory}',[SubCategoryController::class,'destroy'])->name('sub-categories.delete');



            // Brands route
            Route::get('/brands',[BrandController::class,'index'])->name('brands.index');
            Route::get('/brands/create',[BrandController::class,'create'])->name('brands.create');
            Route::post('/brands',[BrandController::class,'store'])->name('brands.store');
            Route::get('/brands/{brand}/edit',[BrandController::class,'edit'])->name('brands.edit');
            Route::put('/brands/{brand}',[BrandController::class,'update'])->name('brands.update');
            Route::delete('/brands/{brand}',[BrandController::class,'destroy'])->name('brands.delete');



            // product route
            Route::get('/products',[ProductController::class,'index'])->name('products.index');
            Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
            Route::post('/products',[ProductController::class,'store'])->name('products.store');
            Route::get('/products/{product}/edit',[ProductController::class,'edit'])->name('products.edit');
            Route::put('/products/{product}',[ProductController::class,'update'])->name('products.update');
            Route::delete('/products/{product}',[ProductController::class,'destroy'])->name('products.delete');
            Route::get('/get-products',[ProductController::class,'getProducts'])->name('products.getProducts');
            Route::get('/ratings',[ProductController::class,'productRatings'])->name('products.productRatings');
            Route::post('/change-ratings-status',[ProductController::class,'changeRatingStatus'])->name('products.changeRatingStatus');




            Route::get('/product-subcategories',[ProductSubCategoryController::class,'index'])->name('product-subcategories.index');


            // productImage save
            Route::post('/products-images/update',[ProductImageController::class,'update'])->name('products-image.update');
            Route::delete('/products-images',[ProductImageController::class,'destroy'])->name('products-image.destroy');


            //Shipping Route
            Route::get('/shipping/create',[ShippingController::class,'create'])->name('shipping.create');
            Route::post('/shipping/store',[ShippingController::class,'store'])->name('shipping.store');
            Route::get('/shipping/{id}',[ShippingController::class,'edit'])->name('shipping.edit');
            Route::put('/shipping/{id}',[ShippingController::class,'update'])->name('shipping.update');
            Route::delete('/shipping/{id}',[ShippingController::class,'destroy'])->name('shipping.delete');



            //Coupons Route
            Route::get('/coupons',[DiscountCodeController::class,'index'])->name('coupons.index');
            Route::get('/coupons/create',[DiscountCodeController::class,'create'])->name('coupons.create');
            Route::post('/coupons',[DiscountCodeController::class,'store'])->name('coupons.store');
            Route::get('/coupons/{coupon}/edit',[DiscountCodeController::class,'edit'])->name('coupons.edit');
            Route::put('/coupons/{coupon}',[DiscountCodeController::class,'update'])->name('coupons.update');
            Route::delete('/coupons/{coupon}',[DiscountCodeController::class,'destroy'])->name('coupons.delete');



            //order Route
            Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
            Route::get('/orders/{id}',[OrderController::class,'detail'])->name('orders.detail');
            Route::post('/orders/change-status/{id}',[OrderController::class,'changeOrderStatus'])->name('orders.changeOrderStatus');
            Route::post('/orders/send-email/{id}',[OrderController::class,'sendInvoiceEmail'])->name('orders.sendInvoiceEmail');



            // Users Route
            Route::get('/users',[UserController::class,'index'])->name('users.index');
            Route::get('/users/create',[UserController::class,'create'])->name('users.create');
            Route::post('/users',[UserController::class,'store'])->name('users.store');
            Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
            Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
            Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.delete');


            //Pages Route
            Route::get('/pages',[PageController::class,'index'])->name('pages.index');
            Route::get('/pages/create',[PageController::class,'create'])->name('pages.create');
            Route::post('/pages',[PageController::class,'store'])->name('pages.store');
            Route::get('/pages/{page}/edit',[PageController::class,'edit'])->name('pages.edit');
            Route::put('/pages/{page}',[PageController::class,'update'])->name('pages.update');
            Route::delete('/pages/{page}',[PageController::class,'destroy'])->name('pages.delete');




            // Settings Route
            Route::get('/change-password',[SettingController::class,'showPasswordChangeForm'])->name('admin.showPasswordChangeForm');
            Route::post('/process-change-password',[SettingController::class,'processChangePassword'])->name('admin.processChangePassword');


            // temp.image.crate
            Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-image-create');


            Route::get('/getSlug',function(Request $request){

                $slug = '';

                if (!empty($request->title))
                {
                    $slug = Str::slug($request->title);
                }



                return response()->json([

                    'status' => true,
                    'slug' => $slug


                ]);


            })->name('getSlug');




        });


});
