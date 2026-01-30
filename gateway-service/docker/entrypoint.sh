#!/bin/sh
set -e

if [ ! -f .env ]; then
  echo "Creating .env from example..."
  cp .env.example .env
fi

php artisan key:generate --force || true
php artisan config:clear
php artisan config:cache

exec "$@"
