<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Models\Posts;
Route::get('/', function () {
    $posts = Posts::with('creator')->get();
    return view('welcome', compact('posts'));
});

Route::get('customers/{id}', [CustomerController::class, 'getCustomerByID']);
Route::get('test', [CustomerController::class, 'test']);