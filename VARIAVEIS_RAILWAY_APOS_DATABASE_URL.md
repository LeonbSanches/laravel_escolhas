# Variáveis para Usar APÓS DATABASE_URL Estar Disponível

## ⚠️ IMPORTANTE

Use estas variáveis **APENAS** depois que `DATABASE_URL` aparecer nas variáveis do serviço web no Railway.

## Variáveis que Devem ser Alteradas

Após `DATABASE_URL` estar disponível, altere estas três variáveis:

```json
{
  "CACHE_STORE": "database",
  "SESSION_DRIVER": "database",
  "QUEUE_CONNECTION": "database"
}
```

## Por Que Mudar?

- **`CACHE_STORE=database`**: Usa o banco de dados para cache (mais rápido e escalável)
- **`SESSION_DRIVER=database`**: Armazena sessões no banco (melhor para múltiplos servidores)
- **`QUEUE_CONNECTION=database`**: Usa o banco para filas de jobs (mais confiável)

## Quando Usar

✅ **Use `database` quando:**
- `DATABASE_URL` está disponível
- PostgreSQL está conectado e funcionando
- Você quer melhor performance e escalabilidade

❌ **Use `file`/`sync` quando:**
- `DATABASE_URL` não está disponível
- Está em desenvolvimento local
- Está testando a conexão

## Checklist

- [ ] `DATABASE_URL` aparece nas variáveis do serviço web
- [ ] PostgreSQL está conectado ao serviço web
- [ ] Migrações foram executadas com sucesso
- [ ] Alterar `CACHE_STORE` para `database`
- [ ] Alterar `SESSION_DRIVER` para `database`
- [ ] Alterar `QUEUE_CONNECTION` para `database`
- [ ] Fazer redeploy

