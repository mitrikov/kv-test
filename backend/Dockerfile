#FROM composer:2.0 as composer-image
#COPY . /usr/local/bin
#RUN chmod +x /usr/bin/composer
#ENV COMPOSER_ALLOW_SUPERUSER 1

FROM php:8-fpm
ENV APP_HOME /var/www/backend
ENV USERNAME=www-data
ARG HOST_UID=1000
ARG HOST_GID=1000


# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
   libpq-dev \
   libzip-dev \
   libonig-dev \
   locales \
   jpegoptim optipng pngquant gifsicle \
   unzip \
   libmcrypt-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install mysqli zip pdo pdo_mysql \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
#    && docker-php-ext-configure intl


# create document root, fix permissions for www-data user and change owner to www-data
RUN mkdir -p $APP_HOME/public && \
    mkdir -p /home/$USERNAME && chown $USERNAME:$USERNAME /home/$USERNAME \
    && usermod -o -u $HOST_UID $USERNAME -d /home/$USERNAME \
    && groupmod -o -g $HOST_GID $USERNAME \
    && chown -R ${USERNAME}:${USERNAME} $APP_HOME


# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# set working directory
WORKDIR $APP_HOME

# Change current user
USER ${USERNAME}

# copy source files and config file
COPY --chown=${USERNAME}:${USERNAME} ./backend $APP_HOME/
COPY --chown=${USERNAME}:${USERNAME} ./backend/.env $APP_HOME/.env

# install all PHP dependencies
RUN composer install --prefer-dist --no-dev --no-interaction --optimize-autoloader

#RUN php artisan key:generate
RUN php artisan key:generate
RUN php artisan route:cache

USER root
# Expose port 9000 and start php-fpm server
EXPOSE 8000
#
#CMD ["php-fpm"]
#; php artisan migrate:refresh
