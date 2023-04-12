# Запуск проекта

1. Перейти в корень проекта
2. Выполнить
```sh
cp .env.example .env
cp src/.env.example src/.env
```
2. Если нужен отладчик
```sh
cp docker-compose.override.yml.example docker-compose.override.yml
```
3. Выполнить
```sh
docker-compose up -d
```
4. Зайти в контейнер app
```sh
docker-compose exec app bash
```
5. Выполнить
```sh
composer install
php artisan key:generate
php artisan migrate --seed
```

Далее смотреть API документацию.
API документация swagger находится в src/swagger_api.yaml
