# Configuração de WebSockets

O sistema está configurado para usar WebSockets com Laravel Broadcasting e Pusher para atualizar o dashboard em tempo real quando uma nova escolha é registrada.

## Opções de Configuração

### Opção 1: Pusher (Recomendado para Produção)

1. Crie uma conta gratuita em [Pusher](https://pusher.com/)
2. Crie um novo app e obtenha suas credenciais
3. Configure no arquivo `.env`:

```env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=seu_app_id
PUSHER_APP_KEY=seu_app_key
PUSHER_APP_SECRET=seu_app_secret
PUSHER_APP_CLUSTER=seu_cluster
```

### Opção 2: Laravel Reverb (✅ CONFIGURADO - Para Desenvolvimento Local)

Para desenvolvimento local sem depender de serviços externos:

1. ✅ O Laravel Reverb já está instalado e configurado

2. ✅ O `.env` já está configurado com:
```env
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=local
REVERB_APP_KEY=local
REVERB_APP_SECRET=local
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
```

3. **Inicie o servidor Reverb** (em um terminal separado):
```bash
php artisan reverb:start
```

⚠️ **IMPORTANTE**: O servidor Reverb precisa estar rodando para que os WebSockets funcionem!

### Opção 3: Polling (Fallback Simples)

Se não quiser usar WebSockets, você pode usar polling simples. Atualize o dashboard para fazer requisições periódicas:

```javascript
// Adicionar no dashboard.blade.php
setInterval(() => {
    fetch('/dashboard')
        .then(response => response.text())
        .then(html => {
            // Atualizar apenas a parte necessária
        });
}, 5000); // Atualizar a cada 5 segundos
```

## Como Funciona

1. Quando uma escolha é registrada no `OperadorController`, o evento `EscolhaRegistrada` é disparado
2. O evento é transmitido via WebSocket para todos os clientes conectados
3. O dashboard escuta o canal `escolhas` e atualiza a interface automaticamente
4. O mapa e as listas de vagas são atualizados em tempo real

## Testando

1. Abra o dashboard em uma aba do navegador
2. Em outra aba, faça login como operador
3. Registre uma nova escolha
4. O dashboard deve atualizar automaticamente sem precisar recarregar a página

## Notas

- O sistema atual usa uma configuração básica para desenvolvimento
- Para produção, configure adequadamente as credenciais do Pusher ou use Laravel Reverb
- O dashboard recarrega automaticamente após 2 segundos para garantir sincronização completa

