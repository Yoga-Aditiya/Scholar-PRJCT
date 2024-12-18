<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Scraper;

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
Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect()->route('front-page');
});

Route::get('/scrap', [Scraper::class, 'index'])->name('scrape');

Route::get('/home', [\App\Http\Controllers\FontPageController::class, 'index'])->name('front-page');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardHomeController::class, 'index'])->name('dashboard');
    Route::prefix('master-data')->name('master-data.')->group(function () {
        Route::get('profile', [\App\Http\Controllers\MasterData\ProfileController::class, 'index'])->name('profile');
        Route::get('study-program/{id}/{start}/{end}', [\App\Http\Controllers\MasterData\StudyProgram\StudyProgramProfileController::class, 'index'])->name('study-program-profile');
        Route::get('study-program', [\App\Http\Controllers\MasterData\StudyProgram\StudyProgramController::class, 'index'])->name('study-program');
        Route::get('lecturer', [\App\Http\Controllers\MasterData\Lecturer\LecturerController::class, 'index'])->name('lecturer');
        Route::get('study-program-adm', [\App\Http\Controllers\MasterData\StudyProgramAdm\StudyProgramAdmController::class, 'index'])->name('study-program-adm');
        Route::get('faculty-adm', [\App\Http\Controllers\MasterData\FacultyAdm\FacultyAdmController::class, 'index'])->name('faculty-adm');
        Route::get('faculty', [\App\Http\Controllers\MasterData\Faculty\FacultyController::class, 'index'])->name('faculty');
    });
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('profile', [\App\Http\Controllers\Setting\SystemSetting\SystemSettingController::class, 'index'])->name('system-setting');
    });
});

Route::get('test', [\App\Http\Service\ScholarService::class, 'test'])->name('scholar');


