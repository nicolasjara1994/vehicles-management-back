<?php

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\UserVehicleController;

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

Route::middleware('auth:sanctum')->get('/post/create', function (Request $request) {
    return [
        "id" => 1,
        "title" => $request->title,
        "content" => $request->content,
    ];
});

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->input('email'))->first();
    
    if (!$user || !Hash::check($request->password, $user->password) ) {
        return response()->json([
            'message' =>'Credenciales incorrectas',

        ], 401);
    }

    return response()->json([
        'user' => [
            'name' => $user->name,
            'email' => $user->email,
        ],
        'token' => $user->createToken('api')->plainTextToken,
    ]);
});


 
Route::get('/vehicles/{id}/data/', [VehicleController::class, 'show']);
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::post('/vehicles', [VehicleController::class, 'storeMultiple']);

Route::get('/user-vehicles/{id}', [UserVehicleController::class, 'show']);
Route::get('/user-vehicles', [UserVehicleController::class, 'index']);
Route::post('/user-vehicles', [UserVehicleController::class, 'storeMultiple']);
