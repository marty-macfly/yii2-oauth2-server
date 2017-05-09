FROM php:apache
RUN apt-get update && apt-get install -y --no-install-recommends net-tools && a2enmod rewrite && docker-php-ext-install bcmath && docker-php-ext-install opcache
# Multi-langue
RUN apt-get install -y --no-install-recommends libicu52 libicu-dev && docker-php-ext-install intl && apt-get remove -y libicu-dev
# Session support
RUN pecl install redis && docker-php-ext-enable redis
# DB mysql
RUN docker-php-ext-install pdo_mysql
# Cache
RUN apt-get install -y --no-install-recommends zlib1g libmemcachedutil2 libmemcached11 zlib1g-dev libmemcached-dev && pecl install memcached && docker-php-ext-enable memcached && apt-get remove -y zlib1g-dev libmemcached-dev
# Yaml
RUN apt-get install -y --no-install-recommends libyaml-dev libyaml-0-2 && pecl install yaml-2.0.0 && docker-php-ext-enable yaml && apt-get remove -y libyaml-dev
# Composer
RUN apt-get install -y --no-install-recommends libssl1.0.0 libssl-dev wget git unzip && wget -O composer-setup.php https://getcomposer.org/installer && php composer-setup.php --filename=composer --install-dir=/usr/bin && rm -f composer-setup.php
RUN apt-get autoremove -y
RUN composer global require "fxp/composer-asset-plugin:^1.3.1"
WORKDIR /var/www/html/
COPY files/auth.json /root/.composer/
RUN composer create-project --prefer-dist yiisoft/yii2-app-basic ./
RUN composer require --prefer-dist macfly/yii2-oauth2-server "*" && composer require --prefer-dist flow/jsonpath && composer require --prefer-dist guzzlehttp/guzzle && ./vendor/bin/codecept bootstrap && rm -frv /var/www/html/tests/*
COPY files/php.ini /usr/local/etc/php/
COPY files/db.php /var/www/html/config/
COPY files/web.php /var/www/html/config/
COPY files/Oauth2Users.php /var/www/html/models/
COPY files/tests /var/www/html/tests
COPY files/yii.conf /etc/apache2/sites-available/000-default.conf
RUN chmod 777 /var/www/html/tests/_output
# Check requirements for basic app
RUN php requirements.php
COPY files/start.sh /
COPY files/wait-for-it.sh /
COPY files/run.sh /
RUN chmod +x /*.sh
CMD ["/start.sh"]
