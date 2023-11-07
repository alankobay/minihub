FROM phpdockerio/php:8.2-fpm

ARG WORKDIR
WORKDIR $WORKDIR

# Install PHP and dependencies
RUN apt-get update; \
    apt-get -y --no-install-recommends install \
    git \
    php8.2-cli  \
    php8.2-dev \
    php8.2-fpm \
    php8.2-bcmath \
    php8.2-curl \
    php8.2-gd \
    php8.2-imap \
    php8.2-intl \
    php8.2-igbinary \
    php8.2-ldap \
    php8.2-mysql \
    php8.2-mbstring \
    php8.2-msgpack \
    php8.2-memcached \
    php8.2-pcov \
    php8.2-redis \
    php8.2-soap \
    php8.2-xml \
    php8.2-xdebug \
    php8.2-zip
COPY ./xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# Clean instalation files
RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
