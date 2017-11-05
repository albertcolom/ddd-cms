Simple CMS with DDD
==============

### Requirements
- [Apache ant](http://ant.apache.org/)
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
$ ant build

```

### Test
```sh
$ bin/phpunit
```