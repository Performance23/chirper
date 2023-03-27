<?php

use App\Models\User;
use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/posts', function () {
    return Chirp::latest()->with('user')->get();
});
Route::post('/posts', function (Request $request) {

    $validated = $request->validate([
        'message' => 'required|string|max:255',
    ]);
    $user = User::find(1);
    $user->chirps()->create($validated);
    return response([
        'message' => 'Chirp creer avec success'
    ]);
});
Route::post('/login-mobile', [AuthenticatedSessionController::class, 'storeMobile']);
require __DIR__ . '/auth.php';
