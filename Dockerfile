FROM php:8.3-apache

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Configurar el DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html

# Crear directorio de imágenes y dar permisos
RUN mkdir -p /var/www/html/imagenes && \
    chown -R www-data:www-data /var/www/html/imagenes && \
    chmod -R 755 /var/www/html/imagenes


# Exponer puerto 80
EXPOSE 80 