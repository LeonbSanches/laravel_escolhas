# Como Permitir Acesso Externo à Aplicação

## Passo 1: Configurar o Servidor Laravel

Por padrão, o Laravel só aceita conexões de `localhost`. Para permitir acesso externo:

### Opção A: Usando `php artisan serve` (Desenvolvimento)

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Isso permite que o servidor aceite conexões de qualquer IP na porta 8000.

### Opção B: Usando um servidor web (Produção)

Se estiver usando Apache/Nginx, configure para aceitar conexões externas.

## Passo 2: Configurar o Reverb para Acesso Externo

O Reverb também precisa aceitar conexões externas:

1. Edite o arquivo `config/reverb.php` ou configure via `.env`:

```env
REVERB_SERVER_HOST=0.0.0.0
REVERB_SERVER_PORT=8080
REVERB_HOST=SEU_IP_LOCAL_OU_PUBLICO
REVERB_PORT=8080
```

2. Inicie o Reverb:

```bash
php artisan reverb:start
```

## Passo 3: Descobrir seu IP

### IP Local (mesma rede):
```bash
# Windows
ipconfig

# Procure por "IPv4 Address" - algo como 192.168.1.100
```

### IP Público (internet):
- Acesse: https://whatismyipaddress.com/
- Ou use: `curl ifconfig.me` no terminal

## Passo 4: Configurar Firewall

### Windows Firewall:

1. Abra "Firewall do Windows Defender"
2. Clique em "Configurações Avançadas"
3. Clique em "Regras de Entrada" → "Nova Regra"
4. Selecione "Porta" → Próximo
5. Selecione "TCP" e digite as portas: `8000, 8080`
6. Permita a conexão
7. Aplique para todos os perfis
8. Dê um nome (ex: "Laravel App")

### Router/Modem:

Se estiver atrás de um roteador, configure port forwarding:
- Porta 8000 → IP da sua máquina (porta 8000)
- Porta 8080 → IP da sua máquina (porta 8080)

## Passo 5: Atualizar Configurações da Aplicação

### Para acesso na mesma rede (LAN):

1. Descubra seu IP local (ex: 192.168.1.100)
2. Inicie o servidor Laravel:
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```
3. Inicie o Reverb:
   ```bash
   php artisan reverb:start
   ```
4. Outras pessoas acessam: `http://192.168.1.100:8000`

### Para acesso via Internet:

1. Descubra seu IP público
2. Configure port forwarding no roteador
3. Inicie os servidores como acima
4. Outras pessoas acessam: `http://SEU_IP_PUBLICO:8000`

## Passo 6: Atualizar Configuração do Reverb no .env

Se o IP mudar ou for diferente, atualize:

```env
REVERB_HOST=SEU_IP_LOCAL_OU_PUBLICO
REVERB_PORT=8080
```

E atualize também no `DashboardController` para passar o IP correto para o frontend.

## Importante - Segurança

⚠️ **ATENÇÃO**: Expor sua aplicação na internet pode ser um risco de segurança!

- Use apenas em redes confiáveis
- Considere usar HTTPS em produção
- Configure autenticação adequada
- Não exponha em produção sem proteções adequadas

## Testando

1. De outra máquina na mesma rede, acesse: `http://SEU_IP:8000`
2. Verifique se o WebSocket conecta (verifique o console do navegador)
3. Se não conectar, verifique:
   - Firewall está permitindo as portas?
   - IP está correto?
   - Reverb está rodando?

