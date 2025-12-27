@extends('layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-3xl font-bold">Detalhes do Usuário</h2>
    <div class="space-x-2">
        <a href="{{ route('users.edit', $user) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
            Editar
        </a>
        <a href="{{ route('users.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
            Voltar
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <dl class="space-y-3">
        <div>
            <dt class="text-sm font-medium text-gray-500">Nome</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Email</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Tipo de Usuário</dt>
            <dd class="mt-1">
                @if($user->isAdmin())
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Administrador</span>
                @else
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Usuário</span>
                @endif
            </dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Criado em</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
        </div>
    </dl>
</div>
@endsection

