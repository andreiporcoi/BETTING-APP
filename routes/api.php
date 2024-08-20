<?php

use App\Http\Controllers\AdminConfigController;
use App\Http\Controllers\ApiAds;
use App\Http\Controllers\ApiAuthUser;
use App\Http\Controllers\ApiCoin;
use App\Http\Controllers\ApiInvestment;
use App\Http\Controllers\ApiInvestmentHistory;
use App\Http\Controllers\ApiNotifications;
use App\Http\Controllers\ApiPackage;
use App\Http\Controllers\ApiPackageHistory;
use App\Http\Controllers\ApiPayouts;
use App\Http\Controllers\ApiSubInvest;
use App\Http\Controllers\ApiSubscription;
use App\Http\Controllers\ApiTips;
use App\Http\Controllers\ApiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//! User

//?Public
Route::post('/register', [ApiAuthUser::class, 'register']);
Route::post('/can-register', [ApiAuthUser::class, 'canRegister']);
Route::post('/login', [ApiAuthUser::class, 'login']);
Route::get('admin-configs', [AdminConfigController::class, 'index']);
    Route::get('ads/{adsType}', [ApiAds::class, 'adsGet']);
    Route::get('tips/{type}/{sportDate}', [ApiTips::class, 'index']);
    Route::get('package/{type}', [ApiPackage::class, 'index']);

//? Protected
Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/users', [User::class,'index']);
    // Route::post('/users', [User::class,'store']);
    // Route::get('/users/profile', [User::class,'show']);
    // Route::put('/users/update', [User::class,'update']);
    // Route::delete('/users/delete', [User::class,'destroy']);
    Route::post('updatePassword', [ApiAuthUser::class, 'updatePassword']);
    Route::post('logout', [ApiAuthUser::class, 'logout']);
    Route::get('user', [ApiAuthUser::class, 'getUser']);
    Route::get('sub-invest/{type}', [ApiSubInvest::class, 'index']);

});

Route::middleware('auth:sanctum')->group(function () {
    // Route::apiResource('ads', ApiAds::class);
    Route::get('tips/{sportId}/{sportDate}', [
        ApiTips::class,
        'purchasedTipsFxn',
    ]);
    Route::post('tips', [ApiTips::class, 'store']);
    Route::post('notification_tokens', [ApiNotifications::class, 'store']);

    Route::get('package-history/{type}', [ApiPackageHistory::class, 'index']);

    Route::get('investment-history', [ApiInvestmentHistory::class, 'index']);
    // Route::apiResource('investment', ApiInvestment::class);
        Route::post('investment', [ApiInvestment::class, 'store']);
    Route::post('investImage', [ApiInvestment::class, 'imageUpload']);

    Route::apiResource('coins', ApiCoin::class);
    // Route::apiResource('package/{type}', ApiPackage::class);
    // Route::apiResource('package-history/{type}', ApiPackageHistory::class);
    Route::apiResource('payouts', ApiPayouts::class);
    Route::apiResource('subscriptions', ApiSubscription::class);
    // Route::apiResource('tips', ApiTips::class);
    // Route::apiResource('user', ApiUser::class);
});
