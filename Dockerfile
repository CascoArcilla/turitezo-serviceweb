FROM php:8.4-apache

# Instalamos la extensión mysqli
RUN docker-php-ext-install mysqli

# Habilitamos módulo rewrite de Apache
RUN a2enmod rewrite

# Configuración de seguridad para Apache
RUN { \
      echo "ServerTokens Prod"; \
      echo "ServerSignature Off"; \
      echo "TraceEnable Off"; \
      echo "KeepAliveTimeout 5"; \
      echo "RequestReadTimeout header=20-40,MinRate=500 body=20,MinRate=500"; \
    } >> /etc/apache2/apache2.conf

# Configuración de producción php
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Configuración de errores php (Logs)
RUN { \
      echo 'display_errors = Off'; \
      echo 'log_errors = On'; \
      echo 'error_log = /dev/stderr'; \
    } > "$PHP_INI_DIR/conf.d/error-logging.ini"

# Configuración de seguridad para php (descomentar si es necesario)
# RUN sed -i 's/max_execution_time = 30/max_execution_time = 60/g' "$PHP_INI_DIR/php.ini" && \
#     sed -i 's/max_input_time = 60/max_input_time = 120/g' "$PHP_INI_DIR/php.ini" && \
#     sed -i 's/memory_limit = 128M/memory_limit = 256M/g' "$PHP_INI_DIR/php.ini" && \
#     sed -i 's/post_max_size = 8M/post_max_size = 16M/g' "$PHP_INI_DIR/php.ini" && \
#     sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 4M/g' "$PHP_INI_DIR/php.ini"

COPY . /var/www/html/

# Permisos de los archivos, una vez copiados
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80