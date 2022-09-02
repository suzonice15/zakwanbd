<?php

use Illuminate\Support\Facades\Route;

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
/*  start  menu management */
Route::get('/admin/menuPermission', 'admin\MenuPermission@index');
Route::get('/admin/role/{id}/edit', 'admin\MenuPermission@edit');
Route::post('/admin/menu/update/{id}', 'admin\MenuPermission@update');


/* end manu management */



Route::post('/askQuestionsFromWebsite', 'HomeController@askQuestionsFromWebsite');
Route::get('/allQuestions/{id}', 'HomeController@allQuestions');
Route::get('/affilates/products', 'HomeController@affilates_products');
Route::get('/', 'HomeController@index');
Route::get('/category/{id}', 'HomeController@category');
Route::get('ajax_category', 'HomeController@ajax_category');
//Route::get('/product/{id}', 'HomeController@product');
Route::get('/shops', 'HomeController@allShop');
Route::get('/hot-deal-product', 'HomeController@hotDealProduct');
Route::get('/checkCouponCode/{coupon_code}', 'HomeController@checkCouponCode');

Route::get('/search_engine', 'HomeController@search_engine');
Route::get('/product/click', 'HomeController@product_click');
Route::get('/visitor', 'HomeController@visitor');
Route::get('/search', 'HomeController@search');
Route::get('/search_ajax', 'HomeController@search_ajax');
Route::get('/hot_home_product', 'HomeController@hot_home_product');
Route::get('/home_page_category_ajax', 'HomeController@home_page_category_ajax');
Route::get('/add-to-cart', 'AjaxController@add_to_cart');
Route::get('/related/product', 'AjaxController@relatedProduct');
Route::get('/hotProductList', 'AjaxController@hotProductList');
Route::get('/hotdeal/product', 'AjaxController@hotdealProduct');
Route::get('track-your-order', 'HomeController@track_order');
Route::post('track-your-order', 'HomeController@track_order');
Route::post('/add_to_review', 'AjaxController@add_to_review');

/*  cart  */
Route::get('/thank-you', 'CheckOutController@thankYou');
Route::get('/cart', 'CheckOutController@cart');
Route::get('/plus_cart_item', 'CheckOutController@plus_cart_item');
Route::get('/minus_cart_item', 'CheckOutController@minus_cart_item');
Route::get('/remove_cart_item', 'CheckOutController@remove_cart_item');
Route::get('/add-to-wishlist', 'CheckOutController@add_to_wishlist');
Route::get('/wishlist', 'CheckOutController@wishlist');
Route::get('/remove-to-wishlist', 'CheckOutController@remove_wish_list');
Route::get('/checkout', 'CheckOutController@checkout');
Route::get('/checkoutMethod', 'CheckOutController@checkoutMethod');
Route::post('/chechout', 'CheckOutController@checkoutStore');
Route::post('/sendMessage', 'CheckOutController@sendMessage');
Route::get('/admin', 'admin\AdminController@login');
Route::get('/admin/wallets', 'admin\AdminController@wallets');
Route::post('/admin/addWalletBalance', 'admin\AdminController@addWalletBalance');
Route::get('/search/customerByPhone/{id}', 'admin\AdminController@customerByPhone');
Route::get('/admin/wallet/{id}', 'admin\AdminController@walletEdit');
Route::post('/admin/wallet/{id}', 'admin\AdminController@walletUpdate');
Route::post('/login_check', 'admin\AdminController@loginCheck');
Route::get('/sohoj-admin-login', 'admin\AdminController@sohoj_admin');
Route::get('/dashboard', 'admin\DashboardController@index');


/****=============== admin section    =====================  ******/

