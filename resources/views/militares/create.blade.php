@extends('layouts.app')

@section('title', 'Novo Militar')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold">Cadastrar Novo Militar</h2>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="{{ route('militares.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ID Funcional *</label>
                <input type="text" name="id_func" value="{{ old('id_func') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('id_func')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ordem de Escolha *</label>
                <input type="number" name="ordem_escolha" value="{{ old('ordem_escolha') }}" required min="1"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('ordem_escolha')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo *</label>
                <input type="text" name="nome" value="{{ old('nome') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nome')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('militares.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Salvar
            </button>
        </div>
    </form>
</div>
@endsection

