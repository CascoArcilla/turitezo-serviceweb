FROM php:8.2-apache
RUN a2enmod rewrite
# Configuramos Apache para prevebur DoS básico
# Limitar el tiempo de espera de peticiones y el tamaño de los cuerpos
RUN { \
      echo "ServerTokens Prod"; \
      echo "ServerSignature Off"; \
      echo "TraceEnable Off"; \
      echo "KeepAliveTimeout 5"; \
      echo "RequestReadTimeout header=20-40,MinRate=500 body=20,MinRate=500"; \
    } >> /etc/apache2/apache2.conf

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

## Old Conf for Huggieface
# FROM debian:12.6
# EXPOSE 7860
# RUN apt update -y
# RUN apt upgrade -y
# RUN apt install -y php php8.2-mysql
# RUN rm -rf /var/lib/apt/lists/*
# COPY . /
# WORKDIR /public
# CMD ["bash","-c","php -S 0.0.0.0:7860"]