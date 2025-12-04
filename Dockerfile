FROM php:8.3-apache

# 1. Actualizar e instalar dependencias del SISTEMA (Linux)
# GD necesita estas librerías para entender qué es un JPEG, un PNG, etc.
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Configurar el DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configurar permisos
# Nota: Es mejor hacer esto al final o en un entrypoint si el volumen se monta después, 
# pero para desarrollo esto suele funcionar.
RUN chown -R www-data:www-data /var/www/html

# Crear directorio de imágenes y dar permisos
RUN mkdir -p /var/www/html/imagenes && \
    chown -R www-data:www-data /var/www/html/imagenes && \
    chmod -R 755 /var/www/html/imagenes

# Exponer puerto 80
EXPOSE 80