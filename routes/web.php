<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth','isUser']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



// For Admins
Route::prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', UsersController::class)->only(['index','edit','update','destory']);
    Route::resource('/users', UsersController::class)->except(['show','store','create']);
});

Route::get('/user/{id}', [UserController::class, 'profile'])->name('user.profile');

Route::get('/edit/user/', [UserController::class, 'edit'])->name('user.edit');
Route::post('/edit/user/', [UserController::class, 'update'])->name('user.update');

Route::get('/edit/password/user/', [UserController::class, 'passwordEdit'])->name('password.edit');
Route::post('/edit/password/user/', [UserController::class, 'passwordUpdate'])->name('password.update');


Route::resource('/posts',PostsController::class);
Route::post('/posts/create', [PostsController::class, 'store'])->name('posts.create');

// Route::get('/posts/edit/',[PostsController::class, 'edit'])->name('post.edit');
Route::post('/posts/edit/',[PostsController::class, 'update'])->name('post.update');
Route::post('/posts',[PostsController::class, 'meDelete'])->name('post.delete');

Route::get('/posts/{id}/download', [PostsController::class, 'download'])->name('post.download');
