# 🔧 Solução: Erro "connection to server at localhost" no Railway

## ❌ Problema

O erro mostra que a aplicação está tentando conectar ao `localhost:5432` em vez de usar o `DATABASE_URL` do Railway.

## 🔍 Causa

As **Variable References** (`${{Postgres.DATABASE_URL}}`) não estão sendo resolvidas pelo Railway antes de chegar à aplicação.

## ✅ Solução

### Passo 1: Verificar Conexão dos Serviços

1. No Railway Dashboard, vá ao serviço **Postgres**
2. Clique em **Settings** → **Connected Services**
3. **Certifique-se** de que o serviço **web** está conectado
4. Se não estiver, clique em **Connect** e selecione o serviço **web**

### Passo 2: Verificar Variáveis no Serviço Web

1. No Railway Dashboard, vá ao serviço **web**
2. Clique em **Variables**
3. Verifique se `DATABASE_URL` está presente
4. **IMPORTANTE:** O valor deve ser uma URL completa, NÃO `${{Postgres.DATABASE_URL}}`

### Passo 3: Se as Referências Não Estão Sendo Resolvidas

**Opção A: Usar Variable References (Recomendado)**

As referências `${{Postgres.DATABASE_URL}}` devem funcionar automaticamente quando os serviços estão conectados. Se não funcionarem:

1. **Remova** as variáveis com referências do serviço web
2. **Conecte** o serviço PostgreSQL ao serviço web (Settings → Connected Services)
3. O Railway **injetará automaticamente** `DATABASE_URL` sem precisar de referências

**Opção B: Usar Valores Diretos (Temporário)**

Se as referências não funcionarem, você pode adicionar o `DATABASE_URL` completo diretamente:

1. No serviço PostgreSQL, copie o valor real de `DATABASE_URL`
2. No serviço web, adicione:
   ```
   DATABASE_URL=postgresql://postgres:SENHA@postgres.railway.internal:5432/railway
   ```

### Passo 4: Limpar Cache e Fazer Redeploy

Após fazer as alterações:

1. No Railway, vá ao serviço **web**
2. Clique em **Deployments** → **Redeploy**
3. Ou faça um commit vazio para forçar novo deploy

## 🎯 Verificação

Após o redeploy, verifique os logs do serviço web. Você deve ver:
- ✅ Migrações rodando
- ✅ Seeders rodando
- ✅ Servidor iniciando sem erros

Se ainda houver erro de `localhost`, as variáveis não estão sendo injetadas corretamente.

## 📝 Nota Importante

O Railway **deve** injetar automaticamente `DATABASE_URL` quando:
- ✅ O serviço PostgreSQL está conectado ao serviço web
- ✅ Os serviços estão no mesmo projeto

Você **NÃO precisa** adicionar manualmente as variáveis se os serviços estão conectados!

