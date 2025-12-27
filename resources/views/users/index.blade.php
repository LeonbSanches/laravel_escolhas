@extends('layouts.app')

@section('title', 'Usuários')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-3xl font-bold">Gerenciar Usuários</h2>
    <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        + Novo Usuário
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->isAdmin())
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Administrador</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Usuário</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                        <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        @if($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhum usuário cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

