# Imagen base de PHP con Apache
FROM php:8.3-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    git && \
    rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo pdo_sqlite

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir directorio de trabajo
WORKDIR /var/www/html

# Copiar el código completo de la aplicación
COPY . /var/www/html

# Ajustar permisos para carpetas de escritura
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias de Composer en modo producción
RUN composer install --optimize-autoloader --no-dev

# Copiar configuración personalizada de Apache (si tienes)
# COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Configurar ServerName para evitar warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copiar base de datos SQLite vacía y asignar permisos
RUN touch database/database.sqlite && \
    chown www-data:www-data database/database.sqlite && \
    chmod 664 database/database.sqlite

# Generar clave de aplicación y migrar base de datos
RUN cp .env.example .env && php artisan key:generate && \
    php artisan migrate --force && php artisan db:seed --force

# Exponer puerto HTTP
EXPOSE 80

# Comando de arranque
CMD ["apache2-foreground"]
