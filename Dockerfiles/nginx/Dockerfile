FROM nginx:latest

RUN mkdir /etc/nginx/snippets/
RUN apt-get update
RUN apt-get install openssl
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt -subj "/C=FR/ST=Ile-De-France/L=Paris/O=42/OU=42/CN=$DOCKER_IP"
RUN openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
RUN rm /etc/nginx/conf.d/default.conf
COPY ./config/default.conf /etc/nginx/conf.d
COPY ./config/self-signed.conf /etc/nginx/snippets/
COPY ./config/ssl-params.conf /etc/nginx/snippets/
