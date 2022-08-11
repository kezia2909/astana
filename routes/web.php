<?php

use App\Http\Controllers\AccountManageController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthManageController;
use App\Http\Controllers\DashboardManageController;
use App\Http\Controllers\ManageAccountController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', [AuthManageController::class, 'viewLogin'])->middleware('guest');
Route::get('/login', [AuthManageController::class, 'viewLogin'])->name('login')->middleware('guest');
Route::post('/verify_login', [AuthManageController::class, 'verifyLogin'])->middleware('guest');
Route::post('/logout', [AuthManageController::class, 'logoutProcess']);

Route::get('/dashboard', [DashboardManageController::class, 'viewDashboard'])->middleware('auth');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });



// Route::group(['middleware' => ['auth', 'checkRole:superadmin,admin']], function(){
//     Route::get('/manage_account',[AccountManageController::class, 'viewManageAccount']);
//     Route::get('/add_account',[AccountManageController::class, 'viewAddAccount']);
//     Route::post('/add_account',[AccountManageController::class, 'store']);
// });

Route::middleware(['auth', 'checkRole:superadmin_pabrik,superadmin_distributor'])->group(function () {
    // Route::get('/manage_account',[AccountManageController::class, 'viewManageAccount']);
    // Route::get('/manage_account/delete/{user:id}', [AccountManageController::class, 'deleteAccount']);

    // Route::get('/add_account',[AccountManageController::class, 'viewAddAccount']);
    // Route::post('/add_account',[AccountManageController::class, 'store']);

    // Route::get('/edit_account/{user:username}',[AccountManageController::class, 'viewEditAccount']);
    // Route::get('/coba',[AccountManageController::class, 'viewCoba']);

    // Route::resource('/manage_account', AccountManageController::class);
    // Route::get('/edit_account/{user:username}', [AccountManageController::class, 'viewEditAccount']);
    // Route::post('/update_account', [AccountManageController::class, 'updateAccount']);

    Route::resource('/manage_account/users', ManageAccountController::class);
    Route::post('fetch-cities', [ManageAccountController::class, 'fetchCity']);
});

