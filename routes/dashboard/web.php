<?php

// Dashboard routes

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
            // Clients routes
            Route::resource('clients', 'ClientsController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrdersController');
            // Orders routes
            Route::resource('orders', 'OrdersController');
            Route::get('/orders/{order}/products', 'OrdersController@products')->name('orders.products');
            // Users routes
            Route::resource('users', 'UsersController')->except(['show']);
        }); // End dashboard routes
    }
); // end localization group routes
