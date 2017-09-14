FROM php:7-apache

WORKDIR /var/www
COPY www ./

# Environment Variables
ARG DEBCONF_NOWARNINGS=yes
ENV LANG C.UTF-8
ENV NODE_VERSION v6.1.0

# Copy docker files into container
COPY docker/docker-entrypoint.sh /usr/local/bin/
COPY docker/php.ini /usr/local/etc/php/
COPY docker/.htaccess /var/www/html/
COPY docker/ssl.conf /etc/apache2/
COPY docker/wp-su.sh /bin/wp

# Install server dependencies
RUN apt-get update && apt-get install -qqy sudo less nano git subversion wget mysql-client \
  openssl openssh-server libpng12-dev libjpeg-dev \

  # Make entrypoint executable
  && chmod +x /usr/local/bin/docker-entrypoint.sh \

  # Install PHP dependencies
  && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
  && docker-php-ext-install gd mysqli zip \
  && wget https://phar.phpunit.de/phpunit-6.1.phar \
  && chmod +x phpunit-6.1.phar \
  && mv phpunit-6.1.phar /usr/bin/phpunit \
  && pear install PHP_CodeSniffer \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && curl -o /bin/wp-cli.phar https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
  && chmod +x /bin/wp-cli.phar \
  && chmod +x /bin/wp \

  # Install Node.js dependencies
  && curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.32.0/install.sh | bash \
  && export NVM_DIR="$HOME/.nvm" \
  && [ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh" \
  && nvm install $NODE_VERSION \
  && nvm alias default $NODE_VERSION \
  && npm i -g --silent npm-cache gulp-cli browser-sync retire \

  # Create SSH directory
  && mkdir -p /root/.ssh \
  && chmod 700 /root/.ssh \

  # Configure Apache
  && a2enmod rewrite expires ssl \
  && mkdir -p /etc/apache2/ssl \
  && openssl req \
    -new \
    -newkey rsa:2048 \
    -days 365 \
    -nodes \
    -x509 \
    -subj "/C=US/ST=California/L=San Diego/O=Grizzly/OU=Development/CN=localhost" \
    -out /etc/apache2/ssl/server.crt \
    -keyout /etc/apache2/ssl/server.key \
  && cat /etc/apache2/ssl.conf >> /etc/apache2/apache2.conf \
  && rm /etc/apache2/ssl.conf \
  && chown -R www-data:www-data /var/www/html \

  # Clear APT cache
  && rm -rf /var/lib/apt/lists/*

# Copy keys into container
COPY keys/id_rsa /root/.ssh/
COPY keys/id_rsa.pub /root/.ssh/authorized_keys
RUN chmod 600 /root/.ssh/id_rsa \
  && chmod 600 /root/.ssh/authorized_keys

# ENTRYPOINT and CMD
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
