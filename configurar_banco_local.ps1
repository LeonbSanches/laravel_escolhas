# Script para configurar banco PostgreSQL local
# Execute este script se quiser usar um banco local com as credenciais do Railway

Write-Host "Configurando banco PostgreSQL local..." -ForegroundColor Yellow

# Verifica se o PostgreSQL está instalado
$pgPath = Get-Command psql -ErrorAction SilentlyContinue
if (-not $pgPath) {
    Write-Host "PostgreSQL não encontrado no PATH. Por favor, instale o PostgreSQL ou adicione ao PATH." -ForegroundColor Red
    Write-Host "Ou use o DATABASE_URL completo do Railway para conectar remotamente." -ForegroundColor Yellow
    exit 1
}

# Credenciais
$dbName = "railway"
$dbUser = "postgres"
$dbPassword = "hRNqCoSFSaFOODgdFyRkTbzCKILFwkqv"

Write-Host "Criando banco de dados '$dbName'..." -ForegroundColor Cyan

# Cria o banco (assumindo que você tem acesso ao postgres)
$env:PGPASSWORD = $dbPassword
psql -U $dbUser -d postgres -c "CREATE DATABASE $dbName;" 2>&1 | Out-Null

if ($LASTEXITCODE -eq 0) {
    Write-Host "Banco '$dbName' criado com sucesso!" -ForegroundColor Green
} else {
    Write-Host "Banco pode já existir ou houve erro na criação. Continuando..." -ForegroundColor Yellow
}

Write-Host "`nConfiguração concluída!" -ForegroundColor Green
Write-Host "Agora você pode rodar: php artisan db:seed --force" -ForegroundColor Cyan

