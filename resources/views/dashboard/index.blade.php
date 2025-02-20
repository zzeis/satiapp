@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div
            class="bg-white justify-evenly  flex p-6 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <a href="{{ route('equipamentos.index') }}">Equipamentos</a>
            </div>
            <div>
                <a href="{{ route('manutencao.index') }}">Manutenção</a>
            </div>
        </div>

    </div>
@endsection
