<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Manutencao;
use App\Models\Movimentacoes;
use App\Models\Secretaria;
use App\Models\TipoEquipamento;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de equipamentos
        $totalEquipamentos = Equipamento::count();

        // Equipamentos em estoque
        $equipamentosEstoque = Equipamento::where('status', 'estoque')->count();

        // Equipamentos em uso
        $equipamentosEmUso = Equipamento::where('status', 'em_uso')->count();

        // Manutenções abertas
        $manutencoesAbertas = Manutencao::where('status', 'aberto')->count();

        // Equipamentos por secretaria
        $secretarias = Secretaria::withCount('equipamentos')->get();

        // Distribuição por tipo de equipamento
        $distribuicaoPorTipo = TipoEquipamento::withCount('equipamentos')->get();

        // Status dos equipamentos
        $statusEquipamentos = [

            'em_uso' => Equipamento::where('status', 'em_uso')->count(),
            'estoque' => Equipamento::where('status', 'estoque')->count(),
        ];


        // Atividades recentes - Modificação para incluir equipamentos soft deleted
        $atividadesRecentes = Movimentacoes::with(['equipamento' => function ($query) {
            $query->withTrashed(); // Inclui equipamentos que foram soft deleted
        }])
            ->latest()
            ->take(5)
            ->get();


        // Minhas Movimentações
        $minhasMovimentacoes = Movimentacoes::where('user_id', auth()->id())->count();

        return view('dashboard.index', compact(
            'totalEquipamentos',
            'equipamentosEstoque',
            'equipamentosEmUso',
            'manutencoesAbertas',
            'secretarias',
            'distribuicaoPorTipo',
            'statusEquipamentos',
            'atividadesRecentes',
            'minhasMovimentacoes'
        ));
    }
}
