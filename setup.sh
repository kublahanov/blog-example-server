#!/bin/bash

# Установка зависимостей через Composer
composer install

# Создание файла .env из .env.example, если его еще нет
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Запуск стека в Docker
./vendor/bin/sail up -d

# Генерация ключа приложения
./vendor/bin/sail artisan key:generate --ansi

# Запуск миграций
./vendor/bin/sail artisan migrate --seed

# Настройка Laravel Passport
./vendor/bin/sail artisan passport:keys
./vendor/bin/sail artisan passport:client --personal -q
