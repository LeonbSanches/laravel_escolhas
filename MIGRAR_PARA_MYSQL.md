# Como Migrar para MySQL no Railway

## ✅ Vantagens do MySQL

- Mais simples de configurar
- Melhor suporte no Railway
- Menos problemas com conexão
- Compatível com todas as migrações Laravel

## 📋 Passos para Configurar MySQL no Railway

### 1. Adicionar MySQL no Railway

1. No Railway, vá para seu projeto
2. Clique em **"+ New"** → **"Database"** → **"MySQL"**
3. O Railway criará automaticamente um serviço MySQL
4. O Railway injetará automaticamente o `DATABASE_URL` no formato MySQL

### 2. Conectar MySQL ao Serviço Web

1. No serviço MySQL, vá em **"Settings"**
2. Procure por **"Connected Services"** ou **"Networking"**
3. Clique em **"Connect Service"** ou **"Add Reference"**
4. Selecione o serviço **web**
5. O Railway injetará automaticamente o `DATABASE_URL` no serviço web

### 3. Atualizar Variáveis de Ambiente

No serviço web, atualize:

**Alterar:**
- `DB_CONNECTION=pgsql` → `DB_CONNECTION=mysql`

**Manter:**
- Todas as outras variáveis (exceto as que foram removidas)

### 4. Remover PostgreSQL (Opcional)

Se não precisar mais do PostgreSQL:
1. No Railway, vá para o serviço PostgreSQL
2. Clique em **"Settings"** → **"Danger"**
3. Clique em **"Delete Service"**

## 🔄 O que foi Ajustado no Código

### `config/database.php`
- MySQL agora usa `DATABASE_URL` quando disponível
- Detecta automaticamente se `DATABASE_URL` é MySQL ou PostgreSQL
- Default ajustado para detectar MySQL automaticamente

### `config/queue.php`
- Batching e failed jobs agora detectam MySQL automaticamente

## ✅ Verificação

Após configurar o MySQL:

1. Verifique se `DATABASE_URL` aparece nas variáveis do serviço web
2. Verifique se `DB_CONNECTION=mysql` está configurado
3. Faça deploy novamente

O MySQL deve funcionar sem os problemas que você estava tendo com PostgreSQL!