Route::get('admin/users', 'admin\AdminController@index');
Route::get('admin/generel/users', 'admin\AdminController@generel_users');
Route::get('admin/generel/message', 'admin\AdminController@message');
Route::get('admin/questions', 'admin\AdminController@questions');
Route::get('admin/product/comment/{id}', 'admin\AdminController@productComment');
Route::post('admin/commentUpdate/{id}', 'admin\AdminController@commentUpdate');
Route::get('admin/generel/message/show/{id}', 'admin\AdminController@messageShow');
Route::get('admin/generel/message/notificationCount', 'admin\AdminController@notificationCount');
Route::get('admin/generel/message/pagination', 'admin\AdminController@message_pagination');
Route::post('admin/generel/messageDelete', 'admin\AdminController@messageDelete');
Route::get('generel/users/pagination', 'admin\AdminController@general_pagination');

Route::get('admin/user/create', 'admin\AdminController@create');
Route::post('admin/user/store', 'admin\AdminController@store');
Route::post('admin/user/update/{id}', 'admin\AdminController@update');
Route::get('admin/user/{id}', 'admin\AdminController@edit');
Route::get('admin/vendor/{id}', 'admin\AdminController@editVendorProfile');
Route::get('/admin/user/delete/{id}', 'admin\AdminController@delete');
Route::get('logout', 'admin\AdminController@logout');


/****=============== category section    =====================  ******/
Route::resource('admin/zone', 'admin\ZoneController');
Route::resource('admin/shop', 'admin\ShopController');
Route::resource('admin/supply', 'admin\SupplyController');

Route::resource('admin/zoneStock', 'admin\ZoneStockController');
Route::get('admin/zone/zoneProductOfStock/{id}', 'admin\ZoneStockController@zoneProductOfStock');
Route::get('admin/zoneStockUpdate', 'admin\ZoneStockController@zoneStockUpdate'); 

Route::get('admin/zoneProducts/pagination', 'admin\ZoneStockController@zoneProducts'); 
Route::get('admin/stockReportZone', 'admin\ZoneStockController@stockReportZone'); 

/****=============== category section    =====================  ******/
Route::get('admin/categories', 'admin\CategoryController@index');
Route::post('category-urlcheck', 'admin\CategoryController@urlCheck');
Route::get('admin/category/create', 'admin\CategoryController@create');
Route::post('admin/category/store', 'admin\CategoryController@store');
Route::post('admin/category/update/{id}', 'admin\CategoryController@update');
Route::get('admin/category/{id}', 'admin\CategoryController@edit');
Route::get('/admin/category/delete/{id}', 'admin\CategoryController@delete');
Route::get('category/pagination/fetch_data', 'admin\CategoryController@fetch_data');


/****=============== admin page section    =====================  ******/
Route::get('admin/pages', 'admin\PageController@index');
 Route::get('admin/page/create', 'admin\PageController@create');
Route::post('admin/page/store', 'admin\PageController@store');
Route::post('admin/page/update/{id}', 'admin\PageController@update');
Route::get('admin/page/{id}', 'admin\PageController@edit');
Route::get('/admin/page/delete/{id}', 'admin\PageController@delete');


/****=============== home page setting section    =====================  ******/
Route::get('admin/homepage/setting', 'admin\SettingController@homePageSetting');
Route::post('admin/homepage/setting', 'admin\SettingController@homePageSetting');

Route::get('admin/default/setting', 'admin\SettingController@defaultSetting');
Route::get('admin/coin/setting/create', 'admin\SettingController@CoinCreate');
Route::post('admin/coin/setting/create', 'admin\SettingController@CoinCreate');
Route::get('admin/coin/setting', 'admin\SettingController@CoinSetting');
Route::get('admin/coin/setting/{id}', 'admin\SettingController@CoinEdit');
Route::post('admin/coin/setting/{id}', 'admin\SettingController@CoinEdit');
Route::post('admin/coin/setting', 'admin\SettingController@CoinSetting');

Route::post('admin/default/setting', 'admin\SettingController@defaultSetting');
Route::get('admin/social/setting', 'admin\SettingController@socialSetting');
Route::post('admin/social/setting', 'admin\SettingController@socialSetting');
Route::get('admin/default/mailSetting', 'admin\SettingController@mailSetting');

