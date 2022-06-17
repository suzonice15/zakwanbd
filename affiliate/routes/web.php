<?php

use Illuminate\Support\Facades\Route;

 


Route::get('/admin', 'admin\AdminController@login');
Route::get('logout', 'admin\AdminController@logout');
Route::get('/affilite/logout', 'HomeController@logout');
Route::get('/forgot-password', 'HomeController@forgate_password');
Route::post('/forgotPassword', 'HomeController@forgate_password_store');
Route::get('/loginNotice', 'HomeController@LoginNotice');


/************************** admin charge dashboard                         *********/

Route::get('/admin/getCharge', 'admin\AdminAffiliteController@getCharge');
Route::get('/admin/getServiceChargeFromAffiliate', 'admin\AdminAffiliteController@getServiceChargeFromAffiliate');




//Route::get('/dashboard', 'DashboardController@index');
Route::get('/adminLoginToAffiliate/{id}', 'admin\AdminAffiliteController@adminLoginToAffiliate');

//Route::get('/login', 'HomeController@login');
Route::get('/affiliate/contest', 'HomeController@sponsor');
Route::get('/website/contest/{id}', 'HomeController@websiteContestResult');
Route::post('/affilite_login_check', 'HomeController@login_check');
Route::get('/registration', 'HomeController@registration');
Route::post('/registration', 'HomeController@store');
Route::get('varify/{id}', 'HomeController@varify');
Route::get('reset/{id}', 'HomeController@reset');
Route::get('reffer/{id}', 'HomeController@reffer');
Route::get('/new-password', 'HomeController@new_password');
Route::post('/new-password', 'HomeController@new_password_change');


Route::post('/login_check', 'admin\AdminController@loginCheck');
Route::get('/dashboard', 'admin\DashboardController@index');



Route::get('/add-to-wishlist', 'CheckOutController@add_to_wishlist');
Route::get('/wishlist', 'CheckOutController@wishlist');
Route::get('/remove-to-wishlist', 'CheckOutController@remove_wish_list');

Route::get('/cart', 'CheckOutController@cart');
Route::get('/plus_cart_item', 'CheckOutController@plus_cart_item');
Route::get('/minus_cart_item', 'CheckOutController@minus_cart_item');
Route::get('/remove_cart_item', 'CheckOutController@remove_cart_item');
/************************** admin affilate dashboard                         *********/
Route::get('/admin/message', 'admin\AdminAffiliteController@message');
Route::get('/withdraw/notification/count', 'admin\AdminAffiliteController@withdrawNotificatioCount');
Route::post('/admin/message', 'admin\AdminAffiliteController@sendMessage');
Route::get('/admin/product/notification/delete', 'admin\AdminAffiliteController@notificationDelete');
Route::post('/admin/product/notification/delete', 'admin\AdminAffiliteController@notificationDeleteAction');
Route::get('/admin/marketing/metarial', 'admin\AdminAffiliteController@marketingMetarial');
Route::get('/admin/marketing/metarial/pagination', 'admin\AdminAffiliteController@marketingMetarialPagination');
Route::get('/admin/affilite/metarial/show', 'admin\AdminAffiliteController@singleMarketingMetarial');
Route::get('/marketing/memberUpdate', 'admin\AdminAffiliteController@marketingMemberUpdate');
Route::get('/admin/online/user', 'admin\AdminAffiliteController@online_user');
Route::get('admin/campain/report', 'admin\AdminAffiliteController@campain_report');
Route::post('admin/campain/date_wise_report', 'admin\AdminAffiliteController@date_wise_report');
Route::get('/admin/online/ajax', 'admin\AdminAffiliteController@online_user_ajax');
Route::get('/admin/online/ajax_total', 'admin\AdminAffiliteController@online_user_ajax_total');
Route::get('/admin/affilator_list', 'admin\AdminAffiliteController@affilator_list');
Route::get('/admin/affiliate_varification_list', 'admin\AdminAffiliteController@affiliate_varification_list');
Route::get('/admin/affiliate_varification_list/{id}', 'admin\AdminAffiliteController@singleAffiliate_varification_list');
Route::post('/singleAffiliateVarificationUpdate', 'admin\AdminAffiliteController@singleAffiliateVarificationUpdate');

