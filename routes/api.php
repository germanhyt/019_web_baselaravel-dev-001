<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get("/students", function () {
    return response()->json([
        "message" => "GET / Students List"
    ]);
});

Route::get("/students/{id}", function () {
    return response()->json([
        "message" => "GET / Student by Id"
    ]);
});

Route::post("/students", function () {
    return response()->json([
        "message" => "POST / Student Create"
    ]);
});

Route::put("/students/{id}", function ($id) {
    return response()->json([
        "message" => "PUT / Student Update by Id"
    ]);
});

Route::delete("students/{id}", function ($id) {
    return response()->json([
        "message" => "DELETE / Student delete by Id"
    ]);
});
