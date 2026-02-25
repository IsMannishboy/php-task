FROM php:8.2-cli

WORKDIR /app

# Установим зависимости для Symfony
RUN apt-get update && apt-get install -y git unzip libicu-dev zlib1g-dev libzip-dev \
    && docker-php-ext-install intl pdo_mysql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Копируем проект
COPY . .

# Устанавливаем зависимости PHP
RUN composer install

# Открываем порт для dev
EXPOSE 8000

# Запуск dev server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]