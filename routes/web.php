<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PopulationController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/population-by-names',  [PopulationController::class, 'getFirstAndLastName']);
Route::get('/population-by-group',  [PopulationController::class, 'getPopulationByGroup']);
Route::get('/population-by-age-range',  [PopulationController::class, 'getPopulationByAgeRange']);
Route::get('/population-by-gender',  [PopulationController::class, 'getPopulationByGender']);
Route::get('/total-population',  [PopulationController::class, 'getTotalPopulation']);
Route::get('/total-children',  [PopulationController::class, 'getNumberOfChildren']);
Route::get('/total-adults',  [PopulationController::class, 'getNumberOfAdults']);
Route::get('/total-elderly',  [PopulationController::class, 'getNumberOfElderly']);
Route::get('/population-by-municipality',  [PopulationController::class, 'getPersonsGroupedByMunicipality']);
Route::get('/population-by-enumeration-district',  [PopulationController::class, 'getPersonsGroupedByEnumerationDistrict']);
Route::get('/population-by-residence',  [PopulationController::class, 'getPersonsGroupedByResidence']);
Route::get('/population-by-birth-region',  [PopulationController::class, 'getPersonsGroupedByBirthRegion']);
Route::get('/population-by-residence-status',  [PopulationController::class, 'getPersonsGroupedByResidenceStatus']);
Route::get('/population-by-age-group',  [PopulationController::class, 'getAgeGroups']);
Route::get('/population-by-age-gender-group',  [PopulationController::class, 'getAgeGenderGroups']);
Route::get('/population-by-age-marital-group',  [PopulationController::class, 'getAgeMaritalGroups']);
Route::get('/population-by-age-gender-marital-group',  [PopulationController::class, 'getAgeGenderMaritalGroups']);
Route::get('/population-by-single-age-gender-group',  [PopulationController::class, 'getSingleAgeGenderGroups']);