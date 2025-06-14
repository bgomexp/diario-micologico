FROM php:8.3-apache

# Instalar dependencias del sistema y PHP
RUN apt-get update && apt-get install -y libsqlite3-dev git && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_sqlite

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir directorio de trabajo
WORKDIR /var/www/html

# Copiar código de la aplicación
COPY . /var/www/html

# Ajustar permisos para carpetas de escritura
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias de Composer en modo producción
RUN composer install --optimize-autoloader --no-dev

# Copiar .env de ejemplo y generar clave de aplicación
RUN cp .env.example .env && php artisan key:generate

# Crear base de datos SQLite vacía y dar permisos
RUN touch database/database.sqlite && \
    chown www-data:www-data database/database.sqlite && \
    chmod 664 database/database.sqlite

# Ejecutar migraciones y seeders forzados
RUN php artisan migrate --force && php artisan db:seed --force

# Copiar configuración personalizada de Apache
COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Configurar ServerName para evitar warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Exponer el puerto HTTP
EXPOSE 80

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]
