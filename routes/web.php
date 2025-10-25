<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/newpage', function () {
    return view('newpage');
});
Route::get('/entrance', function () {
    return view('entrance');
});
Route::get('/registration', function () {
    return view('registration');
});
Route::get('/forgot-password', function () {
    return view('forgot-password');
});
Route::get('/reset-password', function () {
    return view('reset-password');
});
Route::get('/project-card', function () {
    return view('project-card');
});
Route::get('/report-builder', function () {
    return view('report-builder');
});
Route::get('/analytics-dashboard', function () {
    return view('analytics-dashboard');
});
Route::get('/user-management', function () {
    return view('user-management');
});
Route::get('/dictionaries', function () {
    return view('dictionaries');
});
Route::get('/project-details', function () {
    $orgInn = request('org'); // Получаем ИНН из query-параметра
    return view('project-details', ['orgInn' => $orgInn]);
});
Route::get('/verify-code', function () {
    $email = request('email'); // Получаем email из формы входа
    return view('verify-code', ['email' => $email]);
});