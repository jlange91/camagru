#!/bin/bash
# Need docker-machine, docker-compose, virtualbox
docker-machine create --driver virtualbox Char
export DOCKER_IP=$(docker-machine ip Char)
eval $(docker-machine env Char)
docker-compose build
docker-compose up
