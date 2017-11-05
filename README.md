Simple CMS with DDD
==============

### Requirements
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Examples in this repo

- [x] Environment dev build with **docker**
- [x] Automated build with **apache ant**
- [x] **DDD** (Domain Driver Design)
- [x] Implement dev fixtures with **alice**
- [x] Unit testing with **PHPUnit**
- [x] CommandHandler
- [x] Implement **CommandBus** with **tactician** 

### Installation

Clone this repository
```sh
$ git clone git@github.com:albertcolom/ddd-cms.git
```

Start docker compose
```sh
$ docker-compose up -d

```

Build environment with Apache Ant
```sh
$ docker-compose exec php ant build

```
   
### Symfony console
```sh
$ docker-compose exec php bin/console

```

### Test
```sh
$ docker-compose exec php bin/phpunit
```