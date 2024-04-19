<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}/subcategories', [CategoryController::class, 'subcategories']);

Route::get('/',  [CategoryController::class, 'index'])->name('home');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/dashboard/Category', [DashboardController::class, 'addCategory'])->name('addCategory');
Route::post('/dashboard/Category', [DashboardController::class, 'storeCategory'])->name('storeCategory');
Route::put('dashboard/updateCategory/{id}',[DashboardController::class, 'updateCategory'])->name('updateCategory');
Route::delete('dashboard/deleteCategory/{id}',[DashboardController::class, 'deleteCategory'])->name('deleteCategory');
Route::delete('dashboard/delete/{id}',[DashboardController::class, 'deleteCategory'])->name('delete.all.categories);
');

Route::get('/dashboard/subcategory', [DashboardController::class, 'addSubCategory'])->name('addSubCategory');
Route::post('/dashboard/subcategory', [DashboardController::class, 'storeSubCategory'])->name('storeSubCategory');
Route::put('dashboard/updateSubcategory/{id}',[DashboardController::class, 'updateSubCategory'])->name('updateSubCategory');
Route::delete('dashboard/deleteSubcategory/{id}',[DashboardController::class, 'deleteSubCategory'])->name('deleteSubCategory');


Route::get('/dashboard/user', [DashboardController::class, 'addUser'])->name('addUser');
Route::post('/dashboard/user', [DashboardController::class, 'storeUser'])->name('storeUser');
Route::put('dashboard/updateUser/{id}',[DashboardController::class, 'updateUser'])->name('updateUser');
Route::delete('dashboard/deleteUser/{id}',[DashboardController::class, 'deleteUser'])->name('deleteUser');



Route::put('/images/{id}', [DashboardController::class, 'updateImage'])->name('updateImage');
Route::get('/dashboard/create-image', [DashboardController::class, 'createImage'])->name('createImage');
Route::post('/dashboard/store-image', [DashboardController::class, 'storeImage'])->name('storeImage');
Route::delete('dashboard/delete-Image/{id}',[DashboardController::class, 'deleteImage'])->name('deleteImage');

});

require __DIR__.'/auth.php';






Route::get('/updates', [CategoryController::class, 'showUpdates'])->name('show_updates');


Route::get('/media/{id}', [CategoryController::class, 'displayMedia'])->name('displayMedia');




