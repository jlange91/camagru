# Need docker-machine, docker-compose, virtualbox
mkdir srcs/assets/publication
chmod 777 srcs/assets/publication
docker-machine create --driver virtualbox Camagru
# Need DOCKER_IP, DB_USER, DB_PASSWORD, MAIL_USER and MAIL_PASSWORD to work
export DOCKER_IP=$(docker-machine ip Camagru)
export DB_USER=root
export DB_PASSWORD=root
export MAIL_USER=jlangecamagru@gmail.com
export MAIL_PASSWORD=camagru42
eval $(docker-machine env Camagru)
docker-compose build
docker-compose up -d
sleep 10
test=`docker ps | grep camagru_php | awk '{print $1}'`
docker exec $test php /var/www/config/setup.php
