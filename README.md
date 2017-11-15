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
- [x] CommandHandler
- [x] Implement **CommandBus** with **tactician**
- [x] Nginx logs with **ELK** (Elasticsearch + Logstash + Kibana)

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
   
### Symfony console
```sh
$ docker-compose exec php bin/console
```

### The Environment
- **API Doc:** ```http://localhost/api/doc or http://ddd.cms.dev/api/doc```
- **RabbitMQ:** ```http://localhost:15672 or http://ddd.cms.dev:15672```
- **ElasticSearch:** ```http://localhost:9200 or http://ddd.cms.dev:9200```
- **Kibana:** ```http://localhost:5601 or http://ddd.cms.dev:5601```

### Test
```sh
$ docker-compose exec php bin/phpunit
```