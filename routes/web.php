<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TiketController;
use Illuminate\Support\Facades\Route;

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


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/auth/login', [LoginController::class, 'authenticate'])->name('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/events', [EventController::class, 'index'])->name('event');
    Route::get('/events/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/events/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/events/datatables', [EventController::class, 'eventTable'])->name('event.datatables');
    Route::get('/events/{id}/show', [EventController::class, 'show'])->name('event.show');
    Route::get('/events/{event:created_at}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/events/{id}/update', [EventController::class, 'update'])->name('event.update');
    Route::delete('/events/destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy');

    Route::get('/tickets',[TiketController::class, 'index'])->name('ticket');
    Route::get('/tickets/create', [TiketController::class, 'create'])->name('ticket.create');
    Route::post('/tickets/store', [TiketController::class, 'store'])->name('ticket.store');
    Route::get('/tickets/datatables', [TiketController::class, 'ticketTable'])->name('ticket.datatables');
    Route::get('/tickets/{id}/edit', [TiketController::class, 'edit'])->name('ticket.edit');


    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
