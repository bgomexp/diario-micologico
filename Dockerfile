# Imagen base PHP + Apache
FROM php:8.3-apache

# Instalar dependencias del sistema y PHP
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    git \
    unzip \
    nodejs \
    npm && \
    rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_sqlite

# Habilitar mod_rewrite y definir ServerName
RUN a2enmod rewrite && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copiar config personalizada de Apache
COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilitar el sitio (aunque sea default, para refrescar config)
RUN a2ensite 000-default.conf

# Copiar Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir directorio de trabajo
WORKDIR /var/www/html

# Copiar todo el proyecto
COPY . /var/www/html

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias PHP
RUN composer install --optimize-autoloader --no-dev

# Instalar dependencias JS y compilar frontend
RUN npm install && npm run build

# Crear y dar permisos a la base SQLite
RUN touch database/database.sqlite && \
    chown www-data:www-data database/database.sqlite && \
    chmod 664 database/database.sqlite

# Copiar .env y generar key
RUN cp .env.example .env && php artisan key:generate

# Ejecutar migraciones y seeders
RUN php artisan migrate --force && php artisan db:seed --force

# Confirmar contenido de public
RUN ls -la /var/www/html/public

# Exponer puerto HTTP
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
