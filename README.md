# Countdown Test

## Run with docker
```
$ git clone git@gitlab.com:elliottlan/countdown-test.git
$ cd countdown-test
docker-compose up -d
[visit http://localhost:5678]
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

## Purge *ALL* (system wide!) docker images and rebuild

```
docker-compose down --remove-orphans; docker system prune -a -f; docker volume prune -f; docker-compose up -d --build;
```