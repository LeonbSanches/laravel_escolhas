web: php artisan config:clear || true && php artisan migrate --force || true && php artisan config:cache || true && php artisan route:cache || true && php artisan view:cache || true && php artisan serve --host=0.0.0.0 --port=${PORT}
# worker: php artisan queue:work --tries=3
reverb: php artisan reverb:start --host=0.0.0.0 --port=${REVERB_PORT:-8080}
