<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Manutencao;
use App\Models\Movimentacoes;
use App\Models\Secretaria;
use App\Models\TipoEquipamento;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Filtros
        $query = User::query();

        // Filtro por status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por nome
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ordenação por status (não ativos primeiro)
        if ($request->has('sort')) {
            $query->orderBy('status', $request->sort);
        }

        $users = $query->paginate(10); // Paginação com 10 usuários por página

        return view('users.index', compact('users'));
    }
    public function updateStatus(User $user)
    {
      
        // Alterna o status do usuário
        $user->update(['status' => !$user->status]);

        return redirect()->back()->with('success', 'Status do usuário atualizado com sucesso!');
    }

    public function updateLevel(User $user, Request $request)
    {
        // Validação do nível
        $request->validate([
            'nivel' => 'required|in:1,2,3',
        ]);

        // Atualiza o nível do usuário
        $user->update(['nivel' => $request->nivel]);

        return redirect()->back()->with('success', 'Nível do usuário atualizado com sucesso!');
    }
}
