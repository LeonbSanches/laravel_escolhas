# Variáveis de Ambiente - Railway

## ⚠️ CORREÇÃO NECESSÁRIA

Você já tem `APP_KEY` configurado, mas o valor está como um comando. Precisa corrigir:

### 1. Edite o APP_KEY existente:
- Clique nos três pontos `⋮` ao lado de `APP_KEY`
- Selecione "Edit" ou clique no valor
- Substitua `php artisan key:generate --show` por:
  ```
  base64:OFxQhiHEGUyPsGOfmmuOQR7xg63SSOkrqc8MFsWJb1I=
  ```

## ➕ ADICIONAR NOVAS VARIÁVEIS

Use os campos "VARIABLE_NAME" e "VALUE" para adicionar cada uma:

### Variável 1:
- **VARIABLE_NAME:** `APP_ENV`
- **VALUE:** `production`

### Variável 2:
- **VARIABLE_NAME:** `APP_DEBUG`
- **VALUE:** `false`

### Variável 3:
- **VARIABLE_NAME:** `APP_URL`
- **VALUE:** `https://escolhas-cba.up.railway.app`
- *(Ou deixe vazio se usar RAILWAY_PUBLIC_DOMAIN)*

### Variável 4:
- **VARIABLE_NAME:** `LOG_LEVEL`
- **VALUE:** `error`

### Variável 5:
- **VARIABLE_NAME:** `REVERB_APP_ID`
- **VALUE:** `railway-app`

### Variável 6:
- **VARIABLE_NAME:** `REVERB_APP_KEY`
- **VALUE:** `railway-key`

### Variável 7:
- **VARIABLE_NAME:** `REVERB_APP_SECRET`
- **VALUE:** `railway-secret`

### Variável 8:
- **VARIABLE_NAME:** `REVERB_SCHEME`
- **VALUE:** `https`

## ✅ Após adicionar cada variável:
- Clique no botão roxo **"Add"** (com o ícone de checkmark ✓)

## 📝 Resumo Final

Você deve ter no total **9 variáveis** no ambiente "production":

1. ✅ `APP_KEY` (corrigir o valor)
2. ➕ `APP_ENV` = `production`
3. ➕ `APP_DEBUG` = `false`
4. ➕ `APP_URL` = `https://escolhas-cba.up.railway.app`
5. ➕ `LOG_LEVEL` = `error`
6. ➕ `REVERB_APP_ID` = `railway-app`
7. ➕ `REVERB_APP_KEY` = `railway-key`
8. ➕ `REVERB_APP_SECRET` = `railway-secret`
9. ➕ `REVERB_SCHEME` = `https`

## 🔄 Variáveis Automáticas (não precisa adicionar)

Estas serão injetadas automaticamente pelo Railway:
- `DATABASE_URL` (quando adicionar PostgreSQL)
- `REDIS_URL` (quando adicionar Redis)
- `RAILWAY_PUBLIC_DOMAIN` (sempre disponível)

