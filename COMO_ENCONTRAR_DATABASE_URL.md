# 🔍 Como Encontrar a URL do Banco de Dados no Railway

## 📋 Método 1: Via Variáveis de Ambiente (Recomendado)

### Para o Serviço Web (Aplicação)

1. No Railway, vá para o serviço **web** (sua aplicação Laravel)
2. Clique em **"Variables"** ou **"Environment Variables"**
3. Procure por **`DATABASE_URL`**
4. **Se aparecer** = ✅ Está conectado e a URL está disponível!

**Formato da URL:**
- **MySQL:** `mysql://user:password@host:port/database`
- **PostgreSQL:** `postgresql://user:password@host:port/database`

### Para o Serviço do Banco de Dados

1. No Railway, vá para o serviço **MySQL** ou **PostgreSQL**
2. Clique em **"Variables"** ou **"Environment Variables"**
3. Procure por **`DATABASE_URL`** ou **`MYSQL_URL`** / **`POSTGRES_URL`**
4. A URL completa estará lá!

## 📋 Método 2: Via Settings do Banco de Dados

### Para MySQL

1. No Railway, vá para o serviço **MySQL**
2. Clique em **"Settings"** ou **"Data"**
3. Procure por:
   - **"Connection URL"**
   - **"Database URL"**
   - **"Public URL"**
4. A URL estará exibida lá

### Para PostgreSQL

1. No Railway, vá para o serviço **PostgreSQL**
2. Clique em **"Settings"** ou **"Data"**
3. Procure por:
   - **"Connection URL"**
   - **"Database URL"**
   - **"Public URL"**
4. A URL estará exibida lá

## 📋 Método 3: Via Connect/Networking

1. No Railway, vá para o serviço do banco de dados (MySQL ou PostgreSQL)
2. Clique em **"Settings"**
3. Procure por **"Connect"**, **"Networking"** ou **"Public Networking"**
4. Lá você verá:
   - **Host:** O endereço do servidor
   - **Port:** A porta (3306 para MySQL, 5432 para PostgreSQL)
   - **Database:** Nome do banco
   - **User:** Usuário
   - **Password:** Senha (geralmente oculta)

**Com essas informações, você pode montar a URL:**
```
mysql://user:password@host:port/database
```

## 🔐 Informações que Você Precisa

A URL do banco de dados geralmente contém:

- **Protocolo:** `mysql://` ou `postgresql://`
- **Usuário:** Nome do usuário do banco
- **Senha:** Senha do banco
- **Host:** Endereço do servidor (ex: `containers-us-west-xxx.railway.app`)
- **Porta:** Porta do banco (3306 para MySQL, 5432 para PostgreSQL)
- **Database:** Nome do banco de dados

## ⚠️ IMPORTANTE

### URL Pública vs URL Interna

- **URL Interna:** Usada quando o banco está conectado ao serviço web (via `DATABASE_URL`)
- **URL Pública:** Usada para conectar de fora do Railway (ferramentas externas, etc)

**Para sua aplicação Laravel, você NÃO precisa da URL pública!**

O Railway injeta automaticamente a `DATABASE_URL` quando:
1. ✅ O banco está adicionado ao projeto
2. ✅ O banco está **conectado** ao serviço web

## 🔍 Verificar se DATABASE_URL Está Disponível

### No Serviço Web:

1. Vá para o serviço **web**
2. Clique em **"Variables"**
3. Procure por `DATABASE_URL`

**Se aparecer:**
- ✅ Está tudo certo! A aplicação pode usar o banco

**Se NÃO aparecer:**
- ❌ O banco não está conectado ao serviço web
- 🔧 Solução: Conecte o banco ao serviço web (Settings → Connected Services)

## 📝 Exemplo de URL

### MySQL:
```
mysql://railway:senha123@containers-us-west-123.railway.app:3306/railway
```

### PostgreSQL:
```
postgresql://postgres:senha123@containers-us-west-123.railway.app:5432/railway
```

## 🎯 Resumo

**Para sua aplicação Laravel:**
- ✅ Use `DATABASE_URL` que o Railway injeta automaticamente
- ✅ Não precisa configurar manualmente
- ✅ Só precisa conectar o banco ao serviço web

**Para ferramentas externas:**
- 🔍 Encontre a URL nas Settings do banco
- 🔐 Use as credenciais fornecidas
- ⚠️ Certifique-se de que "Public Networking" está habilitado

## 💡 Dica

Se você não conseguir encontrar a URL:
1. Verifique se o banco está no mesmo projeto
2. Verifique se o banco está conectado ao serviço web
3. Faça um redeploy após conectar
4. A `DATABASE_URL` deve aparecer automaticamente nas variáveis do serviço web

