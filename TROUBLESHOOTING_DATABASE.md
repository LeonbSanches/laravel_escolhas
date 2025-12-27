# Troubleshooting - Erro de Conexão com PostgreSQL

## Problema
```
SQLSTATE[08006] [7] connection to server at "127.0.0.1", port 5432 failed: Connection refused
```

## Causas Possíveis

### 1. ⚠️ PostgreSQL não está conectado ao serviço web
**Solução:**
1. No Railway, vá para o serviço PostgreSQL
2. Clique em "Settings" ou "Variables"
3. Verifique se o serviço PostgreSQL está **conectado** ao serviço web
4. Se não estiver, adicione uma **referência** do PostgreSQL ao serviço web

### 2. ⚠️ DATABASE_URL não está sendo injetado
**Verificação:**
- No Railway, vá para o serviço web
- Clique em "Variables"
- Verifique se `DATABASE_URL` está listada (ela deve aparecer automaticamente)

**Se não estiver:**
1. Certifique-se de que o PostgreSQL está no mesmo projeto
2. Adicione uma referência do PostgreSQL ao serviço web

### 3. ⚠️ Cache de configuração com valores antigos
**Solução:** Já corrigido no Procfile com `config:clear`

### 4. ⚠️ Variável DB_CONNECTION não está definida
**Verificação:**
- No Railway, verifique se `DB_CONNECTION=pgsql` está nas variáveis de ambiente

## Passos para Resolver

### Passo 1: Verificar Conexão do PostgreSQL
1. No Railway, abra o serviço PostgreSQL
2. Vá em "Settings" → "Connected Services"
3. Certifique-se de que o serviço web está listado

### Passo 2: Verificar Variáveis de Ambiente
No serviço web, verifique se estas variáveis existem:
- `DATABASE_URL` (deve aparecer automaticamente)
- `DB_CONNECTION=pgsql`

### Passo 3: Limpar Cache (já no Procfile)
O Procfile já tem `config:clear` antes de `config:cache`

### Passo 4: Verificar Logs
Se ainda não funcionar, verifique os logs do Railway para ver se o `DATABASE_URL` está sendo injetado corretamente.

## Configuração Correta

### Variáveis de Ambiente Necessárias:
```
DB_CONNECTION=pgsql
DATABASE_URL=${DATABASE_URL}  (injetado automaticamente pelo Railway)
```

### Procfile (já corrigido):
```
web: php artisan config:clear && php artisan migrate --force || true && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=$PORT
```

## Nota sobre Redis
O erro "Class 'Redis' not found" é normal se você não tiver Redis configurado. A aplicação usará `database` como fallback automaticamente.

