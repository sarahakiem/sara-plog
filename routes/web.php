<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Configuration\Middleware;


// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', function () {
    return view('welcome');
});




Route::get('blog', [PostsController::class, 'index']);
Route::get('add', [PostsController::class, 'add'])->name('add')->middleware('ensure.token.valid');
Route::post('store', [PostsController::class, 'store'])->name('store');
Route::get('edit{id}', [PostsController::class, 'edit'])->name('edit.post')->middleware('verified');
Route::put('update/{id}', [PostsController::class, 'update'])->name('update');
Route::get('delete{id}', [PostsController::class, 'delete']);
Route::get('contact',[PostsController::class, 'contact'])->name('contact');
Route::post('send', [PostsController::class, 'sendContact'])->name('contact.send');




Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
