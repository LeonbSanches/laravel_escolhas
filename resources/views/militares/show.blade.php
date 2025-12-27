@extends('layouts.app')

@section('title', 'Detalhes do Militar')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-3xl font-bold">Detalhes do Militar</h2>
    <div class="space-x-2">
        <a href="{{ route('militares.edit', $militar) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
            Editar
        </a>
        <a href="{{ route('militares.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
            Voltar
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4">Informações Pessoais</h3>
        <dl class="space-y-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">ID Funcional</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $militar->id_func }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nome Completo</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $militar->nome }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Ordem de Escolha</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $militar->ordem_escolha }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1">
                    @if($militar->jaEscolheu())
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Já escolheu</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Aguardando escolha</span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>

    @if($militar->escolhas->count() > 0)
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Escolha Realizada</h3>
            @foreach($militar->escolhas as $escolha)
                <div class="border rounded-lg p-4">
                    <p class="font-semibold">{{ $escolha->unidade->cidade }}</p>
                    <p class="text-sm text-gray-600">{{ $escolha->unidade->nome }}</p>
                    <p class="text-xs text-gray-500 mt-2">Escolhido em: {{ $escolha->created_at->format('d/m/Y H:i') }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

