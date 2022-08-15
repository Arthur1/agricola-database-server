# agricola-database

## init

### docker

```
$ make build
$ make start
```

### laravel

```
$ cp .env.example .env
```

edit `.env` as follows:

```
DB_HOST=db
DB_DATABASE=agricola-database
DB_USERNAME=default
DB_PASSWORD=password
```

```
$ make exec
% composer install
% php artisan key:generate
% artisan migrate
% artisan db:seed
% artisan telescope:install
```
