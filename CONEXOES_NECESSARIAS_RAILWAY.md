# 🔗 Conexões Necessárias no Railway

## 📋 Serviços e Conexões

### 1. **Postgres → web** ✅ OBRIGATÓRIA

**Por quê:** A aplicação precisa acessar o banco de dados.

**Como conectar:**
1. No Railway, vá para o serviço **Postgres**
2. Clique em **"Settings"**
3. Procure por **"Connected Services"**, **"Networking"** ou **"Dependencies"**
4. Clique em **"Connect Service"** ou **"Add Reference"**
5. Selecione o serviço **web**
6. **SALVE**

**O que isso faz:**
- Injeta `DATABASE_URL` automaticamente no serviço web
- Injeta variáveis `PG*` e `POSTGRES_*` automaticamente
- Permite que a aplicação conecte no banco de dados

**Verificar:**
- Vá para o serviço **web** → **"Variables"**
- Procure por `DATABASE_URL`
- **Deve aparecer!** ✅

### 2. **Postgres → reverb** ⚠️ OPCIONAL

**Por quê:** O Reverb pode precisar acessar o banco se você usar sessões/cache no banco.

**Como conectar:**
- Mesmo processo acima, mas selecione o serviço **reverb** em vez de **web**

**Quando é necessário:**
- Se `SESSION_DRIVER=database`
- Se `CACHE_STORE=database`
- Se o Reverb precisar acessar dados do banco

**Quando NÃO é necessário:**
- Se `SESSION_DRIVER=file`
- Se `CACHE_STORE=file`
- Se o Reverb não acessa o banco diretamente

### 3. **Postgres → worker** ⚠️ OPCIONAL (se usar worker)

**Por quê:** O worker precisa acessar o banco para processar jobs.

**Como conectar:**
- Mesmo processo acima, mas selecione o serviço **worker**

**Quando é necessário:**
- Se você usar `QUEUE_CONNECTION=database`
- Se o worker processar jobs que acessam o banco

**Quando NÃO é necessário:**
- Se você não usar worker
- Se `QUEUE_CONNECTION=sync`

## 📊 Resumo das Conexões

### Configuração Mínima (Atual):
- ✅ **Postgres → web** (OBRIGATÓRIA)

### Configuração Completa (Se usar database para cache/session):
- ✅ **Postgres → web** (OBRIGATÓRIA)
- ⚠️ **Postgres → reverb** (OPCIONAL - só se usar database para cache/session)

### Configuração com Worker:
- ✅ **Postgres → web** (OBRIGATÓRIA)
- ⚠️ **Postgres → reverb** (OPCIONAL)
- ⚠️ **Postgres → worker** (OPCIONAL - só se usar worker)

## 🔍 Como Verificar Conexões

### Verificar se Postgres está conectado ao web:

1. Vá para o serviço **Postgres** → **"Settings"**
2. Procure por **"Connected Services"**
3. Verifique se o serviço **web** está listado
4. **Se estiver = ✅ Conectado!**

### Verificar se as variáveis foram injetadas:

1. Vá para o serviço **web** → **"Variables"**
2. Procure por:
   - `DATABASE_URL` ✅
   - `PGHOST` ✅
   - `PGDATABASE` ✅
   - Outras variáveis `PG*` e `POSTGRES_*` ✅

**Se aparecerem = ✅ Conexão funcionando!**

## ⚠️ Importante

**Sem a conexão Postgres → web:**
- ❌ `DATABASE_URL` não será injetado
- ❌ Aplicação não conseguirá conectar no banco
- ❌ Migrações falharão
- ❌ Aplicação não funcionará

**Com a conexão Postgres → web:**
- ✅ `DATABASE_URL` será injetado automaticamente
- ✅ Aplicação conectará no banco automaticamente
- ✅ Migrações funcionarão
- ✅ Tudo funcionará!

## 🎯 Checklist

- [ ] Postgres está conectado ao serviço web
- [ ] `DATABASE_URL` aparece nas variáveis do serviço web
- [ ] `DB_CONNECTION=pgsql` está configurado
- [ ] Redeploy foi feito após conectar
- [ ] Aplicação está funcionando

## 💡 Dica

**A conexão Postgres → web é a mais importante!**

Sem ela, nada funciona. Com ela, tudo funciona automaticamente! 🚀

