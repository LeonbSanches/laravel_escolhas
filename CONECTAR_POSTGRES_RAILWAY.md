# 🔗 Conectar PostgreSQL ao Serviço Web no Railway

## 🎯 Objetivo

Conectar o serviço **Postgres** ao serviço **web** para que o Railway injete automaticamente as variáveis `DATABASE_URL` e outras variáveis do PostgreSQL.

## 📋 Passo a Passo

### Passo 1: Conectar PostgreSQL ao Serviço Web

1. No Railway, vá para o serviço **Postgres** (não o serviço web)
2. Clique em **"Settings"** (ícone de engrenagem ⚙️)
3. Procure por uma dessas opções:
   - **"Connected Services"**
   - **"Networking"**
   - **"Dependencies"**
   - **"Service Connections"**
   - **"Connect"** (botão)
4. Clique em **"Connect Service"**, **"Add Reference"**, **"Link Service"** ou botão similar
5. Selecione o serviço **web** (sua aplicação Laravel)
6. **SALVE** as alterações

### Passo 2: Verificar se DATABASE_URL Apareceu

Após conectar:

1. Vá para o serviço **web**
2. Clique em **"Variables"** ou **"Environment Variables"**
3. Procure por **`DATABASE_URL`**
4. **Deve aparecer agora!** (formato: `postgresql://postgres:senha@host:port/railway`)

**Se aparecer = ✅ PostgreSQL está conectado!**

### Passo 3: Configurar DB_CONNECTION

No serviço **web** → **"Variables"**, certifique-se de que:

```
DB_CONNECTION=pgsql
```

**Se não estiver, adicione esta variável.**

### Passo 4: Fazer Redeploy

Após conectar e configurar:

1. No serviço **web**, clique em **"Deploy"** → **"Redeploy"**
2. Aguarde o deploy terminar
3. Verifique os logs para ver se as migrações foram executadas

## 📊 Variáveis que Serão Injetadas Automaticamente

Quando você conectar o PostgreSQL ao serviço web, o Railway injetará automaticamente:

- ✅ `DATABASE_URL` - URL interna (para uso dentro do Railway)
- ✅ `DATABASE_PUBLIC_URL` - URL pública (para conexões externas)
- ✅ `PGHOST` - Host do PostgreSQL
- ✅ `PGPORT` - Porta (5432)
- ✅ `PGDATABASE` - Nome do banco (railway)
- ✅ `PGUSER` - Usuário (postgres)
- ✅ `PGPASSWORD` - Senha
- ✅ `POSTGRES_DB` - Nome do banco
- ✅ `POSTGRES_USER` - Usuário
- ✅ `POSTGRES_PASSWORD` - Senha

**Você NÃO precisa adicionar essas variáveis manualmente!**

## ✅ O Que Foi Ajustado no Código

A aplicação agora suporta todas as variáveis do PostgreSQL do Railway:

1. **`DATABASE_URL`** - Prioridade 1 (URL completa)
2. **`DATABASE_PUBLIC_URL`** - Prioridade 2 (URL pública)
3. **Variáveis individuais:**
   - `PGHOST` → host
   - `PGPORT` → port
   - `PGDATABASE` ou `POSTGRES_DB` → database
   - `PGUSER` ou `POSTGRES_USER` → username
   - `PGPASSWORD` ou `POSTGRES_PASSWORD` → password

## 📋 Checklist

- [ ] PostgreSQL está conectado ao serviço web (via Settings → Connected Services)
- [ ] `DATABASE_URL` aparece nas variáveis do serviço web
- [ ] `DB_CONNECTION=pgsql` está configurado
- [ ] Redeploy foi feito após conectar
- [ ] Migrações foram executadas (verificar logs)
- [ ] Aplicação está funcionando

## 🎯 Informações do Seu PostgreSQL

Baseado nas variáveis que você mostrou:

- **Banco de dados:** railway
- **Usuário:** postgres
- **Senha:** rEzgkcKnAlbptkdSmLMardlyJpsSPrmO
- **URL pública:** postgresql://postgres:senha@centerbeam.proxy.rlwy.net:38646/railway
- **URL interna:** postgresql://postgres:senha@postgres.railway.internal:5432/railway

## 🚀 Próximo Passo

**Agora é só conectar o PostgreSQL ao serviço web e fazer redeploy!**

O PostgreSQL está pronto, a aplicação está configurada - só falta conectar os dois! 🎉

## 💡 Dica

Se você não conseguir encontrar a opção "Connected Services":
- Procure por **"Networking"** ou **"Dependencies"**
- Ou procure por um botão **"Connect"** na página do serviço PostgreSQL
- A interface do Railway pode variar, mas a funcionalidade está lá!

