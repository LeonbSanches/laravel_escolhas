# Configuração do Banco PostgreSQL

## Situação Atual

O `.env` foi configurado com as credenciais do Railway, mas há duas opções:

### Opção 1: Conectar ao Banco do Railway Remotamente

Se você quer conectar ao banco do Railway diretamente do seu ambiente local, você precisa do `DATABASE_PUBLIC_URL` completo.

**Passos:**
1. No Railway, vá ao serviço PostgreSQL
2. Copie o valor real de `DATABASE_PUBLIC_URL` (não as referências `${{...}}`)
3. Adicione ao `.env`:

```env
DATABASE_URL=postgresql://postgres:SENHA@HOST:PORTA/railway
```

**Exemplo:**
```env
DATABASE_URL=postgresql://postgres:hRNqCoSFSaFOODgdFyRkTbzCKILFwkqv@centerbeam.proxy.rlwy.net:38646/railway
```

### Opção 2: Usar Banco PostgreSQL Local

Se você quer usar um banco local com as mesmas credenciais:

1. **Crie o banco localmente:**
   ```sql
   CREATE DATABASE railway;
   ```

2. **Configure o usuário postgres com a senha:**
   ```sql
   ALTER USER postgres WITH PASSWORD 'hRNqCoSFSaFOODgdFyRkTbzCKILFwkqv';
   ```

3. **Ou use suas credenciais locais existentes** e atualize o `.env`:
   ```env
   DB_DATABASE=seu_banco_local
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

## Rodar os Seeders

Após configurar o banco, execute:

```bash
php artisan config:clear
php artisan db:seed --force
```

## Verificar Conexão

Teste a conexão:

```bash
php artisan tinker
```

No tinker:
```php
DB::connection()->getPdo();
```

Se retornar um objeto PDO, a conexão está funcionando!

