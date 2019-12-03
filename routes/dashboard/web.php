<?php

// Dashboard routes

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
            // Dashboard  routes
            Route::get('index', 'DashboardController@index')->name('index');
            // Categories routes
            Route::resource('categories', 'CategoriesController');
            // Products routes
            Route::resource('products', 'ProductsController');
            // Clients routes
            Route::resource('clients', 'ClientsController')->except(['show']);
            // Users routes
            Route::resource('users', 'UsersController')->except(['show']);
        }); // End dashboard routes
    }
); // end localization group routes
