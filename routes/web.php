<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Setting\SupplierController;
use App\Http\Controllers\Setting\CategoryController;
use App\Http\Controllers\Setting\LocationController;
use App\Http\Controllers\Setting\BuildingController;
use App\Http\Controllers\Setting\PaymentSpaController;
use App\Http\Controllers\ItemController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/admin',function(){
        return Inertia::render('Admin/Panel');
    })->name('admin');
    Route::prefix('settings')->group(function(){
        Route::get('/',function(){
            return Inertia::render('Setting/Settings');
        })->name('settings');
        Route::resource('/supplier',SupplierController::class);
        Route::resource('/category',CategoryController::class);
        Route::resource('/location',LocationController::class);
        Route::resource('/building',BuildingController::class);
        Route::resource('/payments',PaymentSpaController::class);
    });

    Route::prefix('item')->group(function(){
        Route::get('/dashboard',function(){
            return Inertia::render('Item/Item');
        });
        Route::resource('/', ItemController::class);
        Route::get('/checkin', [ItemController::class, 'checkin']);
    });

});