Route::get('/admin/inactive/affiliate','admin\AdminAffiliteController@inactiveUser');
Route::get('/admin/inactive_affilite/affilite_pagination','admin\AdminAffiliteController@inactiveAffilatorPagination');
Route::get('/inactive/all/affilate','admin\AdminAffiliteController@inactiveAllAffilate');
Route::get('/affiliate/active/{id}', 'admin\AdminAffiliteController@affiliateActive');
Route::get('/admin/achievements', 'admin\AdminAffiliteController@achievements');
Route::get('/admin/achivementComplete/{id}', 'admin\AdminAffiliteController@achivementComplete');

Route::get('/leadshipPointDistributionOfContestTwo', 'admin\AdminAffiliteController@leadshipPointDistributionOfContestTwo');
Route::get('/leadshipAmountDistributionOfContestTwo', 'admin\AdminAffiliteController@leadshipAmountDistributionOfContestTwo');
Route::get('/leadshipPointDistribution', 'admin\AdminAffiliteController@leadshipPointDistribution');
Route::get('/leadshipAmountDistribution', 'admin\AdminAffiliteController@leadshipAmountDistribution');
Route::get('/admin/contest/history', 'admin\AdminAffiliteController@contestHistory');
Route::get('/admin/contest/history/pagination', 'admin\AdminAffiliteController@contestHistoryPagination');

Route::get('/admin/royalty/history', 'admin\AdminAffiliteController@royaltyHistory');
Route::post('/royalty-found-distribution', 'admin\AdminAffiliteController@royaltyFoundDistribution');
Route::get('/admin/royalty/history/pagination', 'admin\AdminAffiliteController@royaltyHistoryPagination');


Route::post('/royalty-commision', 'admin\AdminAffiliteController@royaltyCommision');
Route::post('/contest-commision', 'admin\AdminAffiliteController@contestCommision');
Route::get('/admin/product_list', 'admin\AdminAffiliteController@product_list');
Route::get('/admin/product_list_pagination', 'admin\AdminAffiliteController@product_list_pagination');
Route::get('/admin/affilite/editProduct/{id}', 'admin\AdminAffiliteController@editProduct');
Route::post('admin/updateProduct/{id}', 'admin\AdminAffiliteController@updateProduct');
Route::get('/admin/affilite/affilite_pagination', 'admin\AdminAffiliteController@affilite_pagination');
Route::get('/admin/affilite/affilite/show', 'admin\AdminAffiliteController@single_affilite_show');
Route::get('/admin/affilite/suspend/show', 'admin\AdminAffiliteController@single_suspend_show');
Route::post('/affiliate/supend/save', 'admin\AdminAffiliteController@single_suspend_save');
Route::get('admin/affilite/editProfile/{id}', 'admin\AdminAffiliteController@editProfile');
Route::post('admin/affilite/updateProfile/{id}', 'admin\AdminAffiliteController@updateProfile');
Route::get('/admin/withdraw', 'admin\AdminAffiliteController@withdraw');
Route::get('/admin/income/history', 'admin\AdminAffiliteController@incomeHistory');
 
