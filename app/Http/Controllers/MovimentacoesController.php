<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Manutencao;
use App\Models\Movimentacoes;
use App\Models\Secretaria;
use App\Models\TipoEquipamento;
use App\Models\User;
use Illuminate\Http\Request;

class MovimentacoesController extends Controller
{
    public function index(Request $request)
    {
        // Consulta base para movimentações
        $query = Movimentacoes::with(['equipamento', 'user']);

        // Filtro por usuário
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filtro por intervalo de datas
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filtro "Recentes"
        if ($request->has('filter') && $request->filter === 'recentes') {
            $query->orderBy('created_at', 'desc');
        }

        // Paginação ou limite de resultados
        $atividadesRecentes = $query->latest()->paginate(20);

        // Total de movimentações do usuário atual
        $minhasMovimentacoes = Movimentacoes::where('user_id', auth()->id())->count();

        // Lista de usuários para o filtro
        $users = User::all();


       


        // Minhas Movimentações
        $minhasMovimentacoes = Movimentacoes::where('user_id', auth()->id())->count();

        return view('movimentacoes.index', compact(
            'atividadesRecentes',
            'minhasMovimentacoes',
            'users',
        ));
    }

    public function detalhes(Movimentacoes $movimentacao)
    {
        // Carrega os relacionamentos necessários
        $movimentacao->load([
            'equipamento',
            'user',
            'manutencao',
            'termo'
        ]);



        return view('movimentacoes.detalhes', compact('movimentacao'));
    }
}
