<?php

namespace App\Http\Controllers;

use App\Models\Anotacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnotacaoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'anotacao' => 'required|string|max:1000',
            'id_equipamento' => 'nullable|exists:equipamentos,id',
            'id_manutencao' => 'nullable|exists:manutencaos,id',
            'id_termoEntrega' => 'nullable|exists:termo_entregas,id',
        ]);

        // Verifica qual relacionamento está sendo usado
        $relacionamento = [
            'id_equipamento' => $request->id_equipamento,
            'id_manutencao' => $request->id_manutencao,
            'id_termoEntrega' => $request->id_termoEntrega,
        ];

        $anotacao = Anotacao::create(array_merge(
            [
                'anotacao' => $request->anotacao,
                'user_id' => Auth::id(),
            ],
            $relacionamento
        ));

        return back()->with('success', 'Anotação adicionada com sucesso!');
    }

    public function destroy(Anotacao $anotacao)
    {
        $this->authorize('delete', $anotacao);

        $anotacao->delete();

        return back()->with('success', 'Anotação removida com sucesso!');
    }

    public function update(Request $request, Anotacao $anotacao)
    {


        $request->validate([
            'anotacao' => 'required|string|max:1000',
        ]);

        $anotacao->update([
            'anotacao' => $request->anotacao,

        ]);

        return back()->with('success', 'Anotação atualizada com sucesso!');
    }
}
