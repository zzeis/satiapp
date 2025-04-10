<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnotacaoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\MovimentacoesController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TermoEntregaController;
use App\Models\User;
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

Route::get('/preview-email', function () {
    // Dados fictícios para a view
    $manutencao = (object) [
        'equipamento' => (object) [
            'tipo' => (object) ['nome' => 'Tipo de Equipamento'],
            'modelo' => 'Modelo XYZ',
            'numero_serie' => '123456',
        ],
        'descricao_problema' => 'Problema de teste',
        'secretaria' => (object) ['nome' => 'Secretaria de Teste'],
        'local' => 'Local de Teste',
        'observacoes' => 'Observações de teste',
    ];

    // Simular a variável $message
    $message = new \Illuminate\Mail\Message(new \Symfony\Component\Mime\Email());
    $message->embed(public_path('images/logo.png'), 'logo');

    return view('emails.solicitacao_manutencao', [
        'manutencao' => $manutencao,
        'message' => $message,
    ]);
});


// rotas pessoa
Route::middleware(['auth', 'verified'])->group(function () {

    Route::post('/pessoa/buscar-por-nome', [PessoaController::class, 'buscarPorNome'])->name('pessoa.buscar-por-nome');
});

//rotas anotacoes 
Route::middleware('auth')->group(function () {
    Route::post('anotacoes', [AnotacaoController::class, 'store'])->name('anotacoes.store');
    Route::delete('anotacoes/{anotacao}', [AnotacaoController::class, 'destroy'])->name('anotacoes.destroy');
    Route::put('anotacoes/{anotacao}', [AnotacaoController::class, 'update'])->name('anotacoes.update');
});

//rotas movimentacoes
Route::middleware(['auth', 'verified', 'user.status'])->group(function () {

    Route::get('movimentacoes', [MovimentacoesController::class, 'index'])->name('movimentacoes.index');
    Route::get('movimentacoes/{movimentacao}/detalhes', [MovimentacoesController::class, 'detalhes'])->name('movimentacoes.detalhes');
});

//rotas usuarios 
Route::middleware(['auth', 'verified', 'user.status', 'user.level:2,3'])->group(function () {

    Route::get('users', [AdminController::class, 'index'])->name('users.index');
    Route::put('users/{user}/status', [AdminController::class, 'updateStatus'])->name('users.updateStatus');
    Route::put('users/{user}/level', [AdminController::class, 'updateLevel'])->name('users.updateLevel');

    Route::get('/dashboard/report', [DashboardController::class, 'showReport'])
        ->name('dashboard.report');

    // Rota para exportar Excel
    Route::get('/dashboard/export/excel', [DashboardController::class, 'exportReport'])
        ->name('dashboard.export.excel');
});
//rotas Termo de entrega
Route::middleware(['auth', 'verified', 'user.status'])->group(function () {
    Route::get('TermoDeEntrega', [TermoEntregaController::class, 'index'])->name('termo.index');
    Route::get('TermoDeEntrega/create', [TermoEntregaController::class, 'create'])->name('termo.create');
    Route::post('TermoDeEntrega/store', [TermoEntregaController::class, 'store'])->name('termo.store');
    Route::post('/TermoDeEntrega/{termoEntrega}/devolucao', [TermoEntregaController::class, 'devolucao'])->name('termo.devolucao');

    Route::get('TermoDeEntrega/{termoEntrega}/edit', [TermoEntregaController::class, 'edit'])->name('termo.edit');
    Route::put('TermoDeEntrega/{termoEntrega}', [TermoEntregaController::class, 'update'])->name('termo.update');

    Route::get('TermoDeEntrega/verificar-processamento/{termoEntrega}', [TermoEntregaController::class, 'verificarProcessamento'])
        ->name('termo.verificar_processamento');

    Route::get('TermoDeEntrega/show/{termoEntrega}', [TermoEntregaController::class, 'show'])->name('termo.show');

    Route::get('/TermoDeEntrega/previewpdf', [TermoEntregaController::class, 'previewPDF'])->name('termo.previewpdf');


    Route::post('equipamento/check-serial', [EquipamentoController::class, 'store'])->name('equipamento.check-serial');
});

//rotas manutenção 
Route::middleware(['auth', 'verified', 'user.status'])->group(function () {
    Route::get('manutencao', [ManutencaoController::class, 'index'])->name('manutencao.index');
    Route::get('manutencao/create', [ManutencaoController::class, 'create'])->name('manutencao.create');
    Route::post('manutencao/store', [ManutencaoController::class, 'store'])->name('manutencao.store');
    Route::put('manutencao/update/{manutencao}', [ManutencaoController::class, 'update'])->name('manutencao.update');
    Route::put('manutencao/{manutencao}/destroy', [ManutencaoController::class, 'destroy'])->name('manutencao.destroy');

    // Rotas para manutenção
    Route::put('/manutencao/{manutencao}/concluir', [ManutencaoController::class, 'concluir'])->name('manutencao.concluir');
    Route::post('/manutencao/{manutencao}/retirar', [ManutencaoController::class, 'retirar'])->name('manutencao.retirar');
    Route::put('/manutencao/{manutencao}/trocar', [ManutencaoController::class, 'trocar'])->name('manutencao.trocar');
    Route::post('manutencao/retirada/{manutencao}', [ManutencaoController::class, 'registrarRetirada'])->name('manutencao.retirada');
    Route::get('manutencao/gerenciar/{manutencao}', [ManutencaoController::class, 'gerenciarManutencao'])->name('manutencao.gerenciar');
    // Rota para buscar detalhes da manutenção
    Route::get('/manutencao/{manutencao}/detalhes', [ManutencaoController::class, 'detalhes'])->name('manutencao.detalhes');



    Route::get('/equipamentos/filtrar', [EquipamentoController::class, 'filtrar']);
    // Rota para detalhes da manutenção
    Route::get('/manutencao/{manutencao}/informacoes', [ManutencaoController::class, 'informacoes'])->name('manutencao.informacoes');
});

Route::middleware(['auth', 'verified', 'user.status'])->group(function () {

    Route::get('equipamentos', [EquipamentoController::class, 'index'])->name('equipamentos.index');
    Route::get('equipamentos/create', [EquipamentoController::class, 'create'])->name('equipamentos.create');
    Route::post('equipamentos/store', [EquipamentoController::class, 'store'])->name('equipamentos.store');
    Route::put('equipamentos/update/{equipamento}', [EquipamentoController::class, 'update'])->name('equipamentos.update');
    Route::get('equipamentos/edit/{equipamento}', [EquipamentoController::class, 'edit'])->name('equipamentos.edit');
    Route::get('equipamentos/detalhes/{equipamento}', [EquipamentoController::class, 'detalhes'])->name('equipamentos.detalhes');


    Route::get('/equipamentos/search', [TermoEntregaController::class, 'searchEquipment'])->name('equipamentos.search');
    Route::delete('equipamentos/delete/{equipamento}', [EquipamentoController::class, 'destroy'])->name('equipamentos.destroy');

    Route::get('equipamentos-trashed', [EquipamentoController::class, 'trashed'])->name('equipamentos.trashed');
    Route::post('/equipamento/buscar-por-serial', [EquipamentoController::class, 'buscarPorSerial'])->name('equipamento.buscar-por-serial');

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
