## Тестове завдання на вакансію PHP Backend Developer (Laravel)

## Використані технології
- PHP 8.4
- Laravel 12
- MariaDB
- PhpMyAdmin
- Nginx
- Docker & Docker Compose

## Розгортання проєкту
1. Клонування репозиторію
```angular2html
git clone [repository_url]

cd laravel-app
```
2. Запустити скрипт для розгортання Docker-контейнерів (формування env-файлу, збірка образів, запуск контейнерів, встановлення composer, міграції бази даних, наповнення початковими даними):
```angular2html
deployment/build.sh
```
3. Дочекайтеся завершення збірки і перевірте статус:
```angular2html
docker-compose ps
```
## Доступ до проєкту:
- Сайт: http://localhost:8080
- Swagger UI: http://localhost:8080/api/documentation
- phpMyAdmin: http://localhost:8081
- Реалізовані API-ендпоінти описані у Swagger документації:
  - POST: **api/company** - Створення/Оновлення компанії з підтримкою версійності змін
  - GET: **api/company/{edrpou}/versions** - Перегляд всіх версій змін даних компанії за її ЄДРПОУ
  - GET: **api/companies** - Перегляд список усіх компаній збережених в системі

## Команда для запуску тестів:
```angular2html
docker exec -it laravel_app php artisan test
```

## Детальніше про скрипт розгортання проєкту deployment/build.sh:
```angular2html
# Створюємо .env файл з .env.example
cp .env.example .env

# Запускаємо Docker Compose у фоновому режимі з побудовою образів
docker compose up -d --build

# Встановлюємо composer всередині контейнера laravel_app
docker exec -it laravel_app composer install

# Виконуємо міграції та наповнюємо базу даних початковими даними
docker exec -it laravel_app php artisan migrate:fresh --seed
```