Route::post('admin/social/smtpAdd', 'admin\SettingController@smtpAdd');

/****=============== product stock check  =====================  ******/
Route::get('admin/productStockCheck', 'admin\StockController@productStockCheck');
Route::get('admin/ProductSellReport', 'admin\StockController@ProductSellReport');

/****=============== product section    =====================  ******/
Route::get('admin/products', 'admin\ProductController@index');
Route::get('admin/staff-products', 'admin\ProductController@staffProduct');
Route::post('product-urlcheck', 'admin\ProductController@urlCheck')->name('product.urlcheck');
Route::post('product-foldercheck', 'admin\ProductController@foldercheck')->name('product.foldercheck');
Route::get('admin/product/create', 'admin\ProductController@create');
Route::post('admin/product/store', 'admin\ProductController@store');
Route::post('admin/product/update/{id}', 'admin\ProductController@update');
Route::get('/admin/productEdit/{id}', 'admin\ProductController@edit');
Route::get('/admin/product/delete/{id}', 'admin\ProductController@destroy');
Route::get('products/pagination', 'admin\ProductController@pagination');
Route::get('admin/top-deal-products', 'admin\ProductController@TopDealProducts');
Route::get('admin/unpublishedProduct', 'admin\ProductController@unpublishedProduct');
Route::get('admin/product/StockUpdate/{id}', 'admin\ProductController@StockUpdate');
Route::get('admin/product/productStockUpdate', 'admin\ProductController@productStockUpdate');
Route::get('admin/productBarCodeGenerate', 'admin\ProductController@productBarCodeGenerate');

/****=============== Order section    =====================  ******/
Route::get('admin/onlineOrders', 'admin\OrderController@onlineOrders');
Route::get('admin/sellTransfer', 'admin\OrderController@sellTransfer');
Route::post('admin/sellTransfer', 'admin\OrderController@sellTransferUpdate');
Route::get('admin/orders', 'admin\OrderController@index');
Route::get('admin/orders/posPrint/{id}', 'admin\OrderController@posPrint');
Route::get('admin/orders/history-generate', 'admin\OrderController@orderHistoryGenerate');
Route::get('admin/order/create', 'admin\OrderController@create');
Route::post('admin/order/store', 'admin\OrderController@store');
Route::post('admin/order/update/{id}', 'admin\OrderController@update');
Route::get('/admin/order/delete/{id}', 'admin\OrderController@destroy');
Route::get('admin/order/invoice-print/{id}', 'admin\OrderController@invoicePrint');
Route::get('order/pagination', 'admin\OrderController@pagination');
Route::post('admin/orderExchange', 'admin\OrderController@orderExchange');
Route::get('admin/order/EearningHistoryToLevelTransfer', 'admin\OrderController@EearningHistoryToLevelTransfer');
Route::get('admin/order/customerActiveOrderIncome', 'admin\OrderController@customerActiveOrderIncome');
Route::get('order/pagination_by_search', 'admin\OrderController@pagination_by_search');
Route::get('order/pagination_search_by_phone', 'admin\OrderController@pagination_search_by_phone');
Route::get('order/pagination_search_by_affiliate_id', 'admin\OrderController@pagination_search_by_affiliate_id');
Route::get('order/pagination_search_by_product_code', 'admin\OrderController@pagination_search_by_product_code');
Route::get('/orderConvertToProductCode', 'admin\OrderController@orderConvertToProductCode');
Route::get('/order/affiliateCheckByMobile/{phone}', 'admin\OrderController@affiliateCheckByMobile');
Route::get('/admin/getProductsByShopId', 'admin\OrderController@getProductsByShopId');

Route::get('order/product/selection/change', 'admin\AjaxOrderControlller@getOrderProduct')->name('getOrderProduct'); 

