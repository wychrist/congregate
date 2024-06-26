FROM php:8

ARG GROUPID
ARG USERID
ARG GROUP_NAME
ARG USER_NAME


USER root

RUN groupadd -g ${GROUPID} ${GROUP_NAME} && \
    useradd -u ${USERID} -g ${GROUPID} -m ${USER_NAME}


RUN apt-get update && apt-get -y install curl vim zip git nodejs npm gnupg sendmail libpq-dev
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y  yarn libxml2-dev zlib1g-dev libzip-dev
RUN docker-php-ext-install pdo_mysql mysqli soap xml zip intl opcache pdo_pgsql

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install redis \
    && pecl install mongodb \
    && docker-php-ext-enable redis mongodb

RUN echo 'memory_limit = 2G' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
RUN echo 'upload_max_filesize = 2G' >> /usr/local/etc/php/conf.d/docker-php-upload-size.ini
RUN echo 'post_max_size = 2G' >> /usr/local/etc/php/conf.d/docker-php-post-size.ini
RUN echo 'sendmail_path = /usr/sbin/sendmail -S mail:1025' >> /usr/local/etc/php/conf.d/docker-hogmail.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN cp composer.phar /usr/bin/composer
RUN chmod a+x /usr/bin/composer
RUN composer self-update

RUN apt-get install -y supervisor

ADD config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ADD test.sh /test.sh
RUN chmod +x /test.sh

CMD ["/usr/bin/supervisord"]
