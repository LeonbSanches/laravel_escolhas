# Deploy no Railway - Guia de Configuração

## Variáveis de Ambiente Necessárias

Configure as seguintes variáveis de ambiente no painel do Railway:

### Obrigatórias
- `APP_KEY` - Chave da aplicação Laravel (gerada automaticamente ou use: `php artisan key:generate --show`)
- `DATABASE_URL` - URL do PostgreSQL (injetada automaticamente pelo Railway se você adicionar um serviço PostgreSQL)
- `APP_URL` - URL da aplicação (ex: `https://seu-app.up.railway.app`)

### Opcionais (mas recomendadas)
- `REDIS_URL` - URL do Redis (injetada automaticamente se você adicionar um serviço Redis)
- `RAILWAY_PUBLIC_DOMAIN` - Domínio público do Railway (injetado automaticamente)

### Redis (Opcional)
Se você adicionar um serviço Redis no Railway, as seguintes variáveis serão injetadas automaticamente:
- `REDIS_URL` - URL completa do Redis
- `REDIS_HOST`
- `REDIS_PORT`
- `REDIS_PASSWORD`

**Nota:** Se Redis não estiver configurado, a aplicação usará automaticamente `database` para:
- Queue (`QUEUE_CONNECTION`)
- Cache (`CACHE_STORE`)
- Session (`SESSION_DRIVER`)

### Reverb (WebSocket)
- `REVERB_APP_ID` - ID da aplicação Reverb (padrão: `local`)
- `REVERB_APP_KEY` - Chave da aplicação Reverb (padrão: `local`)
- `REVERB_APP_SECRET` - Segredo da aplicação Reverb (padrão: `local`)
- `REVERB_HOST` - Host do Reverb (padrão: `0.0.0.0`)
- `REVERB_PORT` - Porta do Reverb (padrão: `8080`)
- `REVERB_SCHEME` - Esquema (padrão: `https`)

## Estrutura do Procfile

O Railway usa o `Procfile` para definir os processos:

- `web` - Servidor web principal (PHP Artisan Serve)
- `reverb` - Servidor WebSocket Reverb
- `worker` - Worker de filas (comentado por padrão - descomente se necessário)

## Build e Deploy

O Railway detecta automaticamente Laravel e executa:
1. `composer install --no-dev --optimize-autoloader`
2. `npm ci && npm run build`
3. `php artisan migrate --force`
4. `php artisan config:cache`
5. `php artisan route:cache`
6. `php artisan view:cache`

## Configuração Recomendada

1. **Adicione um serviço PostgreSQL** no Railway
2. **Adicione um serviço Redis** (opcional, mas recomendado para produção)
3. **Configure as variáveis de ambiente** listadas acima
4. **Faça o deploy** - o Railway detectará automaticamente o Laravel

## Troubleshooting

### Erro de conexão com Redis
- Se você não tem Redis configurado, a aplicação usará `database` automaticamente
- Para usar Redis, adicione um serviço Redis no Railway

### Erro de migração
- Certifique-se de que o `DATABASE_URL` está configurado
- As migrações são executadas automaticamente no deploy

### Erro de build do frontend
- Certifique-se de que o `package.json` está no repositório
- O Railway executa `npm ci && npm run build` automaticamente

