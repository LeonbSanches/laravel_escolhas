# Solução para Erro de Conexão com PostgreSQL

## 🔴 Erro Encontrado
```
SQLSTATE[08006] [7] connection to server at "localhost" (::1), port 5432 failed: Connection refused
```

Este erro indica que o Laravel está tentando conectar em `localhost` em vez de usar o `DATABASE_URL` do Railway.

## ✅ Correções Aplicadas

### 1. **config/database.php**
- ✅ Removidos valores padrão de `localhost` (127.0.0.1) e porta 5432
- ✅ Agora quando `DATABASE_URL` estiver presente, o Laravel usará apenas a URL
- ✅ Sem valores padrão, o Laravel não tentará conectar em localhost

### 2. **Procfile**
- ✅ Adicionado `cache:clear` antes das migrações
- ✅ Adicionado `config:cache` após as migrações para regenerar o cache com valores corretos

## 🔍 Verificações Necessárias no Railway

### Passo 1: Verificar se DATABASE_URL está disponível

1. No Railway, vá para o serviço **web** (sua aplicação)
2. Clique em **"Variables"** ou **"Environment Variables"**
3. Procure por `DATABASE_URL` na lista
4. **Se `DATABASE_URL` NÃO aparecer**, você precisa conectar o PostgreSQL ao serviço web

### Passo 2: Conectar PostgreSQL ao Serviço Web

Se `DATABASE_URL` não aparecer nas variáveis:

1. No Railway, vá para o serviço **PostgreSQL**
2. Clique em **"Settings"**
3. Procure por **"Connected Services"**, **"Networking"** ou **"Service Connections"**
4. Clique em **"Connect Service"** ou **"Add Reference"**
5. Selecione o serviço **web** (sua aplicação Laravel)
6. O Railway injetará automaticamente o `DATABASE_URL` no serviço web

### Passo 3: Verificar Variável DB_CONNECTION

Certifique-se de que `DB_CONNECTION=pgsql` está configurado nas variáveis de ambiente:

1. No Railway, vá para **"Settings"** → **"Shared Variables"**
2. Verifique se existe: `DB_CONNECTION=pgsql`
3. Se não existir, adicione esta variável

### Passo 4: Limpar Cache e Fazer Redeploy

Após conectar o PostgreSQL e configurar as variáveis:

1. No Railway, vá para o serviço **web**
2. Clique em **"Deploy"** → **"Redeploy"** ou faça um novo commit
3. Isso garantirá que o cache seja limpo e a configuração seja recarregada

## 🧪 Teste Rápido

Para verificar se `DATABASE_URL` está disponível, você pode adicionar temporariamente no `Procfile`:

```bash
web: echo "DATABASE_URL: $DATABASE_URL" && php artisan config:clear && php artisan cache:clear && php artisan migrate --force || true && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=${PORT}
```

Isso mostrará o valor de `DATABASE_URL` nos logs do Railway.

## 🔧 Solução Alternativa (Manual)

Se não conseguir conectar os serviços automaticamente:

1. No Railway, vá para o serviço **PostgreSQL**
2. Clique em **"Variables"**
3. Copie o valor de `DATABASE_URL` (algo como: `postgresql://user:password@host:port/database`)
4. No serviço **web**, vá em **"Variables"**
5. Adicione manualmente: `DATABASE_URL` = (cole o valor copiado)

## ⚠️ Importante

- **NÃO** adicione `DATABASE_URL` manualmente se os serviços estiverem conectados - o Railway faz isso automaticamente
- **SEMPRE** limpe o cache (`config:clear` e `cache:clear`) antes de fazer deploy
- Certifique-se de que `DB_CONNECTION=pgsql` está configurado

## 📝 Checklist

- [ ] PostgreSQL está adicionado no Railway
- [ ] PostgreSQL está conectado ao serviço web
- [ ] `DATABASE_URL` aparece nas variáveis do serviço web
- [ ] `DB_CONNECTION=pgsql` está configurado
- [ ] Cache foi limpo (via redeploy)
- [ ] Aplicação foi redeployada

