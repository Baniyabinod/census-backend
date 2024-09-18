<?php

use App\Http\Controllers\Api\DummyPopulationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/total-population',  [DummyPopulationController::class, 'getTotalPopulation']);
Route::get('/total-children',  [DummyPopulationController::class, 'getNumberOfChildren']);
Route::get('/total-adults',  [DummyPopulationController::class, 'getNumberOfAdults']);
Route::get('/total-elderly',  [DummyPopulationController::class, 'getNumberOfElderly']);

Route::get('/population-by-age-gender-group',  [DummyPopulationController::class, 'getAgeGenderGroups']);
Route::get('/population-by-age-marital-group',  [DummyPopulationController::class, 'getAgeMaritalGroups']);
Route::get('/population-by-age-group',  [DummyPopulationController::class, 'getAgeGroups']);
Route::get('/population-by-age-gender-marital-group',  [DummyPopulationController::class, 'getAgeGenderMaritalGroups']);
Route::get('/population-by-single-age-gender-group',  [DummyPopulationController::class, 'getSingleAgeGenderGroups']);

