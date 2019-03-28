FROM php:7-fpm

RUN docker-php-ext-install pdo pdo_mysql

# sendmail config

RUN apt-get update
RUN apt-get install -q -y ssmtp mailutils

# root is the person who gets all mail for userids < 1000
RUN echo "root=jlangecamagru@gmail.com" >> /etc/ssmtp/ssmtp.conf

# Here is the gmail configuration (or change it to your private smtp server)
RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthUser=jlangecamagru@gmail.com" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthPass=camagru42" >> /etc/ssmtp/ssmtp.conf

RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf


# Set up php sendmail config
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini

WORKDIR /
RUN rm -rf /var/www/html
