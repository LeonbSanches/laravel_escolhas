# Como Iniciar o Laravel Reverb

## Passo a Passo

1. **Configure o .env** (já foi feito automaticamente):
   ```env
   BROADCAST_CONNECTION=reverb
   REVERB_APP_ID=local
   REVERB_APP_KEY=local
   REVERB_APP_SECRET=local
   REVERB_HOST=localhost
   REVERB_PORT=8080
   REVERB_SCHEME=http
   ```

2. **Inicie o servidor Reverb** em um terminal separado:
   ```bash
   php artisan reverb:start
   ```

3. **Inicie o servidor Laravel** em outro terminal:
   ```bash
   php artisan serve
   ```

4. **Acesse a aplicação**:
   - Dashboard: http://localhost:8000
   - Servidor Reverb: rodando na porta 8080

## Importante

- O servidor Reverb precisa estar rodando **enquanto** você usa a aplicação
- Mantenha o terminal do Reverb aberto
- Se o Reverb não estiver rodando, o dashboard ainda funcionará, mas sem atualizações em tempo real

## Testando

1. Abra o dashboard em uma aba: http://localhost:8000
2. Em outra aba, faça login e acesse o painel do operador
3. Registre uma nova escolha
4. O dashboard deve atualizar automaticamente sem recarregar a página!

## Solução de Problemas

Se o WebSocket não conectar:
- Verifique se o Reverb está rodando: `php artisan reverb:start`
- Verifique se a porta 8080 está livre
- Verifique o console do navegador para erros
- Certifique-se de que `BROADCAST_CONNECTION=reverb` está no .env

