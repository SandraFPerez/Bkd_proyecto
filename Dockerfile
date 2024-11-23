FROM php:7.4-apache

# Instalar dependencias necesarias para la conexión con Oracle
RUN apt-get update && apt-get install -y \
    libaio1 \
    php-pear \
    php-dev \
    make \
    gcc

# Instalar la extensión OCI8 utilizando PECL y habilitarla
RUN pecl install oci8-2.2.0 && docker-php-ext-enable oci8

# Copiar el código fuente del backend (ajusta la ruta según tu proyecto)
COPY . /var/www/html/

# Configurar el puerto y Apache
EXPOSE 80
