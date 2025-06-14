FROM php:8.3-apache

RUN apt-get update && apt-get install -y libsqlite3-dev

RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install --optimize-autoloader --no-dev

RUN cp .env.example .env

RUN php artisan key:generate

RUN touch database/database.sqlite

RUN php artisan migrate --force && php artisan db:seed --force

EXPOSE 80

CMD ["apache2-foreground"]
