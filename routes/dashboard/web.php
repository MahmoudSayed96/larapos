<?php

// Dashboard routes

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('index', 'DashboardController@index')->name('index');

            // Users routes
            Route::resource('users', 'UsersController')->except(['show']);

            // categories routes
            Route::resource('categories', 'CategoriesController');
        }); // End dashboard routes
    }
); // end localization group routes