Route::get('/admin/purchase/history', 'admin\AdminAffiliteController@purchaseHistory');
Route::get('/admin/purchase/history/pagination', 'admin\AdminAffiliteController@purchaseHistoryPagination');
Route::get('/admin/income/history/pagination', 'admin\AdminAffiliteController@incomeHistoryPagination');
Route::get('/admin/editWithdrawStatus/{id}', 'admin\AdminAffiliteController@editWithdrawStatus');
Route::post('/admin/updateWithdrawStatus', 'admin\AdminAffiliteController@updateWithdrawStatus');
Route::get('/admin/withdraw/pagination', 'admin\AdminAffiliteController@withdraw_pagination');
Route::get('/admin/super/offer', 'admin\AdminAffiliteController@super_offer');
Route::get('/admin/super/offer/pagination', 'admin\AdminAffiliteController@super_offerPagination');
Route::get('/admin/super/offer/delete/{id}', 'admin\AdminAffiliteController@super_offer_delete');
Route::get('/admin/super/offer/active/{id}', 'admin\AdminAffiliteController@super_offer_active');
Route::get('/admin/super/offer/inactive/{id}', 'admin\AdminAffiliteController@super_offer_inactive');
Route::get('/admin/wallet', 'admin\AdminAffiliteController@adminWallet');
Route::get('/admin/wallet/pagination', 'admin\AdminAffiliteController@adminWallet_pagination');
Route::get('/admin/wallet/show/{id}', 'admin\AdminAffiliteController@walletShow');
Route::post('/admin/wallet/show/{id}', 'admin\AdminAffiliteController@walletShowUpdate');
Route::get('/admin/affiliate/complain', 'admin\AdminAffiliteController@affiliateComplain');
Route::get('/admin/affilite/complain/pagination', 'admin\AdminAffiliteController@complainPagination');
Route::get('/admin/affilite/complainEdit/{id}', 'admin\AdminAffiliteController@complainEdit');
Route::post('/admin/affiliate/complainEditUpdate/{id}', 'admin\AdminAffiliteController@complainEditUpdate');

Route::get('/admin/chat', 'admin\AdminAffiliteController@chat');
Route::get('/getChatUser', 'admin\AdminAffiliteController@getChatUser');
Route::get('/admin/chat/{id}', 'admin\AdminAffiliteController@chat_user');
Route::get('/admin/message/message_status/{id}', 'admin\AdminAffiliteController@message_status_affiliate');
Route::get('/admin/message/messageConvert/{id}/{status}', 'admin\AdminAffiliteController@messageConvert');
Route::post('chatStoreFromAdmin', 'admin\AdminAffiliteController@sendChatMessage');



Route::get('/user/chat', 'admin\AffiliteController@chat');
Route::get('/getchat/fromAffilite', 'admin\AffiliteController@getchat');
Route::post('chatStoreFromAffiliate', 'admin\AffiliteController@sendChatMessage');
Route::get('admin/point/pay', 'admin\AdminAffiliteController@point_pay');
Route::get('admin/affilite/buy_products', 'admin\AffiliteController@buy_products');
Route::get('product/{id}', 'admin\AffiliteController@single_product');
Route::get('buy_products/products/pagination', 'admin\AffiliteController@buy_products_pagination');
Route::get('buy_products/pagination/category', 'admin\AffiliteController@buy_products_pagination_category');
Route::get('profile', 'admin\AffiliteController@profile');
Route::get('user/product/notification', 'admin\AffiliteController@productNotification');
Route::get('user/product/notification/pagination', 'admin\AffiliteController@pagination_productNotification');
Route::get('user/affilite/notification/seen/{id}', 'admin\AffiliteController@notificationSeen');
Route::get('/user/my/marketing/meterials', 'admin\AffiliteController@marketingMeterials');
Route::get('/getCouponCodeProductPrice/{id}', 'admin\AffiliteController@getCouponCodeProductPrice');
Route::get('/CouponCodeCheck/{id}', 'admin\AffiliteController@CouponCodeCheck');
Route::get('/couponDelete/{id}', 'admin\AffiliteController@couponDelete');
Route::post('/couponStore', 'admin\AffiliteController@couponStore');
Route::get('user/message', 'admin\AffiliteController@userMessage');
Route::get('user/message/seen/{id}', 'admin\AffiliteController@messageSeen');
Route::post('/user/my/marketing/meterials', 'admin\AffiliteController@marketingMeterialsStore');
Route::post('profile', 'admin\AffiliteController@profile_store');
Route::get('channedPassword', 'admin\AffiliteController@channedPassword');
Route::post('channedPassword', 'admin\AffiliteController@channedPassword');

