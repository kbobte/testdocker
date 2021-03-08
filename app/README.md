# testdocker
Create php app through docker

- [PHP](https://hub.docker.com/_/php)
- [NGINX](https://hub.docker.com/_/nginx)
- [MYSQL](https://hub.docker.com/_/mysql)
- [Redis](https://hub.docker.com/_/redis)
- [RabbitMQ](https://hub.docker.com/_/rabbitmq)

## Start application via git bash
```sh
cd docker
docker-compose up -d
```

## Docker commands
##### Create container/app
`docker-compose up -d`

##### List containers
`docker ps`

##### Create a new Bash session in the container
winpty docker exec -it `docker_php-fpm-d_1` sh
