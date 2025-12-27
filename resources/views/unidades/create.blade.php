@extends('layouts.app')

@section('title', 'Nova Unidade')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Cadastrar Nova Unidade</h2>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="{{ route('unidades.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nome da Unidade *</label>
                <input type="text" name="nome" value="{{ old('nome') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ex: CRPOSerra-3°BPAT/Bento Gonçalves">
                @error('nome')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cidade *</label>
                <input type="text" name="cidade" value="{{ old('cidade') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ex: Bento Gonçalves">
                @error('cidade')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Quantidade de Vagas *</label>
                <input type="number" name="quantidade_vagas" value="{{ old('quantidade_vagas') }}" required min="1"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('quantidade_vagas')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Latitude (opcional)</label>
                <input type="number" step="any" name="latitude" value="{{ old('latitude') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ex: -29.1719">
                @error('latitude')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Longitude (opcional)</label>
                <input type="number" step="any" name="longitude" value="{{ old('longitude') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ex: -51.5192">
                @error('longitude')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('unidades.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Salvar
            </button>
        </div>
    </form>
</div>
@endsection

