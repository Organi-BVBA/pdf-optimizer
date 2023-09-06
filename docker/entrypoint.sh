#!/bin/sh

# Run default entrypoint first
docker-php-entrypoint

if [ ! -e .env ]; then
    cp .env.example .env
fi

# do we have an existing APP_KEY we should reuse ?
if [ -n "$APP_KEY" ]; then
  echo "Setting APP_KEY=$APP_KEY from environment"
  sed -i "s#APP_KEY=.*#APP_KEY=$APP_KEY#" .env
else
  # generate APP_KEY on first run
  if [ ! -e .first_run_done ]; then
    echo "Generating APP_KEY"
    head /dev/urandom | LC_ALL=C tr -dc 'A-Za-z0-9' | head -c 32 | { read KEY; sed -i "s#APP_KEY=.*#APP_KEY=$KEY#" .env; }
    touch .first_run_done
  fi
fi

chgrp -R www-data storage /data
chmod -R ug+rwx storage /data

# Install the required packages
composer install --no-interaction --optimize-autoloader --no-dev

php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan horizon:publish
php artisan optimize

exec "$@"