Route::get('user/affilite/orderForCustomer', 'admin\AffiliteController@orderForCustomer');
Route::get('orderforCustomer/products/pagination', 'admin\AffiliteController@orderForCustomer_pagination');
Route::get('orderForCustomer/pagination/category', 'admin\AffiliteController@order_for_customer_pagination_category');
Route::get('/dasboard/status_changed', 'admin\AffiliteController@dasboard_status_changed');
Route::get('/admin/affilite/referrals', 'admin\AffiliteController@myreferrel');
Route::get('/admin/affilite/top_referrers', 'admin\AffiliteController@top_referrers');
Route::get('/admin/affilite/top_earner', 'admin\AffiliteController@top_earner');
Route::get('/user_chat_count', 'admin\AffiliteController@user_chat_count');
Route::get('/admin/affilite/referral_contest', 'admin\AffiliteController@referral_contest');
Route::get('/user/affilite/top/affiliates', 'admin\AffiliteController@topAffilites');
Route::get('/affiliate/complain', 'admin\AffiliteController@affiliateComplain');
Route::post('/affiliate/complainStore', 'admin\AffiliteController@complainStore');
Route::get('/order/product/show', 'admin\AffiliteController@orderProductShow');
Route::get('/user/affilite/supper', 'admin\AffiliteController@superOffer');
Route::get('/user/customers', 'admin\AffiliteController@customers');

Route::post('/user/superOffer', 'admin\AffiliteController@storeSuperOffer');
Route::get('admin/affilite/myreferrel/pagination', 'admin\AffiliteController@myreferrel_pagination');
Route::get('/sohoj-admin-login', 'admin\AdminController@sohoj_admin');
Route::get('admin/affilite/statistics', 'admin\AffiliteController@statistics');
Route::get('admin/affilite/earnings', 'admin\AffiliteController@earnings');
Route::get('user/teamSummary', 'admin\AffiliteController@teamSummary'); 
Route::get('admin/affilite/earning/pagination', 'admin\AffiliteController@earnings_pagination');
Route::get('admin/affilite/orderhistory', 'admin\AffiliteController@orderhistory');
Route::get('/affiliate/orderEditHistory/{order_id}', 'admin\AffiliteController@orderEditHistory');
Route::get('wallet', 'admin\AffiliteController@walletHistory');
Route::get('admin/affilite/orderhistory/{id}', 'admin\AffiliteController@orderhistoryDetails');
Route::post('admin/affilite/orderhistory/{id}', 'admin\AffiliteController@orderhistoryDetailsStore');
Route::get('admin/affilite/orderhistoryPagination', 'admin\AffiliteController@orderhistory_pagination');
Route::get('/order/paginationByOrderStatus', 'admin\AffiliteController@paginationByOrderStatus');
Route::get('user/product/link-generator', 'admin\AffiliteController@products');
Route::get('/user/tending/products', 'admin\AffiliteController@tendingProducts');
Route::get('user/tending/productPagination', 'admin\AffiliteController@tendingProductsPagination');
Route::get('user/product/hot-deals', 'admin\AffiliteController@hot_deals');
Route::get('user/product/share-code', 'admin\AffiliteController@share_code');
Route::get('pagination/user/product/hot-deals', 'admin\AffiliteController@pagination_hot_deals');
Route::get('products/pagination/hot', 'admin\AffiliteController@products_pagination_hot');
Route::get('products/pagination', 'admin\AffiliteController@products_pagination');
Route::get('products/pagination/category', 'admin\AffiliteController@products_pagination_category');
Route::get('products/pagination/category/hot', 'admin\AffiliteController@products_pagination_category_hot');
Route::get('product/link/id', 'admin\AffiliteController@product_link_id');
Route::get('admin/affilite/campaign', 'admin\AffiliteController@campaing');
Route::get('user/contest/{id}', 'admin\AffiliteController@contestResult');


