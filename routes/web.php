<?php

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
Route::group(['middleware'=>'auth'], function(){

    Route::get('/', "DashboardController@index");
    // user oute
    Route::get('user', 'UserController@index');
    Route::get('user/create', 'UserController@create');
    Route::get('user/delete/{id}', 'UserController@delete');
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::post('user/save', 'UserController@save');
    Route::post('user/update', 'UserController@update');

    // role route
    Route::get('role', 'RoleController@index');
    Route::get('role/create', 'RoleController@create');
    Route::get('role/edit/{id}', 'RoleController@edit');
    Route::get('role/delete/{id}', 'RoleController@delete');
    Route::get('role/detail/{id}', 'RoleController@detail');
    Route::post('role/save', 'RoleController@save');
    Route::post('role/update', 'RoleController@update');
    Route::post('role/permission/save', 'RoleController@save_permission');

    Route::get('user/logout', 'UserController@logout');
    // category route
    Route::resource('category', 'CategoryController')
        ->except(['show', 'destroy']);
    Route::get('category/delete/{id}', 'CategoryController@delete');
    // warehouse
    Route::resource('warehouse', 'WarehouseController')
        ->except(['show','destroy']);
    Route::get('warehouse/delete/{id}', 'WarehouseController@delete');
    // unit
    Route::resource('unit', 'UnitController')
        ->except(['show', 'destroy']);
    Route::get('unit/delete/{id}', 'UnitController@delete');
    // product
    Route::resource('product', 'ProductController')
        ->except(['show', 'destroy']);
    Route::get('product/detail/{id}', 'ProductController@detail');
    Route::get('product/delete/{id}', 'ProductController@delete');
    Route::post('product/import', 'ProductController@import');
    Route::post('product/category/save', 'ProductController@save_category');
    Route::post('product/unit/save', 'ProductController@save_unit');

    // Route stock in
    Route::get('stock-in', 'StockInController@index');
    Route::get('stock-in/create', 'StockInController@create');
    Route::get('stock-in/detail/{id}', 'StockInController@detail');
    Route::post('stock-in/save', 'StockInController@save');
    Route::get('stock-in/delete/{id}', 'StockInController@delete');
    Route::get('stock-in/print/{id}', 'StockInController@print');
    Route::post('stock-in/master/save', 'StockInController@save_master');
    Route::get('stock-in/item/delete/{id}', 'StockInController@delete_item');
    Route::post('stock-in/item/save', 'StockInController@save_item');

    // stock out
    Route::resource('stockout', 'StockOutController')
        ->except(['destroy', 'show']);
    Route::get('stockout/detail/{id}', 'StockOutController@detail')
        ->name('stockout.detail');
    Route::post('stockout/master/save', 'StockOutController@save_master');
    Route::get('stockout/delete/{id}', 'StockOutController@delete');
    Route::post('stockout/item/save', 'StockOutController@save_item');
    Route::get('stockout/item/delete/{id}', 'StockOutController@delete_item');
    // scrap
    Route::get('scrap', 'ScrapController@index');
    Route::get('scrap/create', 'ScrapController@create');
    Route::post('scrap/save', 'ScrapController@save');
    // report
    Route::get('report/balance', 'ReportController@stock_balance');
    Route::get('report/balance/search', 'ReportController@stock_balance_search');
    Route::get('report/balance/print', 'ReportController@stock_balance_print');

    Route::get('report/balance/warehouse', 'ReportController@stock_balance_warehouse');
    Route::get('report/balance/warehouse/print', 'ReportController@stock_balance_warehouse_print');
    // stock in report
    Route::get('report/in', 'ReportController@in');
    Route::get('report/in/search', 'ReportController@in_search');
    Route::get('report/in/print', 'ReportController@in_print');
    // stock out report
    Route::get('report/out', 'ReportController@out');
    Route::get('report/out/search', 'ReportController@out_search');
    Route::get('report/out/print', 'ReportController@out_print');
});

Auth::routes();


