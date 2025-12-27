# 🖥️ Configurar Ambiente Local com PostgreSQL

## 📋 Pré-requisitos

1. **PostgreSQL instalado** no seu computador
2. **PHP 8.2+** instalado
3. **Composer** instalado
4. **Node.js e npm** instalados

## 🔧 Passo a Passo

### Passo 1: Instalar PostgreSQL (Se Não Tiver)

#### Windows:
1. Baixe o PostgreSQL: https://www.postgresql.org/download/windows/
2. Instale seguindo o assistente
3. Anote a senha do usuário `postgres` que você configurou

#### Linux (Ubuntu/Debian):
```bash
sudo apt update
sudo apt install postgresql postgresql-contrib
```

#### macOS:
```bash
brew install postgresql
brew services start postgresql
```

### Passo 2: Criar Banco de Dados

1. Abra o terminal/linha de comando
2. Acesse o PostgreSQL:

**Windows:**
```bash
psql -U postgres
```

**Linux/macOS:**
```bash
sudo -u postgres psql
```

3. Crie o banco de dados:
```sql
CREATE DATABASE laravel;
\q
```

### Passo 3: Configurar .env

1. Copie o arquivo `.env.example` para `.env`:
```bash
cp .env.example .env
```

2. Edite o arquivo `.env` e configure:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Banco de Dados - PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=sua_senha_aqui

# Cache e Sessão
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Reverb (WebSocket)
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=local
REVERB_APP_KEY=local-key
REVERB_APP_SECRET=local-secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http

# Vite
VITE_APP_NAME="${APP_NAME}"
VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

**⚠️ IMPORTANTE:** Substitua `sua_senha_aqui` pela senha do PostgreSQL que você configurou!

### Passo 4: Instalar Dependências

```bash
composer install
npm install
```

### Passo 5: Gerar APP_KEY

```bash
php artisan key:generate
```

### Passo 6: Executar Migrações

```bash
php artisan migrate
```

### Passo 7: Iniciar o Servidor

Em um terminal:
```bash
php artisan serve
```

Em outro terminal (para Reverb):
```bash
php artisan reverb:start
```

Em outro terminal (para Vite):
```bash
npm run dev
```

## 🎯 Acessar a Aplicação

Abra no navegador:
- **Aplicação:** http://localhost:8000
- **Reverb:** ws://localhost:8080

## 📋 Checklist

- [ ] PostgreSQL instalado e rodando
- [ ] Banco de dados `laravel` criado
- [ ] Arquivo `.env` configurado
- [ ] `APP_KEY` gerado
- [ ] Dependências instaladas (`composer install` e `npm install`)
- [ ] Migrações executadas (`php artisan migrate`)
- [ ] Servidor iniciado (`php artisan serve`)

## 🔍 Verificar Conexão com PostgreSQL

Para testar se a conexão está funcionando:

```bash
php artisan tinker
```

No tinker:
```php
DB::connection()->getPdo();
```

Se retornar informações do PDO, a conexão está funcionando! ✅

## 🆘 Troubleshooting

### Erro: "Connection refused"
- Verifique se o PostgreSQL está rodando
- Verifique se a porta 5432 está correta
- Verifique se o usuário e senha estão corretos no `.env`

### Erro: "Database does not exist"
- Crie o banco de dados: `CREATE DATABASE laravel;`

### Erro: "Password authentication failed"
- Verifique a senha no `.env`
- Verifique se o usuário `postgres` existe

## 💡 Dica

A aplicação está configurada para:
- **Local:** Usar PostgreSQL (quando `DB_CONNECTION=pgsql` e `DB_HOST=127.0.0.1`)
- **Railway:** Usar MySQL (quando `MYSQL_URL` ou variáveis `MYSQL_*` estiverem disponíveis)
- **Fallback:** Usar SQLite (se nenhum banco estiver configurado)

**A detecção é automática!** 🚀

