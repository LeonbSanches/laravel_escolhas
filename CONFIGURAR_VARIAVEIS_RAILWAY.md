# Como Configurar Variáveis de Ambiente no Railway

## Passo a Passo

### 1. Acesse "Shared Variables"

Na página de **Settings** que você está vendo:
- No menu lateral esquerdo, clique em **"Shared Variables"** (ícone de globo 🌐)
- Essas variáveis serão compartilhadas entre todos os serviços do projeto

### 2. Adicione as Variáveis

Clique no botão **"New Variable"** ou **"Add Variable"** e adicione:

#### Variáveis Obrigatórias:

1. **APP_KEY**
   - Valor: Gere com o comando local: `php artisan key:generate --show`
   - Ou use: `base64:3jCt23iFbSZC8nHYuubg75hMyW3g1kPe0N7AhEsNiQc=` (se já tiver)

2. **APP_URL**
   - Valor: A URL do seu app no Railway
   - Exemplo: `https://escolhas-cba.up.railway.app`
   - Ou deixe o Railway injetar automaticamente via `RAILWAY_PUBLIC_DOMAIN`

#### Variáveis Opcionais (mas recomendadas):

3. **APP_ENV**
   - Valor: `production`

4. **APP_DEBUG**
   - Valor: `false`

5. **LOG_LEVEL**
   - Valor: `error` (para produção)

#### Variáveis do Reverb (WebSocket):

6. **REVERB_APP_ID**
   - Valor: Gere um ID único ou use: `railway-app`

7. **REVERB_APP_KEY**
   - Valor: Gere uma chave ou use: `railway-key`

8. **REVERB_APP_SECRET**
   - Valor: Gere um segredo ou use: `railway-secret`

9. **REVERB_HOST**
   - Valor: Deixe vazio ou use o domínio do Railway
   - O Railway injetará automaticamente

10. **REVERB_SCHEME**
    - Valor: `https`

### 3. Variáveis Injetadas Automaticamente

O Railway injeta automaticamente estas variáveis quando você adiciona os serviços:

- **DATABASE_URL** - Quando você adiciona PostgreSQL
- **REDIS_URL** - Quando você adiciona Redis
- **RAILWAY_PUBLIC_DOMAIN** - Domínio público do seu app

**Você NÃO precisa configurar essas manualmente!**

## Alternativa: Variáveis por Serviço

Se preferir configurar variáveis específicas para um serviço:

1. Vá para o serviço específico (ex: "web")
2. Clique em **"Variables"** ou **"Environment Variables"**
3. Adicione as variáveis lá

**Recomendação:** Use "Shared Variables" para variáveis comuns a todos os serviços.

## Gerar Chaves Seguras

Para gerar valores seguros para REVERB_APP_KEY e REVERB_APP_SECRET:

```bash
# No terminal local
php artisan reverb:install
# Isso gerará valores seguros

# Ou gere manualmente:
php artisan tinker
>>> Str::random(32)
```

## Exemplo de Configuração Completa

```
APP_KEY=base64:3jCt23iFbSZC8nHYuubg75hMyW3g1kPe0N7AhEsNiQc=
APP_ENV=production
APP_DEBUG=false
APP_URL=https://escolhas-cba.up.railway.app
LOG_LEVEL=error
REVERB_APP_ID=railway-app
REVERB_APP_KEY=sua-chave-aqui
REVERB_APP_SECRET=seu-segredo-aqui
REVERB_SCHEME=https
```

**Nota:** `DATABASE_URL` e `REDIS_URL` serão injetados automaticamente quando você adicionar os serviços PostgreSQL e Redis.

