<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PopulationController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/population-by-names',  [PopulationController::class, 'getFirstAndLastName']);
Route::get('/population-by-religion',  [PopulationController::class, 'getPoulationByReligion']);
Route::get('/population-by-ethnicity',  [PopulationController::class, 'getPopulationByEthnicity']);
Route::get('/population-by-age',  [PopulationController::class, 'getPopulationByAge']);
Route::get('/population-by-gender',  [PopulationController::class, 'getPopulationByGender']);
Route::get('/population-by-familyPosition',  [PopulationController::class, 'getPopulationByFamilyPosition']);
Route::get('/population-by-maritalStatus',  [PopulationController::class, 'getPopulationByMaritalStatus']);
Route::get('/total-population',  [PopulationController::class, 'getTotalPopulation']);
Route::get('/total-children',  [PopulationController::class, 'getNumberOfChildren']);
Route::get('/total-adults',  [PopulationController::class, 'getNumberOfAdults']);
Route::get('/total-elderly',  [PopulationController::class, 'getNumberOfElderly']);
Route::get('/population-by-primary-occupation',  [PopulationController::class, 'getPersonsGroupedByPrimaryOccupation']);
Route::get('/population-by-secondary-occupation',  [PopulationController::class, 'getPersonsGroupedBySecondaryOccupation']);
Route::get('/population-by-municipality',  [PopulationController::class, 'getPersonsGroupedByMunicipality']);
Route::get('/population-by-enumeration-district',  [PopulationController::class, 'getPersonsGroupedByEnumerationDistrict']);
Route::get('/population-by-residence',  [PopulationController::class, 'getPersonsGroupedByResidence']);
Route::get('/population-by-medical-condition',  [PopulationController::class, 'getPersonsGroupedByMedicalCondition']);
Route::get('/population-by-language',  [PopulationController::class, 'getPersonsGroupedByLanguage']);
Route::get('/population-by-citizenship',  [PopulationController::class, 'getPersonsGroupedByCitizenship']);
Route::get('/population-by-birth-region',  [PopulationController::class, 'getPersonsGroupedByBirthRegion']);
Route::get('/population-by-residence-status',  [PopulationController::class, 'getPersonsGroupedByResidenceStatus']);