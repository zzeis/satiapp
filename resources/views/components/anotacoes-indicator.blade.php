@props([
    'anotacoes' => [],
    'model' => null, // Opcional: modelo relacionado para link
    'showCount' => true, // Mostrar contador
    'showPreview' => true, // Mostrar preview no tooltip
    'iconSize' => 'md', // sm, md, lg
])

@php
    $hasAnotacoes = count($anotacoes) > 0;
    
    // Tamanhos do ícone
    $sizes = [
        'sm' => ['icon' => 'w-4 h-4', 'badge' => 'h-3 w-3 text-[8px]'],
        'md' => ['icon' => 'w-5 h-5', 'badge' => 'h-4 w-4 text-[10px]'],
        'lg' => ['icon' => 'w-6 h-6', 'badge' => 'h-5 w-5 text-xs'],
    ];
    $size = $sizes[$iconSize] ?? $sizes['md'];
@endphp

@if($hasAnotacoes)
    <div class="relative inline-block group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
        <!-- Ícone de anotação -->
        <div class="relative wiggle-animation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                 fill="#FEF08A" stroke="#D97706" stroke-width="1"
                 class="{{ $size['icon'] }} transform rotate-3 hover:rotate-0 transition-transform duration-300">
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
            </svg>
            
            <!-- Badge com contador -->
            @if($showCount)
                <span class="absolute -top-1 -right-1 flex {{ $size['badge'] }} items-center justify-center rounded-full bg-red-500 font-bold text-white">
                    {{ count($anotacoes) }}
                </span>
            @endif
        </div>

        <!-- Tooltip com preview -->
        @if($showPreview)
            <div x-show="open" x-transition
                 class="absolute z-50 w-64 p-2 bg-yellow-100 border border-yellow-300 rounded-lg shadow-lg -left-28 top-full mt-1">
                <div class="text-xs font-medium text-yellow-800 mb-1">
                    {{ count($anotacoes) }} anotação(ões)
                </div>
                <div class="max-h-24 overflow-y-auto">
                    @foreach ($anotacoes->take(2) as $anotacao)
                        <div class="p-2 bg-yellow-50 rounded mb-1 text-xs text-yellow-900 font-handwriting">
                            <div class="truncate">{{ $anotacao->anotacao }}</div>
                            <div class="text-[10px] text-yellow-700 mt-1">
                                {{ $anotacao->user->name }} - {{ $anotacao->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    @endforeach

                    @if (count($anotacoes) > 2)
                        <div class="text-[10px] text-center text-yellow-700 mt-1">
                            + {{ count($anotacoes) - 2 }} mais...
                        </div>
                    @endif
                </div>
                
                @isset($model)
                    <a href="{{ route('equipamentos.detalhes', $model->id) }}#anotacoes"
                       class="block mt-2 text-center text-xs text-blue-600 hover:underline">
                        Ver todas
                    </a>
                @endisset
            </div>
        @endif
    </div>
@endif