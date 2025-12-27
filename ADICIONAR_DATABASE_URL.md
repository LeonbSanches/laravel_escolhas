# Como Adicionar DATABASE_URL do Railway

## Passo 1: Obter o DATABASE_PUBLIC_URL do Railway

1. Acesse o Railway Dashboard
2. Vá ao serviço **Postgres**
3. Clique na aba **Variables**
4. Procure por `DATABASE_PUBLIC_URL`
5. **Copie o valor COMPLETO** (não as referências `${{...}}`)

O valor deve ser algo como:
```
postgresql://postgres:SENHA@HOST:PORTA/railway
```

## Passo 2: Adicionar ao .env

Abra o arquivo `.env` e adicione ou atualize:

```env
DATABASE_URL=postgresql://postgres:SENHA@HOST:PORTA/railway
```

**Exemplo:**
```env
DATABASE_URL=postgresql://postgres:hRNqCoSFSaFOODgdFyRkTbzCKILFwkqv@centerbeam.proxy.rlwy.net:38646/railway
```

## Passo 3: Limpar Cache e Rodar Seeders

```bash
php artisan config:clear
php artisan db:seed --force
```

## Importante

- O `DATABASE_URL` tem **prioridade** sobre as variáveis individuais (`DB_HOST`, `DB_DATABASE`, etc.)
- Quando `DATABASE_URL` estiver configurado, a aplicação usará ele automaticamente
- Não precisa configurar `DB_HOST`, `DB_DATABASE`, etc. se usar `DATABASE_URL`

