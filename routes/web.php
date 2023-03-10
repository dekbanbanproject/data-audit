<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get','post'],'/',[App\Http\Controllers\PPController::class, 'welcome'])->name('p.welcome');//
Route::match(['get','post'],'dashboard',[App\Http\Controllers\PPController::class, 'dashboard'])->name('p.dashboard');//
Route::match(['get','post'],'ppfifyear',[App\Http\Controllers\PPController::class, 'ppfifyear'])->name('p.ppfifyear');//
