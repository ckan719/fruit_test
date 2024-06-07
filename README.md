## System required

- Docker
- Node 20, yarn

## Tech use
- Laravel 10
- Vue 3 + Vite
- InertiaJs
- ant-design-vue 4x
- Mysql 8

## How to run

1. copy `env.example` to 'env'
2. run : `docker network create fruit`
3. run : `docker compose up -d`
4. run : `yarn` and `yarn dev`
5. exec to container: `docker compose exec -it app sh`
6. [in container] run install vendor: `composer install`
7. [in container] run generate key: `php artisan key:generate`
8. [in container] run migrate: `php artisan migrate`
9. [in container] run seed: `php artisan db:seed`
10. access : `localhost/login`
