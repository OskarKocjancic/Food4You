<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ChatGptController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;



Route::post(
    '/login',
    [
        AuthManager::class,
        'loginPost'
    ]
)->name('login.post');

Route::post(
    '/add-prompt',
    [
        ChatGptController::class,
        'addPrompt'
    ]
)->name('add-prompt.post');

Route::post(
    '/delete-prompt',
    [
        ChatGptController::class,
        'deletePrompt'
    ]
)->name('delete-prompt.post');

Route::post(
    '/edit-prompt',
    [
        ChatGptController::class,
        'editPrompt'
    ]
)->name('edit-prompt.post');

Route::post(
    '/save-settings',
    [
        ChatGptController::class,
        'saveSettings'
    ]
)->name('save-settings.post');

Route::post(
    '/chat',
    [
        ChatGptController::class,
        'getResponseFromChatGPT'
    ]
)->name('chat.post');
Route::match(['get', 'post'],
    '/add-review',
    [
        RestaurantController::class,
        'addReview'
    ]
)->name('add-review.post');
Route::match(['get', 'post'],
    '/add-restaurant',
    [
        RestaurantController::class,
        'addRestaurantIfAbsent'
    ]
)->name('add-restaurant.post');

Route::post(
    '/get-restaurants',
    [
        RestaurantController::class,
        'getRestaurants'
    ]
)->name('get-restaurants.post');

Route::get('/restaurant-count', [RestaurantController::class, 'getNumberOfRestaurants'])->name('restaurant-count.get');

Route::post(
    '/get-reviews',
    [
        RestaurantController::class,
        'getReviews'
    ]
)->name('get-reviews.post');

Route::post(
    '/get-reviews-api',
    [
        RestaurantController::class,
        'getReviewsApi'
    ]
)->name('get-reviews-api.post');

Route::post(
    '/registration',
    [
        AuthManager::class,
        'registrationPost'
    ]
)->name('registration.post');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');

Route::get('/', function () {
    return view('login');
});

Route::get(
    '/login',
    [
        AuthManager::class,
        'login'
    ]
)->name('login');

Route::get('/main_page', function () {
    return view('main-screen');
})->name('home');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/roles', function () {
    return view('role-edit');
})->name('roles');

Route::get('/registration', function () {
    return view('registration');
});

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');