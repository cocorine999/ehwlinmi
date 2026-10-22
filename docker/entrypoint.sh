#!/usr/bin/env bash
set -e

cd /var/www/html

echo "[entrypoint] Génération de l'APP_KEY si absente..."
if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
    php artisan key:generate --force
fi

echo "[entrypoint] Attente de la base de données..."
tries=0
until php -r '
$host = getenv("DB_HOST") ?: "127.0.0.1";
$port = getenv("DB_PORT") ?: "3306";
$db   = getenv("DB_DATABASE") ?: "ehwlinmi";
$user = getenv("DB_USERNAME") ?: "root";
$pass = getenv("DB_PASSWORD") ?: "";
try {
    new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, [PDO::ATTR_TIMEOUT => 3]);
    exit(0);
} catch (Exception $e) {
    exit(1);
}' 2>/dev/null; do
    tries=$((tries + 1))
    if [ "$tries" -ge 60 ]; then
        echo "[entrypoint] ERREUR: base de données injoignable après 120s"
        exit 1
    fi
    sleep 2
done
echo "[entrypoint] Base de données disponible."

if [ ! -f storage/oauth-private.key ] || [ ! -f storage/oauth-public.key ]; then
    echo "[entrypoint] Génération des clés Passport..."
    php artisan passport:keys --force || true
fi

php artisan config:cache || true
php artisan route:cache || true

chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

echo "[entrypoint] Démarrage de: $*"
exec "$@"
