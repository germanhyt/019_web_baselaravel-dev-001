<?php

// use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. 
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// 2.
// Route::get("/students", function () {
//     return response()->json([
//         "message" => "GET / Students List"
//     ]);
// });

// 3.
use App\Http\Controllers\studentController;

Route::get("/students",  [studentController::class, 'index']);

Route::get("/students/{id}", [
    studentController::class, 'show'
]);

// 1. 
// Route::post("/students", function () {
//     return response()->json([
//         "message" => "POST / Student Create"
//     ]);
// });

// 2.
Route::post("/students", [
    studentController::class, 'store'
]);

// 1.
// Route::put("/students/{id}", function ($id) {
//     return response()->json([
//         "message" => "PUT / Student Update by Id"
//     ]);
// });

// 2.
Route::put("/students/{id}", [
    studentController::class, 'update'
]);

Route::patch("/students/{id}", [
    studentController::class, 'updatePartial'
]);


Route::delete("students/{id}", [
    studentController::class, 'destroy'
]);


// Auth

Route::post('/login', [
    AuthController::class, 'login'
]);

Route::post("/register", [
    AuthController::class, 'register'
]);

Route::post("/logout", [
    AuthController::class, 'logout'
]);
