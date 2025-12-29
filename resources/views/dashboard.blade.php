@extends('layouts.app')

@section('title', 'Dashboard - Vagas Disponíveis')

@section('content')
<style>
    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
</style>

<!-- Área de Notificações -->
<div id="notificacoes-container" class="fixed top-20 right-4 z-50 space-y-2" style="max-width: 400px;"></div>

<div class="mb-6">
    <h2 class="text-3xl font-bold mb-2">Dashboard de Vagas</h2>
    <div id="proximo-militar-container">
        @if($proximoMilitar)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                <p class="font-semibold text-blue-800">Próximo a Escolher:</p>
                <p class="text-blue-700">{{ $proximoMilitar->nome }} (Ordem: {{ $proximoMilitar->ordem_escolha }})</p>
            </div>
        @else
            <div class="bg-gray-50 border-l-4 border-gray-500 p-4 mb-4">
                <p class="text-gray-700">Todos os militares já fizeram suas escolhas.</p>
            </div>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Mapa -->
    <div class="bg-white rounded-lg shadow-lg p-4">
        <h3 class="text-xl font-bold mb-4">Localização das Unidades</h3>
        <div id="map" style="height: 400px; width: 100%;"></div>
    </div>

    <!-- Lista de Unidades -->
    <div class="bg-white rounded-lg shadow-lg p-4">
        <h3 class="text-xl font-bold mb-4">Status das Vagas</h3>
        <div class="space-y-4">
            @foreach($unidades as $unidade)
                <div id="unidade-{{ $unidade['id'] }}" class="border rounded-lg p-4 {{ $unidade['tem_vagas'] ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">
                    <h4 class="font-bold text-lg">{{ $unidade['cidade'] }}</h4>
                    <p class="text-sm text-gray-600">{{ $unidade['nome'] }}</p>
                    <div class="mt-2">
                        <span id="vagas-{{ $unidade['id'] }}" class="inline-block px-2 py-1 rounded text-sm font-semibold {{ $unidade['tem_vagas'] ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $unidade['vagas_disponiveis'] }} / {{ $unidade['quantidade_vagas'] }} vagas disponíveis
                        </span>
                    </div>
                    <div id="escolhas-{{ $unidade['id'] }}" class="mt-2">
                        @if(count($unidade['escolhas']) > 0)
                            <p class="text-xs font-semibold text-gray-700">Escolhido por:</p>
                            <ul class="text-xs text-gray-600 mt-1">
                                @foreach($unidade['escolhas'] as $escolha)
                                    <li>• {{ $escolha['militar'] }} (Ordem: {{ $escolha['ordem'] }})</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Inicializar mapa
    var map = L.map('map').setView([-29.5, -51.2], 9);
    var markers = {};

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Adicionar marcadores para cada unidade
    @foreach($unidades as $unidade)
        @if($unidade['latitude'] && $unidade['longitude'])
            markers[{{ $unidade['id'] }}] = L.marker([{{ $unidade['latitude'] }}, {{ $unidade['longitude'] }}]).addTo(map);
            markers[{{ $unidade['id'] }}].bindPopup(`
                <strong>{{ $unidade['cidade'] }}</strong><br>
                {{ $unidade['nome'] }}<br>
                <span id="popup-vagas-{{ $unidade['id'] }}" class="{{ $unidade['tem_vagas'] ? 'text-green-600' : 'text-red-600' }}">
                    {{ $unidade['vagas_disponiveis'] }} / {{ $unidade['quantidade_vagas'] }} vagas disponíveis
                </span>
            `);
        @endif
    @endforeach

    // Configurar Laravel Echo para WebSockets com Reverb
    let echo = null;
    
    try {
        // Configuração para Laravel Reverb (usando variáveis do controller)
        const broadcastDriver = '{{ $broadcastConfig["driver"] ?? "null" }}';
        const reverbKey = '{{ $broadcastConfig["reverb_key"] ?? "local" }}';
        const reverbHost = '{{ $broadcastConfig["reverb_host"] ?? "localhost" }}';
        const reverbPort = {{ $broadcastConfig["reverb_port"] ?? 8080 }};
        
        if (broadcastDriver === 'reverb') {
            window.Pusher = Pusher;
            
            echo = new Echo({
                broadcaster: 'pusher',
                key: reverbKey,
                cluster: 'mt1',
                wsHost: reverbHost,
                wsPort: reverbPort,
                wssPort: reverbPort,
                forceTLS: false,
                disableStats: true,
                enabledTransports: ['ws', 'wss'],
            });
        }
    } catch (e) {
        // Erro silencioso - WebSocket não disponível
    }

    // Função para mostrar notificação
    function mostrarNotificacao(mensagem, tipo = 'info') {
        const container = document.getElementById('notificacoes-container');
        if (!container) return;
        
        const notificacao = document.createElement('div');
        const cores = {
            success: 'bg-green-500 border-green-600',
            info: 'bg-blue-500 border-blue-600',
            warning: 'bg-yellow-500 border-yellow-600',
            error: 'bg-red-500 border-red-600'
        };
        
        notificacao.className = `${cores[tipo] || cores.info} text-white px-4 py-3 rounded-lg shadow-lg border-l-4 animate-slide-in`;
        notificacao.innerHTML = `
            <div class="flex justify-between items-center">
                <p class="font-semibold">${mensagem}</p>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">×</button>
            </div>
        `;
        
        container.appendChild(notificacao);
        
        // Remover automaticamente após 5 segundos
        setTimeout(() => {
            if (notificacao.parentElement) {
                notificacao.style.opacity = '0';
                notificacao.style.transition = 'opacity 0.5s';
                setTimeout(() => notificacao.remove(), 500);
            }
        }, 5000);
    }

    // Função para processar atualização de escolha
    function processarEscolha(e) {
        const escolha = e.escolha;
        
        // Mostrar notificação
        if (escolha.militar && escolha.militar.nome && escolha.unidade) {
            const mensagem = `${escolha.militar.nome} escolheu ${escolha.unidade.cidade} - ${escolha.unidade.nome}`;
            mostrarNotificacao(mensagem, 'success');
        } else if (escolha.unidade) {
            const mensagem = `Vaga atualizada em ${escolha.unidade.cidade} - ${escolha.unidade.nome}`;
            mostrarNotificacao(mensagem, 'info');
        }
        
        const unidadeId = escolha.unidade.id;
        const unidadeDiv = document.getElementById(`unidade-${unidadeId}`);
        const vagasSpan = document.getElementById(`vagas-${unidadeId}`);
        const escolhasDiv = document.getElementById(`escolhas-${unidadeId}`);
        const popupVagas = document.getElementById(`popup-vagas-${unidadeId}`);
        
        if (unidadeDiv && vagasSpan && escolhasDiv) {
            // Atualizar contador de vagas
            const vagasDisponiveis = escolha.unidade.vagas_disponiveis;
            const totalVagas = escolha.unidade.vagas_ocupadas + vagasDisponiveis;
            
            vagasSpan.textContent = `${vagasDisponiveis} / ${totalVagas} vagas disponíveis`;
            
            // Atualizar classes CSS
            if (vagasDisponiveis > 0) {
                unidadeDiv.className = 'border rounded-lg p-4 bg-green-50 border-green-200';
                vagasSpan.className = 'inline-block px-2 py-1 rounded text-sm font-semibold bg-green-200 text-green-800';
            } else {
                unidadeDiv.className = 'border rounded-lg p-4 bg-red-50 border-red-200';
                vagasSpan.className = 'inline-block px-2 py-1 rounded text-sm font-semibold bg-red-200 text-red-800';
            }
            
            // Adicionar nova escolha à lista (apenas se não for remoção)
            if (escolha.id !== 0 && escolha.militar.nome) {
                const escolhasList = escolhasDiv.querySelector('ul') || (() => {
                    const p = document.createElement('p');
                    p.className = 'text-xs font-semibold text-gray-700';
                    p.textContent = 'Escolhido por:';
                    const ul = document.createElement('ul');
                    ul.className = 'text-xs text-gray-600 mt-1';
                    escolhasDiv.appendChild(p);
                    escolhasDiv.appendChild(ul);
                    return ul;
                })();
                
                const li = document.createElement('li');
                li.textContent = `• ${escolha.militar.nome} (Ordem: ${escolha.militar.ordem_escolha})`;
                escolhasList.appendChild(li);
            }
            
            // Atualizar popup do mapa
            if (popupVagas) {
                popupVagas.textContent = `${vagasDisponiveis} / ${totalVagas} vagas disponíveis`;
                popupVagas.className = vagasDisponiveis > 0 ? 'text-green-600' : 'text-red-600';
            }
            
            // Atualizar popup do marcador no mapa
            if (markers[unidadeId]) {
                markers[unidadeId].setPopupContent(`
                    <strong>${escolha.unidade.cidade}</strong><br>
                    ${escolha.unidade.nome}<br>
                    <span class="${vagasDisponiveis > 0 ? 'text-green-600' : 'text-red-600'}">
                        ${vagasDisponiveis} / ${totalVagas} vagas disponíveis
                    </span>
                `);
            }
            
            // Se a escolha foi removida (id = 0), recarregar para sincronizar
            if (escolha.id === 0) {
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        } else {
            // Elementos não encontrados - recarregar página
            setTimeout(() => {
                window.location.reload();
            }, 500);
        }
    }

    // Escutar eventos via WebSocket se disponível
    if (echo) {
        const channel = echo.channel('escolhas');
        
        // Escutar o evento de escolha registrada
        channel.listen('.escolha.registrada', function(data) {
            processarEscolha(data);
        });
    }

    // Função para atualizar o dashboard
    function atualizarDashboard() {
        fetch('{{ route("dashboard.data") }}')
            .then(response => response.json())
            .then(data => {
                // Atualizar próximo militar
                const proximoMilitarContainer = document.getElementById('proximo-militar-container');
                if (proximoMilitarContainer) {
                    if (data.proximoMilitar) {
                        proximoMilitarContainer.innerHTML = `
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                                <p class="font-semibold text-blue-800">Próximo a Escolher:</p>
                                <p class="text-blue-700">${data.proximoMilitar.nome} (Ordem: ${data.proximoMilitar.ordem_escolha})</p>
                            </div>
                        `;
                    } else {
                        proximoMilitarContainer.innerHTML = `
                            <div class="bg-gray-50 border-l-4 border-gray-500 p-4 mb-4">
                                <p class="text-gray-700">Todos os militares já fizeram suas escolhas.</p>
                            </div>
                        `;
                    }
                }

                // Atualizar unidades
                data.unidades.forEach(unidade => {
                    const unidadeDiv = document.getElementById(`unidade-${unidade.id}`);
                    const vagasSpan = document.getElementById(`vagas-${unidade.id}`);
                    const escolhasDiv = document.getElementById(`escolhas-${unidade.id}`);
                    const popupVagas = document.getElementById(`popup-vagas-${unidade.id}`);

                    if (unidadeDiv && vagasSpan) {
                        // Atualizar contador de vagas
                        vagasSpan.textContent = `${unidade.vagas_disponiveis} / ${unidade.quantidade_vagas} vagas disponíveis`;

                        // Atualizar classes CSS
                        if (unidade.tem_vagas) {
                            unidadeDiv.className = 'border rounded-lg p-4 bg-green-50 border-green-200';
                            vagasSpan.className = 'inline-block px-2 py-1 rounded text-sm font-semibold bg-green-200 text-green-800';
                        } else {
                            unidadeDiv.className = 'border rounded-lg p-4 bg-red-50 border-red-200';
                            vagasSpan.className = 'inline-block px-2 py-1 rounded text-sm font-semibold bg-red-200 text-red-800';
                        }
                    }

                    // Atualizar lista de escolhas
                    if (escolhasDiv) {
                        if (unidade.escolhas.length > 0) {
                            escolhasDiv.innerHTML = `
                                <p class="text-xs font-semibold text-gray-700">Escolhido por:</p>
                                <ul class="text-xs text-gray-600 mt-1">
                                    ${unidade.escolhas.map(escolha => 
                                        `<li>• ${escolha.militar} (Ordem: ${escolha.ordem})</li>`
                                    ).join('')}
                                </ul>
                            `;
                        } else {
                            escolhasDiv.innerHTML = '';
                        }
                    }

                    // Atualizar popup do mapa
                    if (popupVagas) {
                        popupVagas.textContent = `${unidade.vagas_disponiveis} / ${unidade.quantidade_vagas} vagas disponíveis`;
                        popupVagas.className = unidade.tem_vagas ? 'text-green-600' : 'text-red-600';
                    }

                    // Atualizar marcador no mapa
                    if (markers[unidade.id]) {
                        markers[unidade.id].setPopupContent(`
                            <strong>${unidade.cidade}</strong><br>
                            ${unidade.nome}<br>
                            <span class="${unidade.tem_vagas ? 'text-green-600' : 'text-red-600'}">
                                ${unidade.vagas_disponiveis} / ${unidade.quantidade_vagas} vagas disponíveis
                            </span>
                        `);
                    }
                });
            })
            .catch(error => {
                console.error('Erro ao atualizar dashboard:', error);
            });
    }

    // Atualizar dashboard a cada 30 segundos
    setInterval(atualizarDashboard, 30000);
</script>
@endsection

