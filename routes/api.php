<?php

use App\Http\Controllers\Api\CompanyController;
use Illuminate\Support\Facades\Route;

// Створення/Оновлення компанії
Route::post('/company', [CompanyController::class, 'store']);

// Отримати всі версії компанії за її ЄДРПОУ
Route::get('/company/{edrpou}/versions', [CompanyController::class, 'indexVersions']);

// Отримати список компаній збережених в системі
Route::get('/companies', [CompanyController::class, 'index']);

// Отримати список компаній збережених в системі з їх КВЕДами
Route::get('/companies-kveds', [CompanyController::class, 'indexCompanyKveds']);