Route::get('/admin/courier/view/report', 'admin\OrderController@courierViewReport');
Route::get('/admin/courier/view/report/pagination', 'admin\OrderController@courierViewReportPagination');
Route::get('/admin/orderEditHistory/{id}', 'admin\OrderController@orderEditHistory');
Route::get('/admin/orderModalPrint/{id}', 'admin\OrderController@orderModalPrint');
Route::get('/admin/order/report', 'admin\OrderController@orderReport');
Route::post('admin/order/report', 'admin\OrderController@orderReportGeneration');
Route::get('admin/order/status/changed/{order_status}/{order_id}', 'admin\OrderController@statusChanged');
Route::get('admin/order/{id}', 'admin\OrderController@edit'); 
Route::get('admin/order/confirmPayment/{id}', 'admin\OrderController@confirmPayment'); 

/**************************** Order report          **************************/ 

Route::get('admin/report/order_report', 'admin\ReportController@order_report');
Route::get('admin/report/heightSellProduct', 'admin\ReportController@heightSellProduct');
Route::get('admin/report/stockReport', 'admin\ReportController@stockReport');
 
Route::post('admin/report/order_report', 'admin\ReportController@order_report_by_ajax');
Route::get('admin/report/ProductDemand', 'admin\ReportController@ProductDemand');
Route::get('admin/report/userProductDemand', 'admin\ReportController@userProductDemand');
Route::get('admin/report/userProductDemand/{id}', 'admin\ReportController@userProductDemandView');
Route::post('admin/report/userProductDemand/{id}', 'admin\ReportController@userProductDemandViewUpdate');

/****=============== media section    =====================  ******/
Route::get('admin/media', 'admin\MediaController@index');
Route::get('admin/media/create', 'admin\MediaController@create');
Route::post('admin/media/store', 'admin\MediaController@store');
Route::get('/admin/media/delete/{id}', 'admin\MediaController@destroy');
Route::get('media/pagination', 'admin\MediaController@pagination');
Route::get('media/pagination/fetch_data', 'admin\MediaController@pagination');

/****=============== courier section    =====================  ******/
Route::get('admin/couriers', 'admin\CourierController@index');
 Route::get('admin/courier/create', 'admin\CourierController@create');
Route::post('admin/courier/store', 'admin\CourierController@store');
Route::post('admin/courier/update/{id}', 'admin\CourierController@update');
Route::get('admin/courier/{id}', 'admin\CourierController@edit');
Route::get('/admin/courier/delete/{id}', 'admin\CourierController@delete');


/****=============== media section    =====================  ******/
Route::get('admin/sliders', 'admin\SliderController@index');
Route::get('admin/slider/create', 'admin\SliderController@create');
Route::post('admin/slider/store', 'admin\SliderController@store');
Route::post('admin/slider/update/{id}', 'admin\SliderController@update');
Route::get('admin/slider/{id}', 'admin\SliderController@edit');
Route::get('/admin/slider/delete/{id}', 'admin\SliderController@destroy');

