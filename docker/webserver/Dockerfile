FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

# Set timezone ahead of time
RUN ln -fs /usr/share/zoneinfo/Europe/Kiev /etc/localtime && \
    apt-get update && \
    apt-get install -y tzdata && \
    dpkg-reconfigure --frontend noninteractive tzdata

WORKDIR /var/www

RUN apt update && apt upgrade -y
RUN apt install sudo
RUN apt install -y curl
RUN apt-get update --fix-missing 
RUN LC_ALL=C.UTF-8
RUN apt-get install -y software-properties-common ca-certificates lsb-release apt-transport-https
RUN add-apt-repository ppa:ondrej/php -y
RUN apt-get update
RUN apt-get install -y php8.3

RUN apt-get install -y php8.3-cli php8.3-common php8.3-fpm php8.3-mysql php8.3-zip php8.3-gd php8.3-mbstring php8.3-curl php8.3-xml php8.3-bcmath php8.3-pgsql
RUN apt install -y nginx php8.3-fpm php8.3-intl

RUN apt-get --allow-releaseinfo-change update

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Install Node 22
RUN curl -sL https://deb.nodesource.com/setup_22.x | sudo -E bash -
RUN apt install -y nodejs
RUN npm install -g npm@11.6.4

RUN rm -f /etc/nginx/sites-enabled/default

COPY main-nginx.conf /etc/nginx/sites-available/weather
RUN ln -s /etc/nginx/sites-available/weather /etc/nginx/sites-enabled/
COPY openssl.cnf /etc/ssl/openssl.cnf
COPY start.sh /start.sh
COPY php.ini /usr/local/etc/php/

RUN ["chmod", "+x", "/start.sh"]
CMD ["/start.sh"]
