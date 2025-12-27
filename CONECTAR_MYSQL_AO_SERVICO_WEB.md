# 🔗 Como Conectar MySQL ao Serviço Web no Railway

## 🔴 Problema

Você não tem `DATABASE_URL` nas variáveis porque o **MySQL não está conectado ao serviço web**.

## ✅ Solução: Conectar MySQL ao Serviço Web

### Passo 1: Verificar se MySQL Existe

1. No Railway, vá para seu projeto
2. Verifique se há um serviço **MySQL** na lista
3. **Se NÃO houver**, você precisa adicionar primeiro:
   - Clique em **"+ New"** → **"Database"** → **"MySQL"**
   - Aguarde o MySQL ser criado

### Passo 2: Conectar MySQL ao Serviço Web

1. No Railway, vá para o serviço **MySQL**
2. Clique em **"Settings"** (ícone de engrenagem ⚙️)
3. Procure por uma dessas opções:
   - **"Connected Services"**
   - **"Networking"**
   - **"Dependencies"**
   - **"Service Connections"**
   - **"Connect"**
4. Clique em **"Connect Service"**, **"Add Reference"**, **"Link Service"** ou botão similar
5. Selecione o serviço **web** (sua aplicação Laravel)
6. **SALVE** as alterações

### Passo 3: Verificar se DATABASE_URL Apareceu

Após conectar:

1. Vá para o serviço **web**
2. Clique em **"Variables"** ou **"Environment Variables"**
3. Procure por **`DATABASE_URL`**
4. **Deve aparecer agora!** (formato: `mysql://user:password@host:port/database`)

### Passo 4: Fazer Redeploy

Após `DATABASE_URL` aparecer:

1. No serviço **web**, clique em **"Deploy"** → **"Redeploy"**
2. Aguarde o deploy terminar
3. A aplicação deve funcionar agora!

## 📋 Checklist

- [ ] MySQL está adicionado ao projeto
- [ ] MySQL está conectado ao serviço web (via Settings → Connected Services)
- [ ] `DATABASE_URL` aparece nas variáveis do serviço web
- [ ] Redeploy foi feito após conectar

## 🎯 Onde Encontrar "Connected Services"

A localização pode variar, mas geralmente está em:

1. **No serviço MySQL:**
   - Clique em **"Settings"**
   - Procure por **"Connected Services"** ou **"Networking"**
   - Ou procure por um botão **"Connect"** ou **"Link"**

2. **Alternativa:**
   - Algumas versões do Railway mostram isso na página principal do serviço
   - Procure por um botão ou link que diz **"Connect to Service"**

## ⚠️ Importante

**O Railway só injeta `DATABASE_URL` quando:**
- ✅ MySQL está no mesmo projeto
- ✅ MySQL está **conectado** ao serviço web

**Se não conectar, `DATABASE_URL` nunca aparecerá!**

## 🔍 Como Saber se Está Conectado

### Método 1: Verificar Variáveis
- Vá para o serviço **web** → **"Variables"**
- Se `DATABASE_URL` aparecer = ✅ Está conectado!

### Método 2: Verificar Settings
- Vá para o serviço **MySQL** → **"Settings"**
- Procure por **"Connected Services"**
- Se o serviço **web** aparecer na lista = ✅ Está conectado!

## 🆘 Se Não Conseguir Conectar

1. **Verifique se ambos estão no mesmo projeto**
   - MySQL e serviço web devem estar no mesmo projeto Railway

2. **Tente desconectar e reconectar**
   - Desconecte o MySQL do serviço web
   - Conecte novamente

3. **Verifique se o MySQL está ativo**
   - O MySQL deve estar rodando (status verde)

4. **Faça um redeploy**
   - Às vezes ajuda fazer um redeploy após conectar

## 💡 Dica

Se você não conseguir encontrar a opção "Connected Services":
- Procure por **"Networking"** ou **"Dependencies"**
- Ou procure por um botão **"Connect"** na página do serviço MySQL
- A interface do Railway pode variar, mas a funcionalidade está lá!

## 🎉 Depois que Conectar

Quando `DATABASE_URL` aparecer:
- ✅ A aplicação poderá conectar no banco
- ✅ As migrações funcionarão
- ✅ Tudo deve funcionar normalmente!

**O problema é simples: MySQL não está conectado ao serviço web. Conecte e tudo funcionará!** 🚀

