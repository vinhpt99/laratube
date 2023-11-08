<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UploadVideoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VoteController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('channels', App\Http\Controllers\ChannelController::class);
Route::get('videos/{video}',   [VideoController::class, 'show']);
Route::put('videos/{video}', [VideoController::class, 'updateViews']);
Route::put('videos/{video}/update', [VideoController::class, 'update'])->middleware(['auth'])->name('videos.update');
Route::get('video/{video}/comments', [CommentController::class, 'index']);
Route::get('videos/comments/{comment}/replies', [CommentController::class, 'show']);
Route::middleware(['auth'])->group(function() {
    Route::post('votes/{video}/{type}', [VoteController::class, 'vote']);
    Route::post('channels/{channel}/videos', [UploadVideoController::class, 'store']);
    Route::get('channels/{channel}/videos', [UploadVideoController::class, 'index'])->name('channel.upload');
    Route::resource('channels/{channel}/subscriptions', App\Http\Controllers\SubscriptionController ::class)->only(['store', 'destroy']);
});



