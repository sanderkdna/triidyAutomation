<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'

], function ($router) {
    Route::post('/userconnect',[UserController::class, 'index'])->name('index');
    Route::post('/createproduct',[UserController::class, 'createProduct'])->name('index');
    Route::post('/webhook/',[UserController::class, 'callBack'])->name('webhook');



});
