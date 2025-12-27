@extends('layouts.app')

@section('title', 'Militares')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-3xl font-bold">Gerenciar Militares</h2>
    <a href="{{ route('militares.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        + Novo Militar
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Funcional</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($militares as $militar)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $militar->ordem_escolha }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $militar->id_func }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $militar->nome }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($militar->jaEscolheu())
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Já escolheu</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Aguardando</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('militares.show', $militar) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                        <a href="{{ route('militares.edit', $militar) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        <form action="{{ route('militares.destroy', $militar) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este militar?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Nenhum militar cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

