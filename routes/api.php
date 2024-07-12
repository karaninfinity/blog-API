<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\CategoryController;
use App\Http\Controllers\APIs\SubcategoryController;
use App\Http\Controllers\APIs\BlogsController;

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

Route::get("/categories", [CategoryController::class, "index"]);
Route::post("/add/category", [CategoryController::class, "store"]);
Route::post("/update/category/{id}", [CategoryController::class, "update"]);
Route::get("/category/{id}", [CategoryController::class, "show"]);
Route::delete("/delete/category/{id}", [CategoryController::class, "destroy"]);

Route::get("/subcategories", [SubcategoryController::class, "index"]);
Route::get("/subcategories/{id}", [SubcategoryController::class, "subcatogories"]);
Route::post("/add/subcategory", [SubcategoryController::class, "store"]);
Route::post("/update/subcategory/{id}", [SubcategoryController::class, "update"]);
Route::get("/subcategory/{id}", [SubcategoryController::class, "show"]);
Route::delete("/delete/subcategory/{id}", [SubcategoryController::class, "destroy"]);

Route::get("/blogs", [BlogsController::class, "index"]);
Route::post("/add/blog", [BlogsController::class, "store"]);
Route::post("/update/blog/{id}", [BlogsController::class, "update"]);
Route::get("/blog/{id}", [BlogsController::class, "show"]);
Route::delete("/delete/blog/{id}", [BlogsController::class, "destroy"]);