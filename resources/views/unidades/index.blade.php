@extends('layouts.app')

@section('title', 'Unidades')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-3xl font-bold">Gerenciar Unidades (Vagas)</h2>
    <a href="{{ route('unidades.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        + Nova Unidade
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($unidades as $unidade)
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $unidade->cidade }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $unidade->nome }}</p>
                </div>
                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $unidade->temVagasDisponiveis() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $unidade->vagasDisponiveis() }}/{{ $unidade->quantidade_vagas }}
                </span>
            </div>
            
            <div class="mb-4">
                <p class="text-sm text-gray-700">
                    <span class="font-medium">Vagas ocupadas:</span> {{ $unidade->vagasOcupadas() }}
                </p>
                <p class="text-sm text-gray-700">
                    <span class="font-medium">Vagas disponíveis:</span> {{ $unidade->vagasDisponiveis() }}
                </p>
            </div>

            @if($unidade->escolhas->count() > 0)
                <div class="mb-4 border-t pt-3">
                    <p class="text-xs font-semibold text-gray-700 mb-2">Escolhido por:</p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        @foreach($unidade->escolhas as $escolha)
                            <li>• {{ $escolha->militar->nome }} (Ordem: {{ $escolha->militar->ordem_escolha }})</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-end space-x-2 mt-4">
                <a href="{{ route('unidades.show', $unidade) }}" class="text-blue-600 hover:text-blue-900 text-sm">Ver</a>
                <a href="{{ route('unidades.edit', $unidade) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Editar</a>
                <form action="{{ route('unidades.destroy', $unidade) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Tem certeza que deseja excluir esta unidade?')">Excluir</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow-lg p-6 text-center text-gray-500">
            Nenhuma unidade cadastrada.
        </div>
    @endforelse
</div>
@endsection

