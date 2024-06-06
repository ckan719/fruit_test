## System required

- Docker
- Node 20, yarn

## Tech use
- Laravel 10
- Vue 3 + Vite
- InertiaJs
- ant-design-vue 4x

## How to run

1. copy `env.example` to 'env'
2. run : `docker compose up -d`
3. run : `yarn` and `yarn dev`
4. exec to container: `docker compose exec -it app sh`
5. [in container] run install vendor: `composer install`
6. [in container] run generate key: `php artisan key:generate`
6. [in container] run migrate: `php artisan migrate`
7. [in container] run seed: `php artisan db:seed`
8. access : `localhost/login`
