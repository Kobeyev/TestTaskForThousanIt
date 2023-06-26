<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('authors/{authorId}/news', [\App\Http\Controllers\API\NewsController::class, 'newsByAuthor']);

Route::get('categories/{categoryId}/news', [\App\Http\Controllers\API\NewsController::class, 'newsByCategory']);

Route::get('authors', [\App\Http\Controllers\API\AuthorController::class, 'authorsList']);


Route::get('news/search', [\App\Http\Controllers\API\NewsController::class,'searchNewsByCategory']);
//http://127.0.0.1:8000/api/news/search?category_id=1

Route::get('news/{id}', [\App\Http\Controllers\API\NewsController::class, 'newsById']);

Route::get('search/news', [\App\Http\Controllers\API\NewsController::class,'searchNewsByTitle']);
//http://127.0.0.1:8000/api/search/news?title=месси

Route::post('store/news', [\App\Http\Controllers\API\NewsController::class, 'store']);
//параметры показаны в валидаторе и category_ids это массив
//{
//  "title": "Заголовок новости",
//  "excerpt": "Краткое описание новости",
//  "content": "Полный текст новости",
//  "published_at": "2023-06-26 15:21:29",
//  "author_id": 1,
//  "category_ids": [1, 2]
//}   пример

Route::post('store/categories', [\App\Http\Controllers\API\CategoryController::class, 'store']);
//параметр name = отдых

Route::post('store/authors', [\App\Http\Controllers\API\AuthorController::class, 'store']);
//параметры
//http://127.0.0.1:8000/api/store/authors?name=Thousand IT pRodA&email=testacc@gmail.com&avatar=https://google.com/avatar/avatar.png
