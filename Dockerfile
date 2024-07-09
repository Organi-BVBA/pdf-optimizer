# Build frontend assets
FROM node:16 as frontend

RUN mkdir -p /app/public /public/ /public/css/

COPY package.json yarn.lock tailwind.config.js vite.config.js postcss.config.js /app/

COPY resources/ /app/resources/

WORKDIR /app

RUN npx browserslist@latest --update-db

RUN yarn install && yarn build

# Start actual container
FROM php:8.1.3-apache

RUN apt-get update && apt-get install -y \
    supervisor \
    git \
    curl \
    zip \
    unzip \
    cron \
    ghostscript \
    exiftool \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install redis-5.3.7 \
    && docker-php-ext-install pdo pdo_mysql exif pcntl \
    && docker-php-ext-enable redis

RUN docker-php-ext-install pdo pdo_mysql

# Change the document root to /var/www/html/public
RUN sed -i -e "s/html/html\/public/g" /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Set the working directory
WORKDIR /var/www/html

# Copy source files
COPY . .

# Copy build assets
COPY --from=frontend /app/public/build/ /var/www/html/public/build/

# Make sure the scheduler works
RUN echo "* * * * * root php /var/www/html/artisan schedule:run >> /var/log/cron.log 2>&1" >> /etc/crontab

# Set up the entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod u+x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]

RUN mkdir -p /var/log/supervisor

COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 80
EXPOSE 80

CMD ["/usr/bin/supervisord"]
