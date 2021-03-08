# testdocker
Create php app through docker.
Store session in redis instead of default file.
Push some messages into RabbitMQ.
Send mails via processing those messages.

Done
- [PHP](https://hub.docker.com/_/php)
- [NGINX](https://hub.docker.com/_/nginx)
- [MYSQL](https://hub.docker.com/_/mysql)
- [Redis](https://hub.docker.com/_/redis)

Soon
- [RabbitMQ](https://hub.docker.com/_/rabbitmq)
- Somemailer

Todos
- update container names
- move docker-compose.yml into root and map volume ./ isntead of app/
- add php:fpm work dir /var/www or /var/www/dk not the default /var/www/html
- add redis password
/etc/redis/redis.conf
requirepass yourverycomplexpasswordhere

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
winpty docker exec -it docker_php-fpm-d_1 sh

```sh
winpty docker exec -it docker_redis_1 sh
redis-cli
ping
keys *
get "PHPREDIS_SESSION:e89e12..."
```
#### Important
Docker-compose services are used outside the file.
- database service is used in dsn connection mysql:host=`database-d`
- php service is used in `docker/nginx/conf.d/default.conf`
upstream php-upstream {
    server `php-fpm-d`:9000;
}
- redis service name is used for connection host:
$client = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => `'redis'`,
    'port'   => 6379,
]);