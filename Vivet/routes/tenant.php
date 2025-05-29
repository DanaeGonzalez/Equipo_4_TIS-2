<?php
//declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ClinicalRecordController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\MedicationController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Estas rutas son cargadas por el TenantRouteServiceProvider automáticamente
| y ya tienen tenancy activado (InitializeTenancyByDomain).
|
*/

Route::get('/check', fn() => 'TENANT: ' . tenant('id'));

Route::get('/', function () {
    return view('tenant.landing');
});

Route::middleware(['auth', 'is_active'])->group(function () {
    //
});

Route::view('/privacy-policy', 'tenant.pages.privacy-policy')->name('privacy-policy');

Route::view('/terms-of-service', 'tenant.pages.terms-of-service')->name('terms-of-service');

Route::view('/contact', 'tenant.pages.contact')->name('contact');

Route::view('/blog', 'tenant.blog.index')->name('blog');

Route::view('/about-us', 'tenant.pages.about-us')->name('about');

Route::view('/faq', 'tenant.pages.faq')->name('faq');

Route::get('/register-form', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.submit');

Route::get('/login-form', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'destroy'])->middleware('auth')->name('logout');

//Route::middleware(['check.permission'])->group(function () {});

Route::resource('products', ProductController::class);
Route::resource('services', ServiceController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('permissions', PermissionController::class);
Route::get('/roles/{role}/permissions/edit', [PermissionController::class, 'editPermissions'])->name('roles.permissions.edit');
Route::put('/roles/{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('roles.permissions.update');
Route::resource('appointments', AppointmentController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('pets', PetController::class);
Route::resource('clients', ClientController::class);
Route::resource('billing', BillingController::class);
Route::get('/exams', [ExamController::class, 'showExams'])->name('exams.index');
Route::post('/exams/send', [ExamController::class, 'send'])->name('exams.send');
Route::get('/exams/history/{user}', [ExamController::class, 'history'])->name('exams.history');
Route::post('/clients/store-from-billing', [ClientController::class, 'storeFromBilling'])->name('clients.store.from.billing');


// Rutas appointments

Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
Route::post('/appointments/{appointment}/reactivate', [AppointmentController::class, 'reactivate'])->name('appointments.reactivate');


// Rutas schedules

Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name(name: 'schedules.destroy');
Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
Route::get('/generate-schedules', [ScheduleController::class, 'generateSchedules'])->name('schedules.generate');

// Rutas Notes

Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

// Rutas clinical_records

Route::get('/clinical-records', [ClinicalRecordController::class, 'index'])->name('clinical_records.index');
Route::get('/clinical-records/create', [ClinicalRecordController::class, 'create'])->name('clinical_records.create');
Route::post('/clinical-records', [ClinicalRecordController::class, 'store'])->name('clinical_records.store');
Route::get('/clinical-records/{clinicalRecord}/edit', [ClinicalRecordController::class, 'edit'])->name('clinical_records.edit');
Route::put('/clinical-records/{clinicalRecord}', [ClinicalRecordController::class, 'update'])->name('clinical_records.update');
Route::delete('/clinical-records/{clinicalRecord}', [ClinicalRecordController::class, 'destroy'])->name('clinical_records.destroy');
Route::get('/clinical-records/{clinicalRecord}', [ClinicalRecordController::class, 'show'])->name('clinical_records.show');

// Rutas Preescriptions

Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');
Route::get('/clinical-records/{clinicalRecord}/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
Route::post('/clinical-records/{clinicalRecord}/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
Route::get('/prescriptions/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
Route::put('/prescriptions/{prescription}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
Route::delete('/prescriptions/{prescription}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');

// Rutas Medication

Route::get('/medications', [MedicationController::class, 'index'])->name('medications.index');
Route::get('/medications/create', [MedicationController::class, 'create'])->name('medications.create');
Route::post('/medications', [MedicationController::class, 'store'])->name('medications.store');
Route::get('/medications/{medication}/edit', [MedicationController::class, 'edit'])->name('medications.edit');
Route::put('/medications/{medication}', [MedicationController::class, 'update'])->name('medications.update');
Route::delete('/medications/{medication}', [MedicationController::class, 'destroy'])->name('medications.destroy');

// Rutas Billing
 Route::resource('billing', BillingController::class);
    Route::post('/billing/{billing}/download', [BillingController::class, 'download'])->name('billing.download');

// Rutas Inventory
Route::resource('inventory', InventoryController::class);
// Rutas Supply

Route::resource('supplies', SupplyController::class);
Route::post('/supplies/{supply}/adjust', [SupplyController::class, 'adjustStock'])->name('supplies.adjustStock'); //agregar a permissions:sync
Route::get('supplies/{supply}/movements', [SupplyController::class, 'movements'])->name('supplies.movements');
Route::get('/supplies/{supply}/adjust', [SupplyController::class, 'showAdjustForm'])->name('supplies.adjustStockForm');




//ordenar
Route::resource('services', ServiceController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/roles/{role}/permissions/edit', [PermissionController::class, 'editPermissions'])->name('roles.permissions.edit');
    Route::put('/roles/{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('roles.permissions.update');
    Route::resource('appointments', AppointmentController::class);
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::post('/appointments/{appointment}/reactivate', [AppointmentController::class, 'reactivate'])->name('appointments.reactivate');
    Route::resource('schedules', ScheduleController::class);
    Route::get('/generate-schedules', [ScheduleController::class, 'generateSchedules'])->name('schedules.generate');
    Route::resource('pets', PetController::class);
    Route::resource('supplies', SupplyController::class);
    Route::post('/supplies/{supply}/adjust', [SupplyController::class, 'adjustStock'])->name('supplies.adjustStock'); //agregar a permissions:sync
    Route::get('supplies/{supply}/movements', [SupplyController::class, 'movements'])->name('supplies.movements');
    Route::get('/supplies/{supply}/adjust', [SupplyController::class, 'showAdjustForm'])->name('supplies.adjustStockForm');
    Route::resource('inventory', InventoryController::class);
    Route::resource('billing', BillingController::class);
    Route::post('/billing/{billing}/download', [BillingController::class, 'download'])->name('billing.download');
    Route::post('/clients/store-from-billing', [ClientController::class, 'storeFromBilling'])->name('clients.store.from.billing');
    Route::resource('clients', ClientController::class);
    Route::resource('inventory', InventoryController::class);
    Route::post('/inventory/product', [InventoryController::class, 'storeForProduct'])->name('inventory.storeForProduct');
