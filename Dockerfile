FROM node:20 AS frontend

WORKDIR /app

# Copiamos package.json y package-lock.json primero
COPY package*.json vite.config.js ./

# Compilar assets
RUN npm install && npm run build && \
    chown -R www-data:www-data /var/www/html/public/build
    
FROM php:8.3-apache

RUN apt-get update && apt-get install -y libsqlite3-dev git unzip libpng-dev libonig-dev libzip-dev && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_sqlite

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html

# Ajustamos permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install --optimize-autoloader --no-dev

# Copiamos el frontend ya compilado
COPY --from=frontend /app/public/build /var/www/html/public/build

# Configuramos .env y base de datos
RUN cp .env.example .env && php artisan key:generate

RUN touch database/database.sqlite && \
    chown www-data:www-data database/database.sqlite && \
    chmod 664 database/database.sqlite

RUN php artisan migrate --force && php artisan db:seed --force

COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]
