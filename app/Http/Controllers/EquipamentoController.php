<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Pessoa;
use App\Models\Secretaria;
use App\Models\TipoEquipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EquipamentoController extends Controller
{
    public function index()
    {
        $equipamentos = Equipamento::with(['secretaria', 'responsavel'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('equipamentos.index', compact('equipamentos'));
    }

    public function create()
    {
        $secretarias = Secretaria::all();

        $tipos = TipoEquipamento::all();

        $pessoas = Pessoa::all();
        return view('equipamentos.create', compact('pessoas', 'secretarias', 'tipos'));
    }

    public function store(Request $request)
    {

        // Se o status for estoque,
        if ($request->input('status') === 'estoque') {
            $request->merge([
                'secretaria_id' => 9,  // ID da SATI
                'responsavel_id' => null,
                'data_saida' => null
            ]);
        }
        $validator = Validator::make($request->all(), [
            'secretaria_id' => 'required|exists:secretarias,id',
            'responsavel_id' => 'nullable|exists:pessoas,id',
            'status' => 'required|in:manutencao,em_uso,estoque,descartado',
            'tipo_id' => 'required|string|max:255',
            'numero_serie' => ['required', 'string', Rule::unique('equipamentos')->whereNull('deleted_at')],
            'modelo' => 'required|string|max:255',
            'especificacoes' => 'nullable|string',
            'data_chegada' => 'nullable|date',
            'data_ultima_manutencao' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }



        Equipamento::create($request->all());

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento cadastrado com sucesso!');
    }

    public function show(Equipamento $equipamento)
    {
        return view('equipamentos.show', compact('equipamento'));
    }

    public function edit(Equipamento $equipamento)
    {
        $secretarias = Secretaria::all();

        $tiposEquipamento = TipoEquipamento::all();

        $pessoas = Pessoa::all();
        return view('equipamentos.edit', compact('equipamento', 'tiposEquipamento', 'secretarias', 'pessoas'));
    }

    public function update(Request $request, Equipamento $equipamento)
    {
        $validator = Validator::make($request->all(), [
            'secretaria_id' => 'required|exists:secretarias,id',
            'responsavel_id' => 'nullable|exists:pessoas,id',
            'status' => 'required|in:manutencao,em_uso,estoque,descartado',
            'tipo_id' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:equipamentos,numero_serie,' . $equipamento->id,
            'modelo' => 'required|string|max:255',
            'especificacoes' => 'nullable|string',
            'data_chegada' => 'nullable|date',
            'data_ultima_manutencao' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $equipamento->update($request->all());

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento atualizado com sucesso!');
    }

    public function destroy(Equipamento $equipamento)
    {
        $equipamento->delete();

        return redirect()
            ->route('equipamentos.index')
            ->with('success', 'Equipamento removido com sucesso!');
    }

    public function trashed()
    {
        $equipamentos = Equipamento::onlyTrashed()
            ->with(['secretaria', 'responsavel'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('equipamentos.trashed', compact('equipamentos'));
    }

    public function restore($id)
    {
        $equipamento = Equipamento::onlyTrashed()->findOrFail($id);
        $equipamento->restore();

        return redirect()
            ->route('equipamentos.trashed')
            ->with('success', 'Equipamento restaurado com sucesso!');
    }

    public function forceDelete($id)
    {
        $equipamento = Equipamento::onlyTrashed()->findOrFail($id);
        $equipamento->forceDelete();

        return redirect()
            ->route('equipamentos.trashed')
            ->with('success', 'Equipamento excluído permanentemente!');
    }
}