/****=============== admin vendor  section   =====================  ******/
Route::get('/admin/vendor/order/check/{ID}', 'admin\AdminVendorController@orderCheck');
Route::get('admin/vendor/money/withdrow', 'admin\AdminVendorController@withdrowMoney');
Route::get('admin/vendor/money/withdrow/pagination', 'admin\AdminVendorController@withdrowMoney');
Route::get('admin/vendor/money/pay/{id}', 'admin\AdminVendorController@moneyPay');
Route::post('admin/vendor/insert/withdrow/amount/{id}', 'admin\AdminVendorController@insertWithdrowAmount');
Route::get('admin/vendors', 'admin\AdminVendorController@index');
Route::get('/admin/vendor/view/{id}', 'admin\AdminVendorController@show');
Route::get('/admin/vendor/product/{id}', 'admin\AdminVendorController@vendor_product_edit');
Route::get('/admin/vendor/order/show/{id}', 'admin\AdminVendorController@vendor_order_show');
Route::get('/vendor/product/price/pay/{id}', 'admin\AdminVendorController@productPricePay');
Route::get('/vendor/product/price/unpay/{id}', 'admin\AdminVendorController@productPriceunPay');
Route::post('admin/vendor/product/update/{id}', 'admin\AdminVendorController@vendor_product_edit_update');
Route::get('admin/vendor/pending/products', 'admin\AdminVendorController@pending');
Route::get('admin/vendor/published/products', 'admin\AdminVendorController@published_product');
Route::get('admin/vendor/published/Withdrow', 'admin\AdminVendorController@vandorWithdrawStatus');
Route::get('admin/vendor/published/shop-name', 'admin\AdminVendorController@shopNameStatus');
Route::post('admin/vendor/published/shop-name-change', 'admin\AdminVendorController@shopNameStatusChange');
Route::get('admin/vendor/published/history', 'admin\AdminVendorController@vandorAmountHistory');
Route::post('admin/vendor/published/WithdrowStatusChange', 'admin\AdminVendorController@WithdrowStatusChange');
Route::get('admin/vendor/pending/products/pagination', 'admin\AdminVendorController@pending_pagination');
Route::get('admin/vendor/published/products/pagination', 'admin\AdminVendorController@published_pagination');
Route::get('admin/vendor/product/published/{id}', 'admin\AdminVendorController@published');
Route::get('admin/vendor/product/unpublished/{id}', 'admin\AdminVendorController@unpublished');
Route::get('/admin/vendor/delete/{id}', 'admin\AdminVendorController@delete');
Route::get('/admin/vendor/active/{id}', 'admin\AdminVendorController@active');
Route::get('/admin/vendor/edit/{id}', 'admin\AdminVendorController@vendor_edit');
Route::post('/admin/vendor/edit/update/{id}', 'admin\AdminVendorController@vendor_edit_update');
Route::get('/admin/vendor/inactive/{id}', 'admin\AdminVendorController@inactive');
Route::get('/sohoj-admin-login', 'admin\AdminController@sohoj_admin');
Route::get('/admin/getShopData/{zone_id}', 'admin\AdminController@getShopData');


/****=============== vendor font section    =====================  ******/
Route::get('/shop/{id}', 'VendorController@shop');
Route::get('/vendor-shop-ajax-product', 'VendorController@vedor_shop_ajax');
Route::get('vendor/form', 'VendorController@sign_up_form');
Route::post('vendor/save', 'VendorController@store');
Route::get('vendor/login', 'VendorController@login');
Route::get('vendor/logout', 'VendorController@logout');
Route::post('vendor/login', 'VendorController@login_check');
//Route::get('vendor/forgetPassword', 'VendorController@forgetPassword');
Route::post('vendor-shop-urlcheck', 'VendorController@shopUrlCheck')->name('vendor.Shopurlcheck');

Route::get('vendor/forgot-password', 'VendorController@ForgotPassword');
Route::post('vendor/forgot-password', 'VendorController@ForgotPasswordCheck');
Route::get('vendor/new-password/{vendor_email}', 'VendorController@NewPassword');
Route::post('vendor/new-password', 'VendorController@NewPasswordStore');



/****=============== customer font section    =====================  ******/

Route::get('otp/request/{phone}', 'CustomerController@otpRequest');
Route::get('customer/orders', 'CustomerController@orders');
Route::post('add-wallet/balance', 'CustomerController@addWalletBalance');



Route::get('customer/points', 'CustomerController@points');
Route::post('customer/login', 'CustomerController@login_check');
Route::post('customer/changed_password', 'CustomerController@changedPasswordUpdate');
Route::get('customer/login', 'CustomerController@login');
Route::get('customer/form', 'CustomerController@sign_up_form');
Route::get('customer/payment/history', 'CustomerController@paymentHistory');
Route::get('customer/wallet/history', 'CustomerController@walletHistory');
Route::post('customer/promosion/order', 'CustomerController@promosionOrder');

