<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;

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

//Route::get('/stories','App\Http\Controllers\StoryController@index');
Route::get('/stories', [StoryController::class, 'index'])->name('story.index');
Route::post('/stories', [StoryController::class, 'store'])->name('story.store');
Route::get('/stories/{story}', [StoryController::class, 'show'])->name('story.show');
Route::put('/stories/{story}', [StoryController::class, 'update'])->name('story.update');
Route::delete('/stories/{story}', [StoryController::class, 'destroy'])->name('story.destroy');