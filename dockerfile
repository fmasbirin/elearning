FROM ubuntu:16.04

# Install.
RUN \
  apt-get update && \
  apt-get -y upgrade && \
  DEBIAN_FRONTEND=noninteractive apt-get install -q -y postfix && \
  apt-get install -y nginx php php-pgsql  php-gd php-curl php-fpm php-cgi php-cli php-zip apache2-utils  && \
  apt-get install -y supervisor  postgresql-client postgresql-client-common postgresql-contrib && \
  apt-get install -y php-mbstring php-xmlrpc  php-soap php-ctype  php-zip php-simplexml  php-dom php-xml php-json php-intl  php-memcached php-ldap libpq-dev  rsyslog  && \
  apt-get install -y curl git htop man unzip vim wget



CMD mkdir /var/www/html/localcache
CMD chown www-data:www-data /var/www/html/localcache
RUN mkdir /run/php
COPY php.ini /etc/php/7.0/fpm/php.ini
COPY index.php /var/www/html/index.php
COPY site.conf /etc/nginx/sites-enabled/default
COPY mulainginx.sh /start_nginx.sh
COPY start_php-fpm7.sh /start_php-fpm7.sh
COPY wrapper.sh /wrapper.sh
CMD chown www-data:www-data /var/www
CMD chown -R www-data:www-data /var/www/*
RUN chmod +x /start_nginx.sh /start_php-fpm7.sh /wrapper.sh
CMD ["/wrapper.sh"]
