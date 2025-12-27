# Mudanças Aplicadas para Deploy no Railway

## ✅ Correções Realizadas no Código

### 1. **config/database.php**
- ✅ Corrigido para detectar `DATABASE_URL` automaticamente
- ✅ Default do banco agora usa `pgsql` quando `DATABASE_URL` está presente
- ✅ Configuração PostgreSQL agora usa `DATABASE_URL` primeiro, depois `DB_URL`

### 2. **Procfile**
- ✅ Ajustado para usar `${PORT}` (sintaxe compatível com Railway)
- ✅ Mantido o processo `reverb` para WebSockets
- ✅ Comandos de cache e migração já configurados

### 3. **railway.json**
- ✅ Já estava configurado corretamente
- ✅ Usa NIXPACKS como builder
- ✅ Comandos de build otimizados

## 📋 O Que Você Precisa Fazer no Railway

### Passo 1: Adicionar Serviço PostgreSQL
1. No Railway, clique em **"+ New"** → **"Database"** → **"Add PostgreSQL"**
2. O Railway injetará automaticamente a variável `DATABASE_URL` no seu serviço web

### Passo 2: Conectar PostgreSQL ao Serviço Web
1. Vá para o serviço **PostgreSQL**
2. Em **"Settings"** → **"Connected Services"** ou **"Networking"**
3. Adicione uma referência ao serviço **web** (sua aplicação Laravel)
4. Isso garante que `DATABASE_URL` seja injetado automaticamente

### Passo 3: Configurar Variáveis de Ambiente
No Railway, vá para **"Settings"** → **"Shared Variables"** e adicione:

#### Variáveis Obrigatórias:
```
APP_KEY=base64:SUA_CHAVE_AQUI
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seu-app.up.railway.app
DB_CONNECTION=pgsql
```

**Para gerar APP_KEY:**
```bash
php artisan key:generate --show
```

#### Variáveis do Reverb (WebSocket):
```
REVERB_APP_ID=railway-app
REVERB_APP_KEY=railway-key
REVERB_APP_SECRET=railway-secret
REVERB_SCHEME=https
```

**Nota:** `REVERB_HOST` será preenchido automaticamente com o domínio do Railway.

#### Variáveis Opcionais (mas recomendadas):
```
LOG_LEVEL=error
CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

### Passo 4: Variáveis que NÃO Devem ser Adicionadas
❌ **NÃO adicione estas variáveis** - o Railway injeta automaticamente:
- `DATABASE_URL` (injetado quando PostgreSQL está conectado)
- `REDIS_URL` (injetado se você adicionar Redis)
- `RAILWAY_PUBLIC_DOMAIN` (injetado automaticamente)

### Passo 5: Fazer o Deploy
1. Conecte seu repositório Git ao Railway
2. O Railway detectará automaticamente que é um projeto Laravel
3. O build será executado automaticamente usando o `railway.json`
4. As migrações serão executadas automaticamente no `Procfile`

## 🔍 Verificações Pós-Deploy

### Verificar se DATABASE_URL está disponível:
1. No Railway, vá para o serviço **web**
2. Clique em **"Variables"**
3. Verifique se `DATABASE_URL` aparece na lista (deve aparecer automaticamente)

### Se DATABASE_URL não aparecer:
1. Verifique se o PostgreSQL está conectado ao serviço web
2. Certifique-se de que ambos os serviços estão no mesmo projeto
3. Tente fazer um redeploy

## 📝 Estrutura de Processos

O Railway usará o `Procfile` para iniciar os processos:

- **web**: Servidor Laravel principal (porta definida por `${PORT}`)
- **reverb**: Servidor WebSocket Reverb (porta 8080)

## 🚀 Comandos Executados Automaticamente

Durante o build (via `railway.json`):
- `composer install --no-dev --optimize-autoloader`
- `npm ci && npm run build`

Durante o deploy (via `Procfile`):
- `php artisan config:clear`
- `php artisan migrate --force`
- `php artisan route:cache`
- `php artisan view:cache`
- `php artisan serve` (inicia o servidor)

## ⚠️ Observações Importantes

1. **Banco de Dados**: A aplicação agora detecta automaticamente `DATABASE_URL` e usa PostgreSQL quando disponível
2. **Porta**: O Railway define a porta automaticamente via variável `${PORT}`
3. **Cache**: Os caches são gerados automaticamente durante o deploy
4. **Migrações**: Executadas automaticamente com `--force` (sem confirmação)

## 🐛 Troubleshooting

### Erro: "Connection refused" ao conectar no PostgreSQL
- Verifique se o PostgreSQL está conectado ao serviço web
- Verifique se `DATABASE_URL` aparece nas variáveis do serviço web

### Erro: "APP_KEY is not set"
- Adicione `APP_KEY` nas variáveis de ambiente
- Gere uma nova chave com: `php artisan key:generate --show`

### Erro: Migrações falhando
- Verifique se `DATABASE_URL` está configurado
- Verifique os logs do Railway para ver o erro específico

