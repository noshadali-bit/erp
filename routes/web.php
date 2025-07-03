<?php

use App\Http\Controllers\Admin\EmailDataController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SavedDataController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\SalaryController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;

use App\Http\Controllers\YarnPurchaseController;
use App\Http\Controllers\YarnInventoryController;
use App\Http\Controllers\DyeingBatchController;
// use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\YarnController;
use App\Http\Controllers\SupplierController;

use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/storagelink', function () {
    Artisan::call('storage:link');
    dd('Link Updated');
});
Route::get('/', function () {
    return redirect()->route('index');
})->name('home');

Route::prefix('admin')->group(function () {

    Route::view('signin', 'admin.pages.login')->name('signin');
    Route::post('/signin', [AuthController::class, 'adminLogin'])->name('signin');

    Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    Route::middleware('admin.auth')->group(function () {

        Route::get('/check_slug', [DashboardController::class, 'check_slug'])
            ->name('admin.check_slug');

            // Departments
        Route::resource('departments', DepartmentController::class);
        Route::get('/departments-suspend/{id}', [DepartmentController::class, 'suspend'])->name('departments.suspend');

        // Brands
        Route::resource('brands', BrandController::class);
        Route::get('/brands-suspend/{id}', [BrandController::class, 'suspend'])->name('brands.suspend');

        // Brands
        Route::resource('saveddata', SavedDataController::class);
        Route::get('/saveddata-suspend/{id}', [SavedDataController::class, 'suspend'])->name('saveddata.suspend');

        // Settings
        Route::resource('settings', SettingController::class);

        // Tasks
        Route::resource('tasks', TaskController::class);
        Route::get('/tasks-delete/{id}', [TaskController::class, 'deletess'])->name('tasks.delete');
             
        Route::get('/tasks-detail/{id}', [TaskController::class, 'detail'])->name('tasks.detail');
        Route::post('/tasks-status', [TaskController::class, 'status'])->name('tasks.status');
        Route::post('/tasks/bulk-approve', [TaskController::class, 'bulkApprove'])->name('tasks.bulkApprove');
        Route::post('/tasks/update-status/{id}', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
        Route::post('/tasks/update-rating/{id}', [TaskController::class, 'updateRating'])->name('tasks.updateRating');

         // Target
        Route::resource('targets', TargetController::class);
        Route::get('/targets-status/{target}', [TargetController::class, 'status'])->name('targets.status');


        // Exra Users 
        Route::get('/managers', [DashboardController::class, 'managers_list'])->name('managers_list');
        Route::get('/managers-add', [DashboardController::class, 'managers_add'])->name('managers_add');
        Route::post('/managers-store', [DashboardController::class, 'managers_store'])->name('managers_store');
        Route::get('/managers-edit/{id}', [DashboardController::class, 'managers_edit'])->name('managers_edit');
        Route::post('/managers-update', [DashboardController::class, 'managers_update'])->name('managers_update');
        Route::get('/managers-suspend/{id}', [DashboardController::class, 'managers_suspend'])->name('managers_suspend');
        Route::get('/managers-extra-access/{id}', [DashboardController::class, 'managers_extra_access'])->name('managers_extra_access');

        Route::get('/team', [DashboardController::class, 'employes_list'])->name('employes_list');
        Route::get('/team-add', [DashboardController::class, 'employes_add'])->name('employes_add');
        Route::post('/team-store', [DashboardController::class, 'employes_store'])->name('employes_store');
        Route::get('/team-edit/{id}', [DashboardController::class, 'employes_edit'])->name('employes_edit');
        Route::post('/team-update', [DashboardController::class, 'employes_update'])->name('employes_update');
        Route::get('/team-suspend/{id}', [DashboardController::class, 'employes_suspend'])->name('employes_suspend');


        //New Routes
        Route::resource('users', userController::class);
        Route::resource('salaries', SalaryController::class);
        Route::resource('attendances', AttendanceController::class);
        Route::get('get-user-base-salary/{id}', [SalaryController::class, 'getuserBaseSalary'])->name('user.base-salary');

        Route::get('/salary/monthly', [SalaryController::class, 'monthly'])->name('salaries.monthly');

        // Config Routes
        Route::get('configs', [ConfigController::class, 'index'])->name('configs.index');
        Route::get('configs/edit', [ConfigController::class, 'edit'])->name('configs.edit');
        Route::put('configs', [ConfigController::class, 'update'])->name('configs.update');

        Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
        Route::get('/payroll/monthly', [PayrollController::class, 'getMonthlyPayroll'])->name('payroll.monthly');
        Route::post('/payroll/process-salaries', [PayrollController::class, 'processSalaries']);
        Route::post('/calculate-monthly-salary', [SalaryController::class, 'calculateMonthlySalary']);
        Route::post('/store-bulk-salaries', [SalaryController::class, 'storeBulkSalaries']);
        Route::get('bulk-attendance', [AttendanceController::class, 'bulkCreate'])->name('attendances.bulk.create');
        Route::post('bulk-attendance', [AttendanceController::class, 'bulkStore'])->name('attendances.bulk.store');


        // End New routes

        // Email Management
        Route::resource('email-management', EmailDataController::class);
        Route::get('/email-management-suspend/{id}', [EmailDataController::class, 'suspend'])->name('email-management.suspend');

        Route::get('settings', [PageController::class, 'settings'])->name('settings');
        Route::post('submitSettings', [PageController::class, 'submitSettings'])->name('submitSettings');
        
        Route::get('profile', [PageController::class, 'profile'])->name('profile');
        Route::post('profile-password-update', [PageController::class, 'passwordUpdate'])->name('profile-password-update');
        
        

        Route::get('/',[DashboardController::class, 'dashboardpage'])->name('index');
        Route::get('/department-detail/{sulg}',[DashboardController::class, 'department_detail'])->name('department-detail');
        Route::get('/user-detail/{id}',[DashboardController::class, 'user_detail'])->name('user-detail');
        // Route::view('/', 'admin.dashboard.index')->name('index');
        Route::get('/index', function () {
            return redirect()->route('index');
        })->name('dashboard-02');
        // Route::view('/index', 'admin.dashboard.index')->name('dashboard-02');
        Route::view('box-layout', 'admin.page-layout.box-layout')->name('box-layout');
        Route::view('layout-rtl', 'admin.page-layout.layout-rtl')->name('layout-rtl');
        Route::view('layout-dark', 'admin.page-layout.layout-dark')->name('layout-dark');
        Route::view('hide-on-scroll', 'admin.page-layout.hide-on-scroll')->name('hide-on-scroll');
        Route::view('footer-light', 'admin.page-layout.footer-light')->name('footer-light');
        Route::view('footer-dark', 'admin.page-layout.footer-dark')->name('footer-dark');
        Route::view('footer-fixed', 'admin.page-layout.footer-fixed')->name('footer-fixed');
        Route::view('sample-page', 'admin.pages.sample-page')->name('sample-page');
        Route::view('landing-page', 'admin.pages.landing-page')->name('landing-page');
        Route::view('400', 'admin.errors.400')->name('error-400');
        Route::view('401', 'admin.errors.401')->name('error-401');
        Route::view('403', 'admin.errors.403')->name('error-403');
        Route::view('404', 'admin.errors.404')->name('error-404');
        Route::view('500', 'admin.errors.500')->name('error-500');
        Route::view('503', 'admin.errors.503')->name('error-503');
        Route::view('compact-sidebar', 'admin.admin_unique_layouts.compact-sidebar'); //default //Dubai
        //Route::view('box-layout', 'admin.admin_unique_layouts.box-layout');    //default //New York //
        Route::view('dark-sidebar', 'admin.admin_unique_layouts.dark-sidebar');
        Route::view('default-body', 'admin.admin_unique_layouts.default-body');
        Route::view('compact-wrap', 'admin.admin_unique_layouts.compact-wrap');
        Route::view('enterprice-type', 'admin.admin_unique_layouts.enterprice-type');
        Route::view('compact-small', 'admin.admin_unique_layouts.compact-small');
        Route::view('advance-type', 'admin.admin_unique_layouts.advance-type');
        Route::view('material-layout', 'admin.admin_unique_layouts.material-layout');
        Route::view('color-sidebar', 'admin.admin_unique_layouts.color-sidebar');
        Route::view('material-icon', 'admin.admin_unique_layouts.material-icon');
        Route::view('modern-layout', 'admin.admin_unique_layouts.modern-layout');


        Route::get('admin_logout', [AuthController::class, 'adminlogout'])->name('admin_logout');
    });
});

Route::get('/yarn', [YarnController::class, 'index'])->name('yarn.index');
Route::get('/yarn/create', [YarnController::class, 'create'])->name('yarn.create');
Route::post('/yarn', [YarnController::class, 'store'])->name('yarn.store');


Route::prefix('yarn')->group(function () {
    Route::prefix('purchase')->group(function () {
        Route::get('/', [YarnPurchaseController::class, 'index'])->name('yarn.purchase.index');
        Route::get('/create', [YarnPurchaseController::class, 'create'])->name('yarn.purchase.create');
        Route::post('/', [YarnPurchaseController::class, 'store'])->name('yarn.purchase.store');
    });

    Route::prefix('inventory')->group(function () {
        Route::get('/', [YarnInventoryController::class, 'index'])->name('yarn.inventory.index');
        Route::post('/movement', [YarnInventoryController::class, 'movement'])->name('yarn.inventory.movement');
        Route::get('/{id}/history', [YarnInventoryController::class, 'history'])->name('yarn.inventory.history');
    });
});

Route::prefix('dyeing')->group(function () {
    Route::get('/', [DyeingBatchController::class, 'index'])->name('dyeing.index');
    Route::get('/create', [DyeingBatchController::class, 'create'])->name('dyeing.create');
    Route::post('/', [DyeingBatchController::class, 'store'])->name('dyeing.store');
    Route::patch('/{batch}/status', [DyeingBatchController::class, 'updateStatus'])->name('dyeing.update-status');
});

Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
Route::post('/department', [DepartmentController::class, 'store'])->name('department.stor');
Route::resource('suppliers', SupplierController::class);