<?php
namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
//use Illuminate\Foundation\Configuration\Middleware;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', function () {
    return view('welcome');
});




Route::get('blog', [PostsController::class, 'index']);
Route::get('add', [PostsController::class, 'add'])->name('add');
Route::post('store', [PostsController::class, 'store'])->name('store');
Route::get('edit{id}', [PostsController::class, 'edit'])->name('edit.post')->middleware('verified');
Route::put('update/{id}', [PostsController::class, 'update'])->name('update');
Route::get('delete{id}', [PostsController::class, 'delete'])->middleware('ensure.token.valid');
Route::get('contact',[PostsController::class, 'contact'])->name('contact');
Route::post('send', [PostsController::class, 'sendContact'])->name('contact.send');
//////////////////////////////////////////////////////////////////////////////////

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
        
        Route::get('add', [PostsController::class, 'add'])->name('add');
    });

//////////////////////////////////////




Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
//////////////////////////  add_car route   //////////////////////////////////////////////////////
Route::prefix('cars')->controller(CarController::class)->group(function () {
    Route::get('createcar', 'create');
    Route::post('store','store')->name('cars.store');
////////////////////////       cars        //////////////////////////////////////////////////
    Route::get('','index')->name('cars.index');
    Route::get('{id}/edit','edit')->name('cars.edit');
    Route::put('{id}/update','update')->name('cars.update');

    Route::get('show/{id}','show')->name('cars.show');
    Route::get('delete/{id}','destroy')->name('cars.destroy');
    Route::get('trashed','ShowDeleted')->name('trashed.cars');
///////////////////////////////restore deleted record/////////////////////////////
    Route::patch('{id}/restore','restore')->name('cars.restore');
////////////////////////////////delete frm database//////////////////////////////////////
    Route::delete('deletePermenant/{id}','forceDelete')->name('cars.permanentDelete');
});
////////////////////////////////////////////////////////////////////////
