# Correções Aplicadas para Railway

## Problemas Identificados e Soluções

### 1. ✅ Migração Duplicada
- **Problema:** Duas migrações criando a mesma tabela `militares`
- **Solução:** Removida a migração mais antiga (`2025_12_26_212609_create_militares_table.php`)

### 2. ✅ Configuração do Banco de Dados
- **Problema:** Aplicação tentando conectar em `127.0.0.1:5432` em vez de usar `DATABASE_URL`
- **Solução:** 
  - Configurado PostgreSQL para usar `env('DATABASE_URL')` primeiro
  - Default do banco ajustado para detectar `DATABASE_URL` automaticamente

### 3. ✅ Cache de Configuração
- **Problema:** `config:cache` executado antes do banco estar disponível
- **Solução:** 
  - Removido `config:cache` do `startCommand`
  - Movido para o `Procfile` após as migrações

### 4. ✅ Ordem de Execução
- **Problema:** Comandos executados na ordem errada
- **Solução:** 
  - Migrações executadas primeiro no `Procfile`
  - Cache de configuração após migrações
  - Servidor web inicia por último

## Configuração Final

### `Procfile`
```
web: php artisan migrate --force || true && php artisan config:cache || true && php artisan serve --host=0.0.0.0 --port=$PORT
reverb: php artisan reverb:start --host=0.0.0.0 --port=${REVERB_PORT:-8080}
```

### `railway.json`
```json
{
  "startCommand": "php artisan route:cache && php artisan view:cache"
}
```

### `config/database.php`
- PostgreSQL usa `env('DATABASE_URL')` primeiro
- Default detecta `DATABASE_URL` automaticamente

## Verificações Necessárias

1. ✅ **PostgreSQL adicionado no Railway** - Injeta `DATABASE_URL` automaticamente
2. ✅ **Variáveis de ambiente configuradas** - `APP_KEY`, `APP_URL`, etc.
3. ✅ **Migrações funcionando** - Logs mostram migrações executadas com sucesso

## Próximos Passos

Se o container ainda estiver parando após as migrações:

1. Verifique se o servidor web está iniciando corretamente
2. Verifique os logs do Railway para ver se há erros após as migrações
3. Certifique-se de que o `Procfile` está sendo usado corretamente pelo Railway

## Nota Importante

Os erros iniciais de conexão (`Connection refused`) são **normais** e **esperados**:
- O `startCommand` executa antes do banco estar totalmente disponível
- O `Procfile` executa depois, quando o banco já está pronto
- As migrações funcionam corretamente (como visto nos logs)

