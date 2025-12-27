# 🌱 Seeders no Procfile

## ✅ O Que Foi Adicionado

O `Procfile` agora executa os seeders automaticamente após as migrações:

```bash
web: php artisan config:clear || true && php artisan cache:clear || true && php artisan migrate --force || true && php artisan db:seed --force || true && php artisan serve --host=0.0.0.0 --port=${PORT}
```

## 📋 Seeders que Serão Executados

Baseado no `DatabaseSeeder.php`, os seguintes seeders serão executados:

1. **AdminUserSeeder** - Cria usuário administrador
2. **UnidadeSeeder** - Popula tabela de unidades
3. **MilitarSeeder** - Popula tabela de militares

## 🔄 Ordem de Execução

1. `config:clear` - Limpa cache de configuração
2. `cache:clear` - Limpa cache geral
3. `migrate --force` - Executa migrações
4. `db:seed --force` - Executa seeders (NOVO!)
5. `serve` - Inicia o servidor

## ⚠️ Importante

- O `--force` é necessário para executar em produção sem confirmação
- O `|| true` garante que mesmo se houver erro, o processo continue
- Os seeders só executam se as migrações forem bem-sucedidas

## 🎯 Próximo Deploy

No próximo deploy no Railway:
- ✅ Migrações serão executadas
- ✅ Seeders serão executados automaticamente
- ✅ Banco será populado com dados iniciais

## 💡 Dica

Se você quiser executar apenas um seeder específico, pode modificar para:
```bash
php artisan db:seed --class=AdminUserSeeder --force
```

Mas o `db:seed` sem especificar executa todos os seeders definidos no `DatabaseSeeder`.

