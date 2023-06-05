<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

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

//Api route
route::get('student',[StudentController::class,'index']);
route::post('student',[StudentController::class,'store']);
route::get('student/{id}',[StudentController::class,'show']);
route::get('student/{id}/edit',[StudentController::class,'edit']);
route::put('student/{id}/edit',[StudentController::class,'update']);
route::delete('student/{id}/delete',[StudentController::class,'delete']);
