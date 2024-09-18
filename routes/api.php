<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlockAdminssionsController;
use App\Http\Controllers\Api\EducationsTypesController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeesController;
use App\Http\Controllers\Api\FormAdminssionsController;
use App\Http\Controllers\Api\LeadsController;
use App\Http\Controllers\Api\MarjorsController;
use App\Http\Controllers\Api\MethodAdminssionController;
use App\Http\Controllers\Api\SourcesController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\SupportsController;
use App\Http\Controllers\Api\SupportsStatusController;
use App\Http\Controllers\Api\TagsController;
use Illuminate\Support\Facades\Route;

// Nguồn tiếp cận

Route::group([
    'middleware' => 'api',
    'prefix' => 'sources'
], function ($router) {
    $router->get('/', [SourcesController::class, 'index']);    
    $router->get('/details/{id}', [SourcesController::class, 'details']);
    $router->post('/create', [SourcesController::class, 'create']);
    $router->post('/create-multiple', [SourcesController::class, 'createMultiple']);
    $router->post('/update/{id}', [SourcesController::class, 'update']);
    $router->post('/delete/{id}', [SourcesController::class, 'delete']);
});
// Chuyên ngành đào tạo
Route::group([
    'middleware' => 'api',
    'prefix' => 'marjors'
], function ($router) {
    $router->get('/', [MarjorsController::class, 'index']);    
    $router->get('/details/{id}', [MarjorsController::class, 'details']);
    $router->post('/create', [MarjorsController::class, 'create']);
    $router->post('/create-multiple', [MarjorsController::class, 'createMultiple']);
    $router->post('/update/{id}', [MarjorsController::class, 'update']);
    $router->post('/delete/{id}', [MarjorsController::class, 'delete']);
});

// Quản lý trạng thái
Route::group([
    'middleware' => 'api',
    'prefix' => 'status'
], function ($router) {
    $router->get('/', [StatusController::class, 'index']);
    $router->get('/details/{id}', [StatusController::class, 'details']);
    $router->post('/create', [StatusController::class, 'create']);
    $router->post('/create-multiple', [StatusController::class, 'createMultiple']);
    $router->post('/update/{id}', [StatusController::class, 'update']);
    $router->post('/delete/{id}', [StatusController::class, 'delete']);
});

// Quản lý thẻ
Route::group([
    'middleware' => 'api',
    'prefix' => 'tags'
], function ($router) {
    $router->get('/', [TagsController::class, 'index']);    
    $router->get('/details/{id}', [TagsController::class, 'details']);
    $router->post('/create', [TagsController::class, 'create']);
    $router->post('/create-multiple', [TagsController::class, 'createMultiple']);
    $router->post('/update/{id}', [TagsController::class, 'update']);
    $router->post('/delete/{id}', [TagsController::class, 'delete']);
});

// Quản lý loại tốt nghiệp
Route::group([
    'middleware' => 'api',
    'prefix' => 'educations-types'
], function ($router) {
    $router->get('/', [EducationsTypesController::class, 'index']);    
    $router->get('/details/{id}', [EducationsTypesController::class, 'details']);
    $router->post('/create', [EducationsTypesController::class, 'create']);
    $router->post('/create-multiple', [EducationsTypesController::class, 'createMultiple']);
    $router->post('/update/{id}', [EducationsTypesController::class, 'update']);
    $router->post('/delete/{id}', [EducationsTypesController::class, 'delete']);
});

