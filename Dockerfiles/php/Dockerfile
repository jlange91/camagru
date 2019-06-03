FROM php:7-fpm

ARG MAIL_USER
ARG MAIL_PASSWORD

RUN docker-php-ext-install pdo pdo_mysql

# sendmail config

RUN apt-get update
RUN apt-get install -q -y ssmtp mailutils libpng-dev
RUN docker-php-ext-install gd


# root is the person who gets all mail for userids < 1000
RUN echo "root=$MAIL_USER" >> /etc/ssmtp/ssmtp.conf

# Here is the gmail configuration (or change it to your private smtp server)
RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthUser=$MAIL_USER" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthPass=$MAIL_PASSWORD" >> /etc/ssmtp/ssmtp.conf

RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf


# Set up php sendmail config
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini

WORKDIR /
RUN rm -rf /var/www/html
