# Need docker-machine, docker-compose, virtualbox
# Need DOCKER_IP, DB_USER, DB_PASSWORD, MAIL_USER and MAIL_PASSWORD to work
printf "DB_USER="
read DB_USER
printf "DB_PASSWORD="
read -s DB_PASSWORD
echo ""
printf "MAIL_USER="
read MAIL_USER
printf "MAIL_PASSWORD="
read -s MAIL_PASSWORD
echo ""
export DB_USER
export DB_PASSWORD
export MAIL_USER
export MAIL_PASSWORD
mkdir srcs/assets/publication
chmod 777 srcs/assets/publication
docker-machine create --driver virtualbox Camagru
export DOCKER_IP=$(docker-machine ip Camagru)
eval $(docker-machine env Camagru)
docker-compose build
docker-compose up -d
sleep 30
phpContainer=`docker ps | grep camagru_php | awk '{print $1}'`
docker exec $phpContainer php /var/www/config/setup.php
