<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

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

//Auth
Route::get('/create', [AuthController::class, 'create']);
Route::post('/registr', [AuthController::class, 'registr']);

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
