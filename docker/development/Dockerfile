FROM php:8.2-fpm-buster

RUN apt-get update
RUN apt install -y g++ libicu-dev libpq-dev libzip-dev zip zlib1g-dev curl nano htop procps
RUN docker-php-ext-install intl opcache pdo pdo_mysql

RUN apt-get install -y nginx
COPY nginx/app.conf /etc/nginx/sites-enabled/default
COPY entrypoint.sh /etc/entrypoint.sh
COPY healthcheck.sh /etc/healthcheck.sh
RUN chmod +x /etc/entrypoint.sh
RUN chmod +x /etc/healthcheck.sh

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chmod +x /usr/local/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_19.x | bash -
RUN apt install -y build-essential nodejs

RUN mkdir /jeebby
WORKDIR /jeebby
EXPOSE 80
HEALTHCHECK --interval=1m --timeout=10s --start-period=10s CMD /etc/healthcheck.sh
ENTRYPOINT ["/etc/entrypoint.sh"]
