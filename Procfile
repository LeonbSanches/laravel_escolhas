web: php artisan config:clear && (test -n "$DATABASE_URL" || (echo "AVISO: DATABASE_URL não disponível, aguardando..." && sleep 5)) && php artisan migrate --force || true && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=$PORT
# worker: php artisan queue:work --tries=3
reverb: php artisan reverb:start --host=0.0.0.0 --port=${REVERB_PORT:-8080}
