<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\GymController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\PaymentPaypalController;
use App\Http\Controllers\Client\CustomerController as ClientCustomerController;
use App\Http\Controllers\Client\PanelController as ClientPanelController;
use App\Http\Middleware\RateMailMiddleware;
use App\Models\Panel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

// index
Route::get('', [ClientPanelController::class, 'index'])->name('principal');

// gimnasios
Route::get('/gimnasio', [GymController::class, 'index'])->name('gimnasio');

// perfil
Route::get('/perfil', [CustomerController::class, 'index'])->name('perfil'); // perfil index
Route::post('/perfil', [CustomerController::class, 'shearch'])->name('perfil.shearch'); // perfil buscar


// enviar email
Route::middleware(RateMailMiddleware::class)
    ->post('/perfil/send/{customer}', [CustomerController::class, 'sendEmail'])
    ->name('perfil.send');
// link mail actualizar
Route::get('/perfil/{customer}/edit', [CustomerController::class, 'edit'])->name('perfil.edit'); //solo abrir con el email enviado
Route::post('/perfil/update/{customer}', [CustomerController::class, 'update'])->name('perfil.update'); //solo 2 veces por mes

// registrarse
Route::get('/register/customer', [CustomerController::class, 'create'])->name('perfil.create');
Route::post('/register/customer', [CustomerController::class, 'store'])->name('perfil.store');

// procesar membresia
Route::get('/register/{customer}/membresia', [PaymentPaypalController::class, 'paypal'])->name('perfil.paypal');
Route::post('/paypal-process-order/{customer}/{order}/{membership}/{coach?}', [PaymentPaypalController::class, 'processSuccessOrder'])->name('perfil.paypal.process');

// **********************************************************************************
// dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function() {
    Route::get('', function(){
        return view('Admin.index');
    })->name('dashboard');

    Route::get('panel', [PanelController::class, 'index'])->name('dashboard.panel');
    Route::patch('panel/update/{panel}', [PanelController::class, 'update'])->name('dashboard.panel.update');

    Route::resource('customer', ClientCustomerController::class);
    Route::get('customer/membership/{customer}', [ClientCustomerController::class, 'membership'])->name('customer.membership');
    Route::patch('customer/update/{customer}', [ClientCustomerController::class, 'membershipUpdate'])->name('customer.membership.update');
});








// Route::post('/perfil/send/{customer}', [CustomerController::class, 'sendEmail'])
//     ->name('perfil.send');



// Route::get('/perfil', function () {
//     //return view('welcome');
//     $panels=Panel::all();
//     return view('Client.perfil', compact('panels'));
// })->name('perfil');
// Route::get('/perfil/maria', function () {
//     //return view('welcome');
//     $panels=Panel::all();
//     return view('Client.show', compact('panels'));
// });
