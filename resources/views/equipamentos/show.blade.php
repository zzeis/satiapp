@extends('layouts.app')

@section('title', 'Detalhes do Equipamento')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Detalhes do Equipamento</h1>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Nº Série:</strong> {{ $equipamento->numero_serie }}</p>
        <p><strong>Modelo:</strong> {{ $equipamento->modelo }}</p>
        <p><strong>Status:</strong> {{ $equipamento->status }}</p>
        <p><strong>Data de Chegada:</strong> {{ $equipamento->data_chegada }}</p>
        <p><strong>Última Manutenção:</strong> {{ $equipamento->data_ultima_manutencao }}</p>
    </div>

    <a href="{{ route('equipamentos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mt-4 inline-block">
        Voltar
    </a>
@endsection