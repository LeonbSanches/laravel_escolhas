@extends('layouts.app')

@section('title', 'Painel do Operador')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold mb-2">Painel do Operador</h2>
    @if($proximoMilitar)
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-4">
            <p class="font-semibold text-yellow-800">Próximo a Escolher:</p>
            <p class="text-yellow-700">{{ $proximoMilitar->nome }} (Ordem: {{ $proximoMilitar->ordem_escolha }})</p>
        </div>
    @endif
</div>

<!-- Formulário para registrar escolha -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h3 class="text-xl font-bold mb-4">Registrar Nova Escolha</h3>
    <form action="{{ route('operador.escolhas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Militar</label>
            <select name="militar_id" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">Selecione um militar</option>
                @foreach($militares as $militar)
                    @if(!$militar->jaEscolheu())
                        <option value="{{ $militar->id }}">{{ $militar->nome }} (Ordem: {{ $militar->ordem_escolha }})</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Unidade</label>
            <select name="unidade_id" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">Selecione uma unidade</option>
                @foreach($unidades as $unidade)
                    @if($unidade->temVagasDisponiveis())
                        <option value="{{ $unidade->id }}">{{ $unidade->nome }} ({{ $unidade->vagasDisponiveis() }} vagas disponíveis)</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Registrar Escolha
            </button>
        </div>
    </form>
</div>

<!-- Lista de Escolhas Registradas -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-xl font-bold mb-4">Escolhas Registradas</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Militar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unidade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cidade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($escolhas as $escolha)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $escolha->militar->ordem_escolha }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $escolha->militar->nome }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $escolha->unidade->nome }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $escolha->unidade->cidade }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $escolha->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <form action="{{ route('operador.escolhas.destroy', $escolha) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja remover esta escolha?')">
                                    Remover
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Nenhuma escolha registrada ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

