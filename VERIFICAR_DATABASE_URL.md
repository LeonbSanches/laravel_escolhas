# Como Verificar se DATABASE_URL está Disponível no Railway

## 🔍 Verificação no Railway

### Passo 1: Verificar Conexão do PostgreSQL
1. No Railway, vá para o serviço **PostgreSQL**
2. Clique em **"Settings"** ou **"Variables"**
3. Procure por **"Connected Services"** ou **"Networking"**
4. Verifique se o serviço **web** está listado como conectado
5. Se não estiver, você precisa **conectar** o PostgreSQL ao serviço web

### Passo 2: Verificar Variáveis de Ambiente do Serviço Web
1. No Railway, vá para o serviço **web** (sua aplicação Laravel)
2. Clique em **"Variables"**
3. Procure por `DATABASE_URL` na lista
4. **Se `DATABASE_URL` NÃO aparecer**, significa que o PostgreSQL não está conectado ao serviço web

### Passo 3: Conectar PostgreSQL ao Serviço Web
Se o `DATABASE_URL` não aparecer:

1. No serviço PostgreSQL, vá em **"Settings"**
2. Procure por **"Connected Services"** ou **"Networking"**
3. Clique em **"Connect Service"** ou **"Add Reference"**
4. Selecione o serviço **web**
5. O Railway injetará automaticamente o `DATABASE_URL` no serviço web

## ✅ Verificação Rápida

Execute este comando no terminal do Railway (ou adicione temporariamente no Procfile para debug):

```bash
echo "DATABASE_URL: $DATABASE_URL"
```

Se retornar vazio, o `DATABASE_URL` não está disponível.

## 🔧 Solução Alternativa

Se o PostgreSQL não puder ser conectado ao serviço web, você pode:

1. **Adicionar manualmente** a variável `DATABASE_URL` no serviço web
2. **Copiar** o valor do `DATABASE_URL` do serviço PostgreSQL
3. **Colar** no serviço web como variável de ambiente

Mas o ideal é conectar os serviços para que o Railway faça isso automaticamente.

