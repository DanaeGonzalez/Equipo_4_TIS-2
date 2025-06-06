<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

// Controllers
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
use App\Http\Controllers\ExamController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SupplyController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
| Estas rutas son cargadas por el TenantRouteServiceProvider automáticamente
| y ya tienen tenancy activado (InitializeTenancyByDomain).
*/

Route::get('/check', fn() => 'TENANT: ' . tenant('id'));

Route::get('/', fn() => view('tenant.landing'));

// Páginas públicas
Route::view('/privacy-policy', 'tenant.pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-of-service', 'tenant.pages.terms-of-service')->name('terms-of-service');
Route::view('/contact', 'tenant.pages.contact')->name('contact');
Route::view('/blog', 'tenant.blog.index')->name('blog');
Route::view('/about-us', 'tenant.pages.about-us')->name('about');
Route::view('/faq', 'tenant.pages.faq')->name('faq');

// Autenticación
Route::get('/register-form', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.submit');
Route::get('/login-form', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'destroy'])->middleware('auth')->name('logout');

// Rutas protegidas
Route::middleware(['auth', 'is_active'])->group(function () {

    // Administración
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/roles/{role}/permissions/edit', [PermissionController::class, 'editPermissions'])->name('roles.permissions.edit');
    Route::put('/roles/{role}/permissions', [PermissionController::class, 'updatePermissions'])->name('roles.permissions.update');

    // Servicios y productos
    Route::resource('services', ServiceController::class);
    Route::resource('products', ProductController::class);

    // Clientes y mascotas
    Route::resource('clients', ClientController::class);
    Route::post('/clients/store-from-billing', [ClientController::class, 'storeFromBilling'])->name('clients.store.from.billing');
    Route::resource('pets', PetController::class);

    // Citas
    Route::resource('appointments', AppointmentController::class);
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::post('/appointments/{appointment}/reactivate', [AppointmentController::class, 'reactivate'])->name('appointments.reactivate');

    // Horarios
    Route::resource('schedules', ScheduleController::class)->except(['show']);;
    Route::get('/generate-schedules', [ScheduleController::class, 'generateSchedules'])->name('schedules.generate');
    Route::get('/schedules/manage', [ScheduleController::class, 'manage'])->name('schedules.manage');
    Route::post('/schedules/{schedule}/toggle', [ScheduleController::class, 'toggle'])->name('schedules.toggle');
    Route::get('/schedules/calendar/events', [ScheduleController::class, 'getCalendarEvents'])->name('calendar.events');


    // Notas
    Route::resource('notes', NoteController::class);

    // Registros clínicos
    Route::resource('clinical_records', ClinicalRecordController::class);

    // Prescripciones
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/clinical-records/{clinicalRecord}/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/clinical-records/{clinicalRecord}/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('/prescriptions/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
    Route::put('/prescriptions/{prescription}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
    Route::delete('/prescriptions/{prescription}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');

    // Medicamentos
    Route::resource('medications', MedicationController::class);

    // Facturación
    Route::resource('billing', BillingController::class);
    Route::post('/billing/{billing}/download', [BillingController::class, 'download'])->name('billing.download');

    // Exámenes
    Route::get('/exams', [ExamController::class, 'showExams'])->name('exams.index');
    Route::post('/exams/send', [ExamController::class, 'send'])->name('exams.send');
    Route::get('/exams/history/{user}', [ExamController::class, 'history'])->name('exams.history');
    

    // Inventario
    Route::resource('inventory', InventoryController::class);
    Route::post('/inventory/product', [InventoryController::class, 'storeForProduct'])->name('inventory.storeForProduct');

    // Insumos
    Route::resource('supplies', SupplyController::class);
    Route::post('/supplies/{supply}/adjust', [SupplyController::class, 'adjustStock'])->name('supplies.adjustStock');
    Route::get('/supplies/{supply}/adjust', [SupplyController::class, 'showAdjustForm'])->name('supplies.adjustStockForm');
    Route::get('supplies/{supply}/movements', [SupplyController::class, 'movements'])->name('supplies.movements');
});