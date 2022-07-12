FROM dmstr/php-yii2:7.4-fpm-8.0-nginx

ENV TZ=America/Sao_Paulo

RUN apt-get update -y
RUN apt-get upgrade -y
RUN apt-get install -y --no-install-recommends libkrb5-dev unzip


RUN curl -OL https://github.com/composer-unused/composer-unused/releases/download/0.7.12/composer-unused.phar
RUN chmod +x composer-unused.phar
RUN mv composer-unused.phar /usr/local/bin/composer-unused

COPY . /app

WORKDIR /app

RUN echo "memory_limit=1024M" > /usr/local/etc/php/conf.d/memory_limit.ini
RUN echo "date.timezone=America/Sao_Paulo" > /usr/local/etc/php/conf.d/timezone.ini

RUN chmod -R 777 /app/runtime /app/web/assets
RUN chown -R www-data:www-data /app/runtime /app/web/assets

CMD bash -c "composer install --optimize-autoloader --no-dev && php yii migrate --interactive=0 && supervisord -c /etc/supervisor/supervisord.conf"
