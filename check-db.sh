#!/bin/bash
# Verifica se DATABASE_URL está disponível
if [ -z "$DATABASE_URL" ]; then
    echo "ERRO: DATABASE_URL não está disponível!"
    echo "Verifique se o PostgreSQL está conectado ao serviço web no Railway."
    exit 1
fi
echo "DATABASE_URL está disponível: ${DATABASE_URL:0:20}..."
exit 0

