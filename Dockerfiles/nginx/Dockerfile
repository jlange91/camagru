FROM nginx:latest

RUN curl -L https://raw.githubusercontent.com/wmnnd/nginx-certbot/master/init-letsencrypt.sh > init-letsencrypt.sh
RUN chmod +x init-letsencrypt.sh
RUN ./init-letsencrypt.sh
