<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[App\Http\Controllers\DashboardController::class,'index'] );

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group([
    'middleware' =>  ['auth','role:superadmin']
],function(){
    Route::resource('/permissions' , App\Http\Controllers\DataPermission::class);
});

Route::group([
    'middleware' =>  ['auth','permission:Personal']
],function(){
    Route::resource('/personal' , App\Http\Controllers\PersonalData::class);
    Route::get('/types/create', [App\Http\Controllers\TypeController::class, 'create'])->name('types.create');
    Route::post('/types/store', [App\Http\Controllers\TypeController::class, 'store'])->name('types.store');
    Route::get('/types/{id}/edit', [App\Http\Controllers\TypeController::class, 'edit'])->name('types.edit');
    Route::put('/types/update/{id}', [App\Http\Controllers\TypeController::class, 'update'])->name('types.update');
    Route::get('/subs/create', [App\Http\Controllers\SubController::class, 'create'])->name('subs.create');
    Route::post('/subs/store', [App\Http\Controllers\SubController::class, 'store'])->name('subs.store');
    Route::get('/subs/{id}/edit', [App\Http\Controllers\SubController::class, 'edit'])->name('subs.edit');
    Route::put('/subs/update/{id}', [App\Http\Controllers\SubController::class, 'update'])->name('subs.update');
});

Route::group([
    'middleware' =>  ['auth','permission:PDCA']
],function(){
    Route::resource('/plan' , App\Http\Controllers\PlanData::class);
    Route::get('/api/get-plans', [App\Http\Controllers\PlanData::class, 'getPlans']);
    Route::resource('/plan-do' , App\Http\Controllers\PlanDoDate::class);
    Route::resource('/plan-check' , App\Http\Controllers\PlanCheckDate::class);
    Route::resource('/plan-action' , App\Http\Controllers\PlanActionDate::class);
});

Route::group([
    'middleware' =>  ['auth','permission:Physician']
],function(){
    Route::resource('/history' , App\Http\Controllers\PersonalHistory::class);
    Route::get('/personal-history/{id}', [App\Http\Controllers\PersonalHistory::class, 'getHistory']);
    Route::resource('/joint' , App\Http\Controllers\PersonalJoint::class);
    Route::get('/personal-joint/{id}', [App\Http\Controllers\PersonalJoint::class, 'getPersonalJoint']);
    Route::resource('/lab' , App\Http\Controllers\PersonalLab::class);
});

Route::group([
    'middleware' =>  ['auth','permission:Strengthen']
],function(){
    
});

Route::group([
    'middleware' =>  ['auth','permission:Nutrition']
],function(){
    
});

Route::group([
    'middleware' =>  ['auth','permission:Psychology']
],function(){
    Route::resource('/psychology' , App\Http\Controllers\PersonalHealt::class);
});

Route::group([
    'middleware' =>  ['auth','permission:Physical']
],function(){
    
});

Route::group([
    'middleware' =>  ['auth','permission:Report']
],function(){
    
});

Route::resource('/ostrc' , App\Http\Controllers\DataOstrc::class);
Route::resource('/health' , App\Http\Controllers\DataHealth::class);