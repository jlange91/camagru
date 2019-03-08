# Need docker-machine, docker-compose, virtualbox
docker-machine create --driver virtualbox Camagru
export DOCKER_IP=$(docker-machine ip Camagru)
eval $(docker-machine env Camagru)
docker-compose build
docker-compose up -d
sleep 10
test=`docker ps | grep camagru_php | awk '{print $1}'`
docker exec $test php /var/www/install.php