Route::get('customer/login/affiliate/{id}', 'CustomerController@loginAffiliate');
Route::get('customer/order/cancel/{order_id}', 'CustomerController@orderCancel');
Route::get('customer/order/pay/{order_id}', 'CustomerController@orderPay');
Route::post('customer/form', 'CustomerController@store');
Route::post('customer/orderPayment', 'CustomerController@orderPayment');
Route::post('customer/orderPayByMethod', 'CustomerController@orderPayByMethod');
Route::get('customer/logout', 'CustomerController@logout');
Route::get('customer/logout', 'CustomerController@logout');
Route::get('customer/profile', 'CustomerController@profile');
Route::get('/customer/dasboard', 'CustomerController@dashboard');
Route::get('/customer/coins', 'CustomerController@coins');
Route::get('/customer/changed_password', 'CustomerController@changed_password');
Route::post('/customer/profile/update', 'CustomerController@profile_update');

Route::get('customer/forgot-password', 'CustomerController@ForgotPassword');
Route::get('customer/forgotPasswordStore', 'CustomerController@forgotPasswordStore');
Route::get('otp/passwordResetRequest/{phone}', 'CustomerController@passwordResetRequest');

Route::post('customer/forgotPasswordUpdate', 'CustomerController@forgotPasswordUpdate');
Route::post('customer/forgotPasswordUpdateByPhone', 'CustomerController@forgotPasswordUpdateByPhone');
Route::get('customer/new-password/{email}', 'CustomerController@NewPassword');
Route::post('customer/new-password', 'CustomerController@NewPasswordStore');
Route::get('customer/new/response', 'CustomerController@newResponse');
 

/****=============== vendor admin section    =====================  ******/
Route::get('vendor/product/create', 'VendorController@create');
Route::post('vendor/product/vendorPrice', 'VendorController@vendorPrice');
Route::post('vendor/product/vendorPriceAdmin', 'VendorController@vendorPriceAdmin');
Route::post('vendor/product/product_store', 'VendorController@product_store');
Route::get('/vendor/products/show', 'VendorController@index');
Route::get('vendor/products/pagination', 'VendorController@pagination');
Route::get('vendor/product/delete/{id}', 'VendorController@delete_product');
Route::get('vendor/product/{id}', 'VendorController@edit');
Route::post('/vendor/product/update/{id}', 'VendorController@update');
Route::get('vendor/orders/show', 'VendorController@all_orders');
Route::get('vendor/profile/{id}', 'VendorController@editVendorProfile');
Route::post('vendor/profileUpdate/{id}', 'VendorController@profileUpdate');
Route::get('vendor/bank-account', 'VendorController@bankAccount');
Route::get('vendor/withdrow-amount', 'VendorController@vandorWithdrowAmount');
Route::get('vendor/change-shop-name', 'VendorController@changeShopName');
Route::get('vendor/amount-history', 'VendorController@amountHistory');
Route::post('vendor/change-shop-name-update', 'VendorController@changeShopNameUpdate');
Route::post('vendor/insert-withdrow-amount', 'VendorController@insertVandorWithdrowAmount');
Route::post('/vendor/mobile_update', 'VendorController@mobile_update');
Route::post('/vendor/bank_update', 'VendorController@bank_update');
Route::get('/all-products', 'HomeController@allProducts');
Route::get('/coin', 'HomeController@coin');
Route::get('/getCoinDataByAjax', 'HomeController@getCoinDataByAjax');
Route::get('/getCoinBonusById/{id}', 'HomeController@getCoinBonusById');
Route::get('/getCoinData', 'HomeController@getCoinData');
Route::get('all_ajax_products', 'HomeController@ajaxAllProducts');

Route::get('/ip', 'HomeController@ip');

Route::get('/clear-cache', function() {
     Artisan::call('cache:clear');
    Artisan::call('view:clear');
      return redirect('dashboard');
});
Route::get('/product/{id}', 'HomeController@product');
Route::get('/{id}', 'HomeController@product');
Route::get('/{name}/{id}', 'HomeController@affiliate_check_controller');