Route::get('/pay_point_to_admin', 'admin\AffiliteController@pay_point_to_admin');
Route::get('/pay_point_to_admin_in_lavel_3', 'admin\AffiliteController@pay_point_to_admin_in_lavel_3');
Route::get('/withdraw', 'admin\AffiliteController@withdraw');
Route::get('/editmobile', 'admin\AffiliteController@editmobile');
Route::post('/mobile_update', 'admin\AffiliteController@mobile_store');
Route::post('/bank_update', 'admin\AffiliteController@bank_update');
Route::post('/money_transfer', 'admin\AffiliteController@money_transfer');
Route::post('/add-wallet/balance', 'admin\AffiliteController@addWalletBalance');
Route::get('/affilite/upgrade_2', 'admin\AffiliteController@upgrade_2');
Route::get('/affilite/upgrade_3', 'admin\AffiliteController@upgrade_3');
Route::post('/super/offer/save', 'admin\AffiliteController@super_offer_save');

/****=============== home page setting section    =====================  ******/
Route::get('admin/homepage/setting', 'admin\SettingController@homePageSetting');
Route::post('admin/homepage/setting', 'admin\SettingController@homePageSetting');
Route::get('admin/social/setting', 'admin\SettingController@socialSetting');
Route::get('admin/sponsor', 'admin\SettingController@sponsor');
Route::post('admin/sponsor', 'admin\SettingController@sponsorUpdate');

Route::get('admin/default/setting', 'admin\SettingController@defaultSetting');
Route::post('admin/default/setting', 'admin\SettingController@defaultSetting');
Route::post('admin/social/setting', 'admin\SettingController@socialSetting');


Route::get('admin/default/register-offer', 'admin\SettingController@registerOffer');
Route::post('admin/default/register-offer-submit', 'admin\SettingController@registerOfferSubmit');

Route::get('admin/default/bonus-offer', 'admin\SettingController@bonusOffer');
Route::post('admin/default/bonus-offer-submit', 'admin\SettingController@bonusOfferSubmit');

Route::get('admin/default/cashback-offer', 'admin\SettingController@cashbackOffer');
Route::post('admin/default/cashback-offer-submit', 'admin\SettingController@cashbackOfferSubmit');


/****=============== admin page section    =====================  ******/
Route::get('admin/pages', 'admin\PageController@index');
Route::get('admin/page/create', 'admin\PageController@create');
Route::post('admin/page/store', 'admin\PageController@store');
Route::post('admin/page/update/{id}', 'admin\PageController@update');
Route::get('admin/page/{id}', 'admin\PageController@edit');
Route::get('/admin/page/delete/{id}', 'admin\PageController@delete');
/****=============== admin education section    =====================  ******/
Route::get('admin/education-list', 'EducationController@index');
Route::get('admin/education/create', 'EducationController@create');
Route::post('admin/education/store', 'EducationController@store');
Route::post('admin/education/update/{id}', 'EducationController@update');
Route::get('admin/education-edit/{id}', 'EducationController@edit');
Route::get('/admin/education/delete/{id}', 'EducationController@delete');
Route::get('/admin/education/active/{id}', 'EducationController@education_active');
Route::get('/admin/education/inactive/{id}', 'EducationController@education_inactive');
Route::get('/affiliate/education', 'EducationController@font_education');
Route::get('/thank-you', 'HomeController@thankYou');
Route::get('/add-to-cart', 'HomeController@add_to_cart');
Route::get('/checkout', 'HomeController@checkout');
Route::get('/orderCustomer/checkout', 'HomeController@orderForCustomerCheckout');
Route::get('user/affilite/check/{id}', 'HomeController@userAffiliteCheck');
Route::post('/orderCustomer/checkout', 'HomeController@orderForCustomerCheckoutStore');
Route::post('/checkout', 'HomeController@checkoutStore');
Route::get('/check-vendor-cashback', 'HomeController@check_vendor_cashback');
Route::get('/admin/active/affiliate/{id}','admin\AdminController@activeUser');

Route::get('/affilite/email_check', 'HomeController@email_check');
Route::get('/', 'HomeController@login');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return  'done';
});

Route::get('/{id}', 'HomeController@page');







