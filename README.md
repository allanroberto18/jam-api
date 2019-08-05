## To start application

```
docker-compose up

composer install

yarn install

# for create database (first execution)
php bin/console doctrine:migrations:migrate

# populate database (first execution)
php bin/console doctrine:fixtures:load

php bin/console server:run

yarn encore dev --watch

php bin/phpunit
```

Api/Documentation: http://127.0.0.1:8000/api/doc

To access app: http://127.0.0.1:8000/
