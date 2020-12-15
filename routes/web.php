<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'viewHome']);
Route::post('/', [MessageController::class, 'store']);

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('galleries')->name('galleries/')->group(static function() {
            Route::get('/',                                             'GalleriesController@index')->name('index');
            Route::get('/create',                                       'GalleriesController@create')->name('create');
            Route::post('/',                                            'GalleriesController@store')->name('store');
            Route::get('/{gallery}/edit',                               'GalleriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'GalleriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{gallery}',                                   'GalleriesController@update')->name('update');
            Route::delete('/{gallery}',                                 'GalleriesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('trainers')->name('trainers/')->group(static function() {
            Route::get('/',                                             'TrainersController@index')->name('index');
            Route::get('/create',                                       'TrainersController@create')->name('create');
            Route::post('/',                                            'TrainersController@store')->name('store');
            Route::get('/{trainer}/edit',                               'TrainersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TrainersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{trainer}',                                   'TrainersController@update')->name('update');
            Route::delete('/{trainer}',                                 'TrainersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('abouts')->name('abouts/')->group(static function() {
            Route::get('/',                                             'AboutsController@index')->name('index');
            Route::get('/create',                                       'AboutsController@create')->name('create');
            Route::post('/',                                            'AboutsController@store')->name('store');
            Route::get('/{about}/edit',                                 'AboutsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'AboutsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{about}',                                     'AboutsController@update')->name('update');
            Route::delete('/{about}',                                   'AboutsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('banners')->name('banners/')->group(static function() {
            Route::get('/',                                             'BannersController@index')->name('index');
            Route::get('/create',                                       'BannersController@create')->name('create');
            Route::post('/',                                            'BannersController@store')->name('store');
            Route::get('/{banner}/edit',                                'BannersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'BannersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{banner}',                                    'BannersController@update')->name('update');
            Route::delete('/{banner}',                                  'BannersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('messages')->name('messages/')->group(static function() {
            Route::get('/',                                             'MessagesController@index')->name('index');
            Route::get('/create',                                       'MessagesController@create')->name('create');
            Route::post('/',                                            'MessagesController@store')->name('store');
            Route::get('/{message}/edit',                               'MessagesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'MessagesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{message}',                                   'MessagesController@update')->name('update');
            Route::delete('/{message}',                                 'MessagesController@destroy')->name('destroy');
        });
    });
});