<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
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
Route::get('/product',[
    ProductController::class, //kiểu dữ liệu product controller
    'index'     //hàm index thực thi
]);

Route::get('/product/{productName}/{id}',[
   ProductController::class,
   'detail'
])->where([
    'productName'=>'[a-zA-Z0-9]+',
    'id'=>'[0-9]+'
]);

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/home', function () {
//    return view('home');
//});

Route::get('/',[PagesController::class,'home']);
Route::get('/about',[AboutController::class,'about']);