// Quản lý leads
Route::group([
    'middleware' => 'api',
    'prefix' => 'leads'
], function ($router) {   
    // Đăng ký hồ sơ
    $router->post('/register-profile', [LeadsController::class, 'create']);
    //Upload avatar
    $router->post('/upload-avatar/{id}', [LeadsController::class, 'uAvatar']);
    // Thông tin hồ sơ
    $router->post('/information-profile/{id}', [LeadsController::class, 'uPersonal']);
    // Thông tin liên lạc
    $router->post('/contacts/{id}', [LeadsController::class, 'contacts']);
    // Thông tin gia đình
    $router->post('/family/{id}', [LeadsController::class, 'family']);
    // Thông tin xét tuyển
    $router->post('/score/{id}', [LeadsController::class, 'score']);
    // Xác nhận hồ sơ
    $router->post('/confirm/{id}', [LeadsController::class, 'confirm']);
    // Login
    $router->post('/login', [AuthController::class, 'login']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'method-adminssions'
], function ($router) {
    $router->get('/', [MethodAdminssionController::class, 'index']);    
    $router->get('/details/{id}', [MethodAdminssionController::class, 'details']);
    $router->post('/create', [MethodAdminssionController::class, 'create']);
    $router->post('/create-multiple', [MethodAdminssionController::class, 'createMultiple']);
    $router->post('/update/{id}', [MethodAdminssionController::class, 'update']);
    $router->post('/delete/{id}', [MethodAdminssionController::class, 'delete']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'form-adminssions'
], function ($router) {
    $router->get('/', [FormAdminssionsController::class, 'index']);    
    $router->get('/details/{id}', [FormAdminssionsController::class, 'details']);
    $router->post('/create', [FormAdminssionsController::class, 'create']);
    $router->post('/create-multiple', [FormAdminssionsController::class, 'createMultiple']);
    $router->post('/update/{id}', [FormAdminssionsController::class, 'update']);
    $router->post('/delete/{id}', [FormAdminssionsController::class, 'delete']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'block-adminssions'
], function ($router) {
    $router->get('/', [BlockAdminssionsController::class, 'index']);    
    $router->get('/details/{id}', [BlockAdminssionsController::class, 'details']);
    $router->post('/create', [BlockAdminssionsController::class, 'create']);
    $router->post('/create-multiple', [BlockAdminssionsController::class, 'createMultiple']);
    $router->post('/update/{id}', [BlockAdminssionsController::class, 'update']);
    $router->post('/delete/{id}', [BlockAdminssionsController::class, 'delete']);
});

// CRM

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    $router->post('/login', [AuthController::class, 'login']);
    $router->post('/register', [AuthController::class, 'register']);
     
});

Route::middleware(['api.login'])->group(function () {
    // Thông tin tài khoản
    Route::prefix('auth')->group(function ($router) {
        $router->post('/logout', [AuthController::class, 'logout']);
        $router->post('/refresh', [AuthController::class, 'refresh']);
        $router->get('/user-profile', [AuthController::class, 'userProfile']);
        $router->post('/change-password', [AuthController::class, 'changePassWord']);  
    });
    // Thông tin yêu cầu hỗ trợ
    Route::prefix('supports')->group(function ($router) {
        $router->get('/', [SupportsController::class, 'index']);    
        $router->get('/details/{id}', [SupportsController::class, 'details']);        
        $router->post('/create', [SupportsController::class, 'create']);        
        $router->post('/create-multiple', [SupportsController::class, 'createMultiple']);
        $router->post('/update/{id}', [SupportsController::class, 'update']);
        $router->post('/delete/{id}', [SupportsController::class, 'delete']); 
    });
    // Thông tin trạng thái yêu cầu hỗ trợ
    Route::prefix('supports-status')->group(function ($router) {
        $router->get('/', [SupportsStatusController::class, 'index']);    
        $router->get('/details/{id}', [SupportsStatusController::class, 'details']);
        $router->post('/create', [SupportsStatusController::class, 'create']);
        $router->post('/create-multiple', [SupportsStatusController::class, 'createMultiple']);
        $router->post('/update/{id}', [SupportsStatusController::class, 'update']);
        $router->post('/delete/{id}', [SupportsStatusController::class, 'delete']);
    });
    // Thông tin nhân viên    
    Route::prefix('employees')->group(function ($router) {
        $router->get('/', [EmployeeController::class, 'index']);    
        $router->get('/details/{id}', [EmployeeController::class, 'details']);
        $router->post('/create', [EmployeeController::class, 'create']);        
        $router->post('/update/{id}', [EmployeeController::class, 'update']);
        $router->post('/delete/{id}', [EmployeeController::class, 'delete']);
    });

    Route::prefix('leads')->group(function ($router) {
        $router->post('/data', [LeadsController::class, 'data']);
        $router->post('/details/{id}', [LeadsController::class, 'details']);
        $router->post('/update/{id}', [LeadsController::class, 'update']);
        $router->post('/update-status-lead/{id}', [LeadsController::class, 'update_status_lead']);
        $router->post('/delete/{id}', [LeadsController::class, 'delete']);
        $router->post('/crm-create-lead', [LeadsController::class, 'crm_create_lead']);
        $router->post('/export', [LeadsController::class, 'export'])->name('Leads.export');
        $router->post('/import', [LeadsController::class, 'import'])->name('Leads.import');
    });
});