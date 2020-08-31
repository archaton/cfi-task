FROM composer:1.9 AS composer

FROM php:7.4-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN touch /etc/apt/apt.conf.d/99fixbadproxy \
    && echo "Acquire::http::Pipeline-Depth 0;" >> /etc/apt/apt.conf.d/99fixbadproxy \
    && echo "Acquire::http::No-Cache true;" >> /etc/apt/apt.conf.d/99fixbadproxy \
    && echo "Acquire::BrokenProxy true;" >> /etc/apt/apt.conf.d/99fixbadproxy \
    && apt-get update -o Acquire::CompressionTypes::Order::=gz \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get update -y && apt-get install -y git unzip zip && \
    docker-php-ext-configure json && \
    docker-php-ext-install json

RUN composer global require hirak/prestissimo --no-plugins --no-scripts

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN composer --version && php -v

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN sed -i 's|;access.log = .*|access.log = /proc/self/fd/2 |g' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's|;php_admin_value[error_log] = .*|php_admin_value[error_log] = /proc/self/fd/2|g' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i "s|;catch_workers_output = .*|catch_workers_output = yes|i" /usr/local/etc/php-fpm.d/www.conf && \
   sed -i "s|;error_log = .*|error_log = /proc/self/fd/2|i" /usr/local/etc/php-fpm.conf && \
   sed -i "s|;clear_env = .*|clear_env = no|i" /usr/local/etc/php-fpm.d/www.conf && \
   sed -i "s|;pm.max_children = .*|pm.max_children = 15|i" /usr/local/etc/php-fpm.d/www.conf && \
    sed -i "s|;error_log = .*|error_log = /var/log/php7/error.log|i" /usr/local/etc/php/php.ini && \
   sed -i "s|;*upload_max_filesize =.*|upload_max_filesize = 50M|i" /usr/local/etc/php/php.ini && \
    sed -i "s|;*max_file_uploads =.*|max_file_uploads = 200|i" /usr/local/etc/php/php.ini && \
    sed -i "s|;*post_max_size =.*|post_max_size = 100M|i" /usr/local/etc/php/php.ini && \
    sed -i "s|;*cgi.fix_pathinfo=.*|cgi.fix_pathinfo= 0|i" /usr/local/etc/php/php.ini && \
   sed -i "s|;*date.timezone =.*|date.timezone = Europe/Warsaw|i" /usr/local/etc/php/php.ini && \
    sed -i "s|;*expose_php.*|expose_php = Off|i" /usr/local/etc/php/php.ini && \
   sed -i 's|memory_limit = .*|memory_limit = 256M|g' /usr/local/etc/php/php.ini && \
    echo "clear_env = no" >> /usr/local/etc/php-fpm.d/www.conf

WORKDIR /srv/app/
RUN chown -R www-data:www-data /srv/app
