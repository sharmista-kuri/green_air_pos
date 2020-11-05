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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sales', 'SalesController@index')->name('sales.create');
Route::get('/purchases', 'PurchasesController@index')->name('purchases.create');
Route::get('/transactions', 'TransactionsController@index')->name('transactions.create');


Route::post('customer_info', 'CustomersController@customer_info')->name('customer_info');
Route::post('supplier_info', 'SuppliersController@supplier_info')->name('supplier_info');
Route::post('product_info', 'SalesController@product_info')->name('product_info');
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

Route::post('product_id', 'ProductsController@product_id')->name('product_id');
Route::post('supplier_id', 'SuppliersController@supplier_id')->name('supplier_id');
Route::post('transaction_id', 'TransactionsController@transaction_id')->name('transaction_id');
Route::post('account_select_box', 'TransactionsController@account_select_box')->name('account_select_box');
Route::post('account_info_select_box', 'TransactionsController@account_info_select_box')->name('account_info_select_box');

Route::post('sales_grid', 'SalesController@grid')->name('sales.grid');
Route::any('sales_print', 'SalesController@sales_print')->name('sales_print');