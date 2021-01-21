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

Route::get('/', function () {
    return view('homeee');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sales', 'SalesController@index')->name('sales.create');
Route::get('/purchases', 'PurchasesController@index')->name('purchases.create');
Route::get('/transactions', 'TransactionsController@index')->name('transactions.create');


Route::post('customer_info', 'CustomersController@customer_info')->name('customer_info');
Route::post('user_info', 'UserController@user_info')->name('user_info');
Route::post('supplier_info', 'SuppliersController@supplier_info')->name('supplier_info');
Route::post('product_info', 'SalesController@product_info')->name('product_info');
Route::post('official_info', 'OfficialController@official_info')->name('official_info');
Route::post('official_type_info', 'OfficialTypeController@official_type_info')->name('official_type_info');
Route::post('customer_id', 'CustomersController@customer_id')->name('customer_id');
Route::post('customer_select_box', 'CustomersController@customer_select_box')->name('customer_select_box');
Route::post('supplier_select_box', 'SuppliersController@supplier_select_box')->name('supplier_select_box');
Route::post('product_select_box', 'ProductsController@product_select_box')->name('product_select_box');
Route::post('category_select_box', 'CategoriesController@category_select_box')->name('category_select_box');
Route::post('category_product', 'CategoriesController@category_product')->name('category_product');
Route::post('brand_product', 'BrandsController@brand_product')->name('brand_product');
Route::post('brand_select_box', 'BrandsController@brand_select_box')->name('brand_select_box');

Route::resource('sales','SalesController');
Route::resource('customers','CustomersController');
Route::resource('suppliers','SuppliersController');
Route::resource('purchases','PurchasesController');
Route::resource('transactions','TransactionsController');
Route::resource('products','ProductsController');
Route::resource('categories','CategoriesController');
Route::resource('brands','BrandsController');
Route::resource('official_types','OfficialTypeController');
Route::resource('officials','OfficialController');
Route::resource('users','UserController');

Route::post('product_id', 'ProductsController@product_id')->name('product_id');
Route::post('supplier_id', 'SuppliersController@supplier_id')->name('supplier_id');
Route::post('users_id', 'UserController@users_id')->name('users_id');
Route::post('transaction_id', 'TransactionsController@transaction_id')->name('transaction_id');
Route::post('account_select_box', 'TransactionsController@account_select_box')->name('account_select_box');
Route::post('account_info_select_box', 'TransactionsController@account_info_select_box')->name('account_info_select_box');
Route::post('sales_invoice_create', 'SalesController@sales_invoice_create')->name('sales_invoice_create');
Route::post('purchase_invoice_create', 'PurchasesController@purchase_invoice_create')->name('purchase_invoice_create');

Route::post('sales_grid', 'SalesController@grid')->name('sales.grid');
Route::post('purchases_grid', 'PurchasesController@grid')->name('purchases.grid');
Route::post('products_grid', 'ProductsController@grid')->name('products.grid');
Route::post('customers_grid', 'CustomersController@grid')->name('customers.grid');
Route::post('suppliers_grid', 'SuppliersController@grid')->name('suppliers.grid');
Route::post('officials_grid', 'OfficialController@grid')->name('officials.grid');
Route::post('official_types_grid', 'OfficialTypeController@grid')->name('official_types.grid');
Route::post('transactions_grid', 'TransactionsController@grid')->name('transactions.grid');
Route::post('users_grid', 'UserController@grid')->name('users.grid');
Route::post('users_activity_grid', 'UserController@activity_grid')->name('users.activity.grid');
Route::post('sidebar', 'UserController@sidebar_view')->name('sidebar');
Route::post('user_rights', 'UserController@user_rights')->name('user_rights');
Route::any('sales_print', 'SalesController@sales_print')->name('sales_print');
Route::any('purchase_print', 'PurchasesController@purchase_print')->name('purchase_print');
Route::any('grid_sales_print', 'SalesController@grid_sales_print')->name('grid_sales_print');
Route::any('grid_purchase_print', 'PurchasesController@grid_purchase_print')->name('grid_purchase_print');
Route::any('sales_email', 'SalesController@sales_email')->name('sales.email');
Route::post('products_update_price', 'ProductsController@products_update_price')->name('products_update_price');
Route::post('customer_update', 'CustomersController@customer_update')->name('customer_update');
Route::post('user_update', 'UserController@user_update')->name('user_update');
Route::any('activity', 'UserController@activity')->name('users.activity');
