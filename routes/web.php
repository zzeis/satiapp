<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('manutencao', [ManutencaoController::class, 'index'])->name('manutencao.index');
    Route::get('manutencao/create', [ManutencaoController::class, 'create'])->name('manutencao.create');
    Route::post('manutencao/store', [ManutencaoController::class, 'store'])->name('manutencao.store');
    Route::put('manutencao/update/{manutencao}', [ManutencaoController::class, 'update'])->name('manutencao.update');
    Route::get('manutencao/retirada/{manutencao}', [ManutencaoController::class, 'registrarRetirada'])->name('manutencao.registrar-retirada');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('equipamentos', [EquipamentoController::class, 'index'])->name('equipamentos.index');
    Route::get('equipamentos/create', [EquipamentoController::class, 'create'])->name('equipamentos.create');
    Route::post('equipamentos/store', [EquipamentoController::class, 'store'])->name('equipamentos.store');
    Route::put('equipamentos/update/{equipamento}', [EquipamentoController::class, 'update'])->name('equipamentos.update');
    Route::get('equipamentos/edit/{equipamento}', [EquipamentoController::class, 'edit'])->name('equipamentos.edit');
    Route::delete('equipamentos/delete/{equipamento}', [EquipamentoController::class, 'destroy'])->name('equipamentos.destroy');

    Route::get('equipamentos-trashed', [EquipamentoController::class, 'trashed'])->name('equipamentos.trashed');

    Route::patch('equipamentos-trashed/{id}/restore', [EquipamentoController::class, 'restore'])->name('equipamentos.restore');
    Route::delete('equipamentos-trashed/{id}/force-delete', [EquipamentoController::class, 'forceDelete'])->name('equipamentos.forceDelete');




    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
