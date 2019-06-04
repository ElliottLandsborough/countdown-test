# Countdown Test

## Run with docker
```
$ git clone git@gitlab.com:elliottlan/countdown-test.git
$ cd countdown-test
$ docker-compose up -d --build
[visit http://localhost:6789]
```

## Simple dev server
```
$ git clone git@gitlab.com:elliottlan/countdown-test.git
$ cd countdown-test
$ composer install
$ php bin/console server:start
```

## Assets
```
$ yarn install
```
```
$ yarn encore dev
```
--OR--
```
$ yarn encore dev --watch
```
--OR--
```
$ yarn encore production
```

## Stop and delete all docker containers and volumes
```
docker container stop countdown_php_1;
docker container stop countdown_nginx_1;
docker container rm countdown_php_1;
docker container rm countdown_nginx_1;
docker volume rm countdowntest_countdownroot;
docker system prune --volumes;
```

## Purge *ALL* (system wide!) docker images and rebuild

```
docker-compose down --remove-orphans; docker system prune -a -f; docker volume prune -f; docker-compose up -d --build;
```