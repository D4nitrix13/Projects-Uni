#!/bin/bash
set -e

# Si no existe vendor, correr composer install
if [ ! -f /var/www/html/vendor/autoload.php ]; then
  echo ">>> vendor/ no existe, corriendo composer install..."
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Arrancar cron y apache
service cron start
exec apache2-foreground
