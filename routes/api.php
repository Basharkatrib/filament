<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\User;
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

// routes/api.php

use App\Http\Controllers\StripeController;

Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return User::all();
});


Route::post('/signup', [AuthController::class, 'signup']);


Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', [AuthController::class, 'user']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/products', [ProductController::class, 'index']);




