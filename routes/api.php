<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::get('/logout', 'logout')->middleware('auth:api');
    });
    Route::middleware('auth:api')->group(function () {
        Route::get('/user', 'getInfoUserAuth');
        Route::post('/user/update', 'updateUserAuth');

        Route::middleware('role:admin')->group(function () {
            Route::get('/users', 'index');
            Route::post('/user/{user}/update', 'update');
        });
    });
});

Route::controller(\App\Http\Controllers\CategoryServiceController::class)->group(function () {
    Route::prefix('category-service')->group(function () {
        Route::get('/', 'index');

        Route::middleware('auth:api')->group(function () {
            Route::middleware('role:admin')->group(function () {
                Route::post('/store', 'store');
                Route::post('/{categoryService}/update', 'update');
                Route::get('/{categoryService}/destroy', 'destroy');
            });
        });
    });
});

Route::controller(\App\Http\Controllers\TypeServiceController::class)->group(function () {
    Route::prefix('type-service')->group(function () {
        Route::get('/', 'index');

        Route::middleware('auth:api')->group(function () {
            Route::middleware('role:admin')->group(function () {
                Route::post('/store', 'store');
                Route::post('/{typeService}/update', 'update');
                Route::get('/{typeService}/destroy', 'destroy');
            });
        });
    });
});

Route::controller(\App\Http\Controllers\StatusServiceController::class)->group(function () {
    Route::prefix('status-service')->group(function () {
        Route::get('/', 'index');
    });
});

Route::controller(\App\Http\Controllers\RoleController::class)->group(function () {
    Route::prefix('role')->group(function () {
        Route::get('/', 'index');
    });
});

Route::controller(\App\Http\Controllers\AppealController::class)->group(function () {
    Route::prefix('appeal')->group(function () {
        Route::middleware('auth:api')->group(function () {
            Route::get('/personal', 'personal');
            Route::post('/', 'store');

            Route::middleware('role:admin|manager')->group(function () {
                Route::get('/', 'index');
                Route::get('/{appeal}', 'show');
                Route::post('/{appeal}/update', 'update');
            });

            Route::middleware('role:admin')->group(function () {
                Route::get('/destroy', 'destroy');
            });

        });
    });
});
