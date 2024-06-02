<?php

use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    $locale = Session::get('locale') ?? 'en';
    app()->setLocale($locale);
    return view('welcome');
})->name('/');

Route::get(
    'locale/{locale}',
    [LocalizationController::class, 'setLanguage']
)->name('locale');
