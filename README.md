# agricola-database

## init

### laradock

```
$ cd laradock
$ cp env-sample .env
```

edit `.env` as follows:

```
COMPOSE_PROJECT_NAME=agricola-database
PHP_VERSION=7.4
MYSQL_DATABASE=agricola_database
```

```
$ cd ../
$ make build
$ make start
```

### laravel

```
$ cp .env.example .env
```

edit `.env` as follows:

```
DB_HOST=agricola-database_mysql_1
DB_DATABASE=agricola_database
DB_USERNAME=default
DB_PASSWORD=secret
```

```
$ make exec
# composer install
# artisan key:generate
# artisan migrate
# artisan db:seed
```
