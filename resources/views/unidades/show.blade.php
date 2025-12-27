@extends('layouts.app')

@section('title', 'Detalhes da Unidade')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-3xl font-bold">Detalhes da Unidade</h2>
    <div class="space-x-2">
        <a href="{{ route('unidades.edit', $unidade) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
            Editar
        </a>
        <a href="{{ route('unidades.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
            Voltar
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4">Informações da Unidade</h3>
        <dl class="space-y-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nome</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $unidade->nome }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Cidade</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $unidade->cidade }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Quantidade de Vagas</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $unidade->quantidade_vagas }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Vagas Ocupadas</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $unidade->vagasOcupadas() }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Vagas Disponíveis</dt>
                <dd class="mt-1">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $unidade->temVagasDisponiveis() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $unidade->vagasDisponiveis() }}
                    </span>
                </dd>
            </div>
            @if($unidade->latitude && $unidade->longitude)
                <div>
                    <dt class="text-sm font-medium text-gray-500">Localização</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $unidade->latitude }}, {{ $unidade->longitude }}</dd>
                </div>
            @endif
        </dl>
    </div>

    @if($unidade->escolhas->count() > 0)
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Escolhas Registradas</h3>
            <div class="space-y-3">
                @foreach($unidade->escolhas as $escolha)
                    <div class="border rounded-lg p-4">
                        <p class="font-semibold">{{ $escolha->militar->nome }}</p>
                        <p class="text-sm text-gray-600">Ordem de escolha: {{ $escolha->militar->ordem_escolha }}</p>
                        <p class="text-xs text-gray-500 mt-2">Escolhido em: {{ $escolha->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Escolhas Registradas</h3>
            <p class="text-gray-500">Nenhuma escolha registrada para esta unidade ainda.</p>
        </div>
    @endif
</div>

@if($unidade->latitude && $unidade->longitude)
    <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4">Localização no Mapa</h3>
        <div id="map" style="height: 400px; width: 100%;"></div>
    </div>

    <script>
        var map = L.map('map').setView([{{ $unidade->latitude }}, {{ $unidade->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([{{ $unidade->latitude }}, {{ $unidade->longitude }}]).addTo(map);
        marker.bindPopup('<strong>{{ $unidade->cidade }}</strong><br>{{ $unidade->nome }}');
    </script>
@endif
@endsection

