FROM php:7.4-apache

# Instalar dependencias necesarias para la conexión con Oracle
RUN apt-get update && apt-get install -y libaio1
RUN pecl install oci8 && docker-php-ext-enable oci8

# Copiar el código fuente del backend (ajusta la ruta según tu proyecto)
COPY . /backend/server.js

# Configurar el puerto y Apache
EXPOSE 80
