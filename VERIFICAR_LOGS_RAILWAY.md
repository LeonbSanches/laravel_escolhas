# 📋 Como Verificar Logs Completos no Railway

## 🔍 Passo a Passo

### 1. Acessar os Logs

1. No Railway, vá para o serviço **web** (sua aplicação)
2. Clique na aba **"Logs"** (geralmente no topo ou no menu lateral)
3. Você verá os logs em tempo real

### 2. Procurar por Erros

Os erros geralmente aparecem em:
- **Vermelho** - Erros críticos
- **Amarelo** - Avisos
- **Branco/Cinza** - Informações normais

### 3. Filtrar Logs

Procure por palavras-chave:
- `SQLSTATE` - Erros de banco de dados
- `Exception` - Exceções do PHP
- `Error` - Erros gerais
- `Connection` - Problemas de conexão
- `Migration` - Problemas com migrações

### 4. Copiar o Erro Completo

Quando encontrar um erro:
1. Clique no erro para expandir
2. Copie toda a mensagem de erro
3. Inclua o "stack trace" (rastreamento completo)

## 📊 Exemplo de Log de Erro

Um erro típico pode parecer assim:

```
Illuminate\Database\QueryException
SQLSTATE[08006] [7] connection to server at "localhost" (::1), port 5432 failed
Connection: pgsql, SQL: select * from "unidades"
```

**Isso mostra:**
- Tipo de erro: `QueryException`
- Problema: Tentando conectar em `localhost:5432` (PostgreSQL)
- Query: `select * from "unidades"`

## 🎯 O Que Procurar

### Se o Erro Mostrar PostgreSQL:
```
Connection: pgsql
port 5432
```
**Problema:** Ainda está usando PostgreSQL
**Solução:** Verificar se `DB_CONNECTION=mysql` está configurado

### Se o Erro Mostrar MySQL:
```
Connection: mysql
port 3306
```
**Problema:** MySQL não está conectado ou `DATABASE_URL` não está disponível
**Solução:** Conectar MySQL ao serviço web

### Se o Erro Mostrar Tabela Não Existe:
```
Table 'database.table' doesn't exist
```
**Problema:** Migrações não foram executadas
**Solução:** Verificar se as migrações rodaram nos logs

## 💡 Dica

Os logs do Railway mostram:
- **Build logs** - Durante o build (composer install, npm build, etc)
- **Deploy logs** - Durante o deploy (migrações, comandos do Procfile)
- **Runtime logs** - Durante a execução (erros em tempo real)

**Verifique todos os três tipos de logs!**

