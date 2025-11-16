#!/bin/sh

# Створюємо .env файл з .env.example
cp .env.example .env

# Запускаємо Docker Compose у фоновому режимі з побудовою образів
docker compose up -d --build

echo "Waiting for -> laravel_app <- container to start..."

# Чекаємо поки container "laravel_app" стане running
until [ "$(docker inspect -f '{{.State.Running}}' laravel_app)" = "true" ]; do
  sleep 1
done

# Встановлюємо composer всередині контейнера laravel_app
docker exec -it laravel_app composer install

# Виконуємо міграції та наповнюємо базу даних початковими даними
docker exec -it laravel_app php artisan migrate:fresh --seed
