[![Build Status](https://travis-ci.org/albertcolom/ddd-cms.svg?branch=master)](https://travis-ci.org/albertcolom/ddd-cms)

Simple CMS with DDD
==============

### Requirements
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Examples in this repo

- [x] Environment dev build with **docker**
- [x] Automated build with **apache ant**
- [x] **DDD** (Domain Driver Design)
- [x] **RESTful API**
- [x] Implement dev fixtures with **alice**
- [x] Unit testing with **PHPUnit**
- [x] Test API with **Behat**
- [x] CommandHandler
- [x] Implement **CommandBus** with **tactician**
- [x] **DomainEvents**
- [x] Publish Events to **RabbitMQ**
- [x] Events stored in **ElasticSearch**
- [x] Nginx logs with **ELK** (Elasticsearch + Logstash + Kibana)
- [x] **Continuous integration** with Travis and Docker

NOTE: Refactor Pending

### Docker containers

- PHP7
- Nginx
- MySQL
- RabbitMQ
- Elasticsearch
- Logstash
- Kibana

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

Add domain in host (Optional)
```sh
127.0.0.1 ddd.cms.dev
```

### The Environment
- **API Doc:** ```http://localhost/api/doc or http://ddd.cms.dev/api/doc```
- **RabbitMQ:** ```http://localhost:15672 or http://ddd.cms.dev:15672```
- **ElasticSearch:** ```http://localhost:9200 or http://ddd.cms.dev:9200```
- **Kibana:** ```http://localhost:5601 or http://ddd.cms.dev:5601```

### Symfony console
```sh
$ docker-compose exec php bin/console
```

Listener to read message from RabbitMQ and publish on ElasticSearch
```sh
$ docker-compose exec php bin/console rabbitmq:consumer events
```

### Test
PHPunit
```sh
$ docker-compose exec php bin/phpunit
or
$ docker-compose exec php ant phpunit
```

PHP Mess Detector: PHPMD
```sh
$ docker-compose exec php bin/phpmd src text ruleset.xml
or
$ docker-compose exec php ant phpmd
```

CodeSniffer PSR-2
```sh
$ docker-compose exec php bin/phpcs --standard=PSR2 src
or
$ docker-compose exec php ant psr2
```

Behat
```sh
$ docker-compose exec php bin/behat
or
$ docker-compose exec php ant behat
```

Execute all test suite (PHPunit, PHPMD, PSR-2, Behat)
```sh
$ docker-compose exec php ant testing
```