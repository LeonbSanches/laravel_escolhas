# ✅ Verificar DATABASE_URL no Railway - Guia Rápido

## 🎯 Passo a Passo Simples

### 1. Verificar no Serviço Web

1. No Railway, vá para o serviço **web** (sua aplicação)
2. Clique em **"Variables"** (ou "Environment Variables")
3. Procure por **`DATABASE_URL`** na lista

**Se aparecer:**
- ✅ Tudo certo! A aplicação pode usar o banco
- A URL estará no formato: `mysql://...` ou `postgresql://...`

**Se NÃO aparecer:**
- ❌ O banco não está conectado ao serviço web
- Continue com o passo 2

### 2. Conectar o Banco ao Serviço Web

1. No Railway, vá para o serviço do banco (**MySQL** ou **PostgreSQL**)
2. Clique em **"Settings"**
3. Procure por:
   - **"Connected Services"**
   - **"Networking"**
   - **"Dependencies"**
   - **"Service Connections"**
4. Clique em **"Connect Service"** ou **"Add Reference"**
5. Selecione o serviço **web**
6. **SALVE**

### 3. Verificar Novamente

Após conectar:

1. Volte para o serviço **web**
2. Vá em **"Variables"**
3. **`DATABASE_URL` deve aparecer agora!**

### 4. Fazer Redeploy (Opcional)

Para garantir que tudo funcione:

1. No serviço **web**, clique em **"Deploy"** → **"Redeploy"**
2. Aguarde o deploy terminar

## 📋 Checklist

- [ ] `DATABASE_URL` aparece nas variáveis do serviço web?
- [ ] Se não aparecer, o banco está conectado ao serviço web?
- [ ] Redeploy foi feito após conectar?

## ⚠️ Importante

**Você NÃO precisa copiar a URL manualmente!**

O Railway injeta `DATABASE_URL` automaticamente quando:
- ✅ O banco está no mesmo projeto
- ✅ O banco está conectado ao serviço web

**A aplicação Laravel usa essa variável automaticamente!**

## 🔍 Onde Está a URL?

A URL está em:
- **Serviço Web → Variables → `DATABASE_URL`** (após conectar o banco)

**Não precisa procurar em outro lugar!** Se `DATABASE_URL` aparecer nas variáveis do serviço web, está tudo certo! ✅

