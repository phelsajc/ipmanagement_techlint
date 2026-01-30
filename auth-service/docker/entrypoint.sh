#!/bin/sh
set -e

# Auto-create .env
if [ ! -f .env ]; then
  echo "Creating .env from example..."
  cp .env.example .env
fi

# Wait for DB
if [ -n "$DB_HOST" ]; then
  echo "Waiting for database at $DB_HOST:$DB_PORT..."
  until nc -z "$DB_HOST" "$DB_PORT"; do
    sleep 1
  done
fi

echo "Database ready."

# App key
php artisan key:generate --force || true

# Migrate once
php artisan migrate --force || true

# Cache
php artisan config:clear
php artisan config:cache

exec "$@"
