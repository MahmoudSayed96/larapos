<?php

// Dashboard routes

use Illuminate\Support\Facades\Route;
use Milon\Barcode\DNS1D;

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
            // Dashboard  routes
            Route::get('/', 'WelcomeController@index')->name('welcome');
            // Categories routes
            Route::resource('categories', 'CategoriesController');
            // Products routes
            Route::resource('products', 'ProductsController');
            Route::get('/show-products','ProductsController@productsList')->name('products.list');
            // Clients routes
            Route::resource('clients', 'ClientsController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrdersController');
            // Orders routes
            Route::resource('orders', 'OrdersController');
            Route::get('/orders/{order}/products', 'OrdersController@products')->name('orders.products');
            // Users routes
            Route::resource('users', 'UsersController')->except(['show']);
            // Stock routes
            Route::get('stock','StockController@index')->name('stock.index');
            // Reports
            Route::get('/reports/sales','ReportController@sales')->name('reports.sales');
        }); // End dashboard routes
    }
); // end localization group routes
