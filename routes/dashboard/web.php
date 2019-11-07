<?php

// Dashboard routes

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('dashboard')->name('dashboard.')->group(function () {

            Route::get('index', 'DashboardController@index')->name('index');

            // Users routes
            Route::resource('users', 'UsersController')->except(['show']);
        }); // End dashboard routes
    }
); // end localization group routes
