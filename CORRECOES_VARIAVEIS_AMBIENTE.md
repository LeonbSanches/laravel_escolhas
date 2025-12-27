# Correções Necessárias nas Variáveis de Ambiente

## 🔴 PROBLEMAS CRÍTICOS ENCONTRADOS

### 1. **DATABASE_URL** - Referência Circular
**Valor Atual:** `DATABASE_URL=${DATABASE_URL}`
**Problema:** Referência circular! O Railway não consegue injetar o valor.
**Correção:** **REMOVER** esta variável completamente. O Railway injeta `DATABASE_URL` automaticamente quando o PostgreSQL está conectado.

### 2. **REDIS_URL** - Referência Circular
**Valor Atual:** `REDIS_URL=${REDIS_URL}`
**Problema:** Referência circular!
**Correção:** **REMOVER** esta variável completamente. O Railway injeta `REDIS_URL` automaticamente quando o Redis está conectado.

### 3. **REDIS_HOST** - Valor Incorreto
**Valor Atual:** `REDIS_HOST=127.0.0.1`
**Problema:** Faz o Laravel tentar conectar ao Redis local mesmo quando não está disponível.
**Correção:** **REMOVER** esta variável. Se Redis estiver configurado, o Railway injeta automaticamente.

### 4. **REDIS_PORT** - Valor Incorreto
**Valor Atual:** `REDIS_PORT=6379`
**Problema:** Pode causar tentativas de conexão desnecessárias.
**Correção:** **REMOVER** esta variável. Se Redis estiver configurado, o Railway injeta automaticamente.

### 5. **REDIS_PASSWORD** - Valor "null" como String
**Valor Atual:** `REDIS_PASSWORD=null`
**Problema:** String "null" pode causar problemas.
**Correção:** **REMOVER** esta variável ou deixar vazia.

### 6. **REVERB_HOST** - Valor Incorreto
**Valor Atual:** `REVERB_HOST=0.0.0.0`
**Problema:** `0.0.0.0` é para o servidor, não para o hostname público.
**Correção:** Alterar para `REVERB_HOST=escolhas-cba.up.railway.app` (ou usar `RAILWAY_PUBLIC_DOMAIN`)

### 7. **MAIL_* com valores "null"**
**Valores Atuais:**
- `MAIL_PASSWORD=null`
- `MAIL_USERNAME=null`
- `MAIL_SCHEME=null`
**Problema:** String "null" pode causar problemas.
**Correção:** **REMOVER** essas variáveis ou deixar vazias.

### 8. **SESSION_DOMAIN** - Valor "null"
**Valor Atual:** `SESSION_DOMAIN=null`
**Problema:** String "null" pode causar problemas.
**Correção:** **REMOVER** esta variável ou deixar vazia.

### 9. **LOG_DEPRECATIONS_CHANNEL** - Valor "null"
**Valor Atual:** `LOG_DEPRECATIONS_CHANNEL=null`
**Problema:** String "null" pode causar problemas.
**Correção:** **REMOVER** esta variável ou deixar vazia.

## ✅ VARIÁVEIS QUE DEVEM SER REMOVIDAS

Remova estas variáveis do Railway (elas são injetadas automaticamente ou causam problemas):

1. ❌ `DATABASE_URL=${DATABASE_URL}` - **REMOVER** (Railway injeta automaticamente)
2. ❌ `REDIS_URL=${REDIS_URL}` - **REMOVER** (Railway injeta automaticamente se Redis estiver configurado)
3. ❌ `REDIS_HOST=127.0.0.1` - **REMOVER** (Railway injeta automaticamente)
4. ❌ `REDIS_PORT=6379` - **REMOVER** (Railway injeta automaticamente)
5. ❌ `REDIS_PASSWORD=null` - **REMOVER**
6. ❌ `MAIL_PASSWORD=null` - **REMOVER**
7. ❌ `MAIL_USERNAME=null` - **REMOVER**
8. ❌ `MAIL_SCHEME=null` - **REMOVER**
9. ❌ `SESSION_DOMAIN=null` - **REMOVER**
10. ❌ `LOG_DEPRECATIONS_CHANNEL=null` - **REMOVER**

## 🔧 VARIÁVEIS QUE DEVEM SER CORRIGIDAS

1. **REVERB_HOST**: Alterar de `0.0.0.0` para `escolhas-cba.up.railway.app`

## ✅ VARIÁVEIS CORRETAS (MANTER)

Todas as outras variáveis estão corretas e devem ser mantidas.

## 📝 RESUMO DAS AÇÕES

1. **Remover** 10 variáveis problemáticas listadas acima
2. **Corrigir** `REVERB_HOST` de `0.0.0.0` para `escolhas-cba.up.railway.app`
3. **Verificar** se o PostgreSQL está conectado ao serviço web (para `DATABASE_URL` ser injetado)

