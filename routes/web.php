<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index']);

//Article
Route::get('/', function () {
    return redirect('/article');
});

Route::resource('article', ArticleController::class);

//Comments
Route::group(['prefix' => '/comment'], function () {
    Route::post('/store', [CommentController::class, 'store']);
    Route::get('/edit/{id}', [CommentController::class, 'edit']);
    Route::post('/update/{id}', [CommentController::class, 'update']);
    Route::get('/delete/{id}', [CommentController::class, 'delete']);
});

//Auth
Route::get('/create', [AuthController::class, 'create']);
Route::post('/registr', [AuthController::class, 'registr']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'customLogin']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/galery/{img}', function ($img) {
    return view('main.galery', ['img' => $img]);
});

Route::get('/home', [MainController::class, 'index']);

Route::get('/contact', function () {
    $contacts = [
        'name' => 'Vladislav Screxy 2023 ',
        'github' => 'https://github.com/Screxy/Laravel-project'
    ];
    return view('main.contact', ['contacts' => $contacts]);
});
