<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    public function buscarPorNome(Request $request)
    {
        $nome = $request->input('nome');

        // Busca a pessoa pelo nome (usando LIKE para correspondência parcial)
        $pessoa = Pessoa::where('nome', 'like', '%' . $nome . '%')->first();

        if ($pessoa) {
            return response()->json([
                'success' => true,
                'pessoa' => [
                    'id' => $pessoa->id,
                    'nome' => $pessoa->nome,
                    'cpf' => $pessoa->cpf,
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pessoa não encontrada.',
            ]);
        }
    }
}