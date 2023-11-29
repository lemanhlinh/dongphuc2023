<?php
# @Author: Manh Linh
# @Date:   2023-01-01T17:33:09+07:00
# @Email:  lemanhlinh209@gmail.com
# @Last modified by:   Manh Linh
# @Last modified time: 2023-01-01T16:49:02+07:00
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::group(['namespace' => 'Web'], function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/danh-muc/{slug}.html', 'ArticleController@cat')->name('catArticle');
    Route::get('/{cat_slug}/chi-tiet-tin/{slug}.html', 'ArticleController@detail')->name('detailArticle');
    Route::get('/lien-he.html', 'ContactController@index')->name('contact');
    Route::get('/trang-tinh/{slug}.html', 'PageController@index')->name('detailPage');
    Route::get('/san-pham/{slug}.html', 'ProductController@cat')->name('catProduct');
    Route::get('/san-pham/{cat_slug}/{slug}.html', 'ProductController@detail')->name('detailProduct');
    Route::get('/gio-hang.html', 'ProductController@showCart')->name('showCart');
    Route::get('/xoa-san-pham/{id}', 'ProductController@removeItem')->name('removeItem');
    Route::post('/them-vao-gio-hang', 'ProductController@addToCart')->name('addToCart');
    Route::post('/update-gio-hang', 'ProductController@updateCart')->name('updateCart');
    Route::post('/order', 'ProductController@order')->name('order');
    Route::post('/lien-he', 'ContactController@store')->name('detailContactStore');
    Route::post('/nhan-bao-gia', 'ProductController@contactProduct')->name('contactProduct');
    Route::post('/saveQuote', 'ProductController@saveQuote')->name('saveQuote');
});

//Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//    ->name('ckfinder_connector');
//
//Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//    ->name('ckfinder_browser');

//Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//    ->name('ckfinder_examples');

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/change-profile', 'UserController@getProfile')->name('getProfile');
    Route::post('/change-profile', 'UserController@changeProfile')->name('changeProfile');
    Route::get('/change-password', 'UserController@changePassword')->name('changePassword');
    Route::post('/update-password', 'UserController@updatePassword')->name('updatePassword');

    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['permission:view_user']], function () {
        Route::get('', 'UserController@index')->name('index');
        Route::get('/create', 'UserController@create')->name('create')->middleware('permission:create_user');
        Route::post('/store', 'UserController@store')->name('store')->middleware('permission:create_user');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit')->middleware('permission:edit_user');
        Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('permission:edit_user');
        Route::post('/destroy/{id}', 'UserController@destroy')->name('destroy')->middleware('permission:delete_user');
    });

    Route::group(['prefix' => 'roles', 'as' => 'roles.', 'middleware' => ['can:view_role']], function () {
        Route::get('', 'RoleController@index')->name('index');
        Route::get('/create', 'RoleController@create')->name('create')->middleware('permission:create_role');
        Route::post('/store', 'RoleController@store')->name('store')->middleware('permission:create_role');
        Route::get('/edit/{id}', 'RoleController@edit')->name('edit')->middleware('permission:edit_role');
        Route::post('/update/{id}', 'RoleController@update')->name('update')->middleware('permission:edit_role');
        Route::post('/destroy/{id}', 'RoleController@destroy')->name('destroy')->middleware('permission:delete_role');
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'middleware' => ['permission:view_setting']], function () {
        Route::get('', 'SettingController@index')->name('index');
        Route::get('/create', 'SettingController@create')->name('create')->middleware('permission:create_setting');
        Route::post('/store', 'SettingController@store')->name('store')->middleware('permission:create_setting');
        Route::get('/edit/{id}', 'SettingController@edit')->name('edit')->middleware('permission:edit_setting');
        Route::post('/update/{id}', 'SettingController@update')->name('update')->middleware('permission:edit_setting');
        Route::post('/destroy/{id}', 'SettingController@destroy')->name('destroy')->middleware('permission:delete_setting');
    });

    Route::group(['prefix' => 'menu-category', 'as' => 'menu-category.', 'middleware' => ['permission:view_menu_categories']], function () {
        Route::get('', 'MenuCategoryController@index')->name('index');
        Route::get('/create', 'MenuCategoryController@create')->name('create')->middleware('permission:create_menu_categories');
        Route::post('/store', 'MenuCategoryController@store')->name('store')->middleware('permission:create_menu_categories');
        Route::get('/edit/{id}', 'MenuCategoryController@edit')->name('edit')->middleware('permission:edit_menu_categories');
        Route::post('/update/{id}', 'MenuCategoryController@update')->name('update')->middleware('permission:edit_menu_categories');
        Route::post('/destroy/{id}', 'MenuCategoryController@destroy')->name('destroy')->middleware('permission:delete_menu_categories');
        Route::post('/update-tree', 'MenuCategoryController@updateTree')->name('updateTree')->middleware('permission:edit_menu_categories');
    });


    Route::group(['prefix' => 'menu', 'as' => 'menu.', 'middleware' => ['permission:view_menu']], function () {
        Route::get('', 'MenuController@index')->name('index');
//        Route::get('/create', 'MenuController@create')->name('create')->middleware('permission:create_menu');
        Route::post('/store', 'MenuController@store')->name('store')->middleware('permission:create_menu');
//        Route::get('/edit/{id}', 'MenuController@edit')->name('edit')->middleware('permission:edit_menu');
        Route::post('/update/{id}', 'MenuController@update')->name('update')->middleware('permission:edit_menu');
        Route::post('/destroy/{id}', 'MenuController@destroy')->name('destroy')->middleware('permission:delete_menu');
        Route::post('/update-tree', 'MenuController@updateTree')->name('updateTree')->middleware('permission:edit_menu');
    });

    Route::group(['prefix' => 'page', 'as' => 'page.', 'middleware' => ['permission:view_page']], function () {
        Route::get('', 'PageController@index')->name('index');
        Route::get('/create', 'PageController@create')->name('create')->middleware('permission:create_page');
        Route::post('/store', 'PageController@store')->name('store')->middleware('permission:create_page');
        Route::get('/edit/{id}', 'PageController@edit')->name('edit')->middleware('permission:edit_page');
        Route::post('/update/{id}', 'PageController@update')->name('update')->middleware('permission:edit_page');
        Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy')->middleware('permission:delete_page');
        Route::post('/change-active-page/{id}', 'PageController@changeActive')->name('changeActive')->middleware('permission:edit_page');
    });

    Route::group(['prefix' => 'contact', 'as' => 'contact.', 'middleware' => ['permission:view_contact']], function () {
        Route::get('', 'ContactController@index')->name('index');
    });

    Route::group(['prefix' => 'article-category', 'as' => 'article-category.', 'middleware' => ['permission:view_article_categories']], function () {
        Route::get('', 'ArticlesCategoriesController@index')->name('index');
        Route::get('/create', 'ArticlesCategoriesController@create')->name('create')->middleware('permission:create_article_categories');
        Route::post('/store', 'ArticlesCategoriesController@store')->name('store')->middleware('permission:create_article_categories');
        Route::get('/edit/{id}', 'ArticlesCategoriesController@edit')->name('edit')->middleware('permission:edit_article_categories');
        Route::post('/update/{id}', 'ArticlesCategoriesController@update')->name('update')->middleware('permission:edit_article_categories');
        Route::post('/destroy/{id}', 'ArticlesCategoriesController@destroy')->name('destroy')->middleware('permission:delete_article_categories');
        Route::post('/change-active-article-cat/{id}', 'ArticlesCategoriesController@changeActive')->name('changeActive')->middleware('permission:edit_article_categories');
    });

    Route::group(['prefix' => 'articles', 'as' => 'article.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'ArticleController@index')->name('index');
        Route::get('/create', 'ArticleController@create')->name('create')->middleware('permission:create_article');
        Route::post('/store', 'ArticleController@store')->name('store')->middleware('permission:create_article');
        Route::get('/edit/{id}', 'ArticleController@edit')->name('edit')->middleware('permission:edit_article');
        Route::post('/update/{id}', 'ArticleController@update')->name('update')->middleware('permission:edit_article');
        Route::post('/destroy/{id}', 'ArticleController@destroy')->name('destroy')->middleware('permission:delete_article');
        Route::post('/change-active-article/{id}', 'ArticleController@changeActive')->name('changeActive')->middleware('permission:edit_article');
        Route::post('/change-is-home-article/{id}', 'ArticleController@changeIsHome')->name('changeIsHome')->middleware('permission:edit_article');
    });

    Route::group(['prefix' => 'product-category', 'as' => 'product-category.', 'middleware' => ['permission:view_product_categories']], function () {
        Route::get('', 'ProductsCategoriesController@index')->name('index');
        Route::get('/create', 'ProductsCategoriesController@create')->name('create')->middleware('permission:create_product_categories');
        Route::post('/store', 'ProductsCategoriesController@store')->name('store')->middleware('permission:create_product_categories');
        Route::get('/sort', 'ProductsCategoriesController@sort')->name('sort')->middleware('permission:create_product_categories');
        Route::get('/edit/{id}', 'ProductsCategoriesController@edit')->name('edit')->middleware('permission:edit_product_categories');
        Route::post('/update/{id}', 'ProductsCategoriesController@update')->name('update')->middleware('permission:edit_product_categories');
        Route::post('/destroy/{id}', 'ProductsCategoriesController@destroy')->name('destroy')->middleware('permission:delete_product_categories');
        Route::post('/update-tree-product', 'ProductsCategoriesController@updateTree')->name('updateTree')->middleware('permission:edit_product_categories');
        Route::post('/change-active-product-cat/{id}', 'ProductsCategoriesController@changeActive')->name('changeActive')->middleware('permission:edit_product_categories');
        Route::post('/change-is-home-product-cat/{id}', 'ProductsCategoriesController@changeIsHome')->name('changeIsHome')->middleware('permission:edit_product_categories');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['permission:view_product']], function () {
        Route::get('', 'ProductController@index')->name('index');
        Route::get('/create', 'ProductController@create')->name('create')->middleware('permission:create_product');
        Route::post('/store', 'ProductController@store')->name('store')->middleware('permission:create_product');
        Route::get('/edit/{id}', 'ProductController@edit')->name('edit')->middleware('permission:edit_product');
        Route::post('/update/{id}', 'ProductController@update')->name('update')->middleware('permission:edit_product');
        Route::post('/destroy/{id}', 'ProductController@destroy')->name('destroy')->middleware('permission:delete_product');
    });

    Route::group(['prefix' => 'order-product', 'as' => 'order-product.', 'middleware' => ['permission:view_product_orders']], function () {
        Route::get('', 'OrderController@index')->name('index');
        Route::get('/create', 'OrderController@create')->name('create')->middleware('permission:create_product_orders');
        Route::post('/store', 'OrderController@store')->name('store')->middleware('permission:create_product_orders');
        Route::get('/edit/{id}', 'OrderController@edit')->name('edit')->middleware('permission:edit_product_orders');
        Route::post('/update/{id}', 'OrderController@update')->name('update')->middleware('permission:edit_product_orders');
        Route::post('/destroy/{id}', 'OrderController@destroy')->name('destroy')->middleware('permission:delete_product_orders');
    });

    Route::group(['prefix' => 'slider', 'as' => 'slider.', 'middleware' => ['permission:view_slider']], function () {
        Route::get('', 'SliderController@index')->name('index');
        Route::get('/create', 'SliderController@create')->name('create')->middleware('permission:create_slider');
        Route::post('/store', 'SliderController@store')->name('store')->middleware('permission:create_slider');
        Route::get('/edit/{id}', 'SliderController@edit')->name('edit')->middleware('permission:edit_slider');
        Route::post('/update/{id}', 'SliderController@update')->name('update')->middleware('permission:edit_slider');
        Route::post('/destroy/{id}', 'SliderController@destroy')->name('destroy')->middleware('permission:delete_slider');
        Route::post('/change-active-slider/{id}', 'SliderController@changeActive')->name('changeActive')->middleware('permission:edit_slider');
    });
});


