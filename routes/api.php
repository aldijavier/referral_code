<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api')->group(function() {
    Route::post('/dummy', [ApiController::class, 'dummy']);
    Route::get('ref-promo', [ApiController::class, 'GetAllReferralPromo']);
    Route::get('ref-agent', [ApiController::class, 'GetAllReferralAgent']);
    Route::get('ref-agentext', [ApiController::class, 'GetAllReferralAgentExt']);
});


// Route::apiResource('dashboard', 'Api\DashboardController@index');
// Route::apiResource('members', 'Api\MembersController@index');
// Route::apiResource('ref-promo', 'ApiController@GetAllReferralPromo');
// Route::apiResource('ref-agent', 'ApiController@GetAllReferralAgent');
// Route::apiResource('ref-agentext', 'ApiController@GetAllReferralAgentExt');

