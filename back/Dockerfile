# Берём официальный PHP образ с CLI и нужными расширениями
FROM php:8.4-cli

# Устанавливаем системные пакеты и расширения, необходимые для Symfony
RUN apt-get update && apt-get install -y \
        git \
        unzip \
        libicu-dev \
        zlib1g-dev \
        libzip-dev \
        libonig-dev \
        libxml2-dev \
    && docker-php-ext-install intl  zip

# Копируем Composer из официального образа composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /app

# Копируем только файлы composer.json и composer.lock для кеширования
COPY composer.json composer.lock ./

# Устанавливаем зависимости (только по composer)
RUN composer install --no-autoloader --no-scripts --no-interaction

# Копируем весь проект
COPY . .

# Генерируем autoload и запускаем post-install скрипты
RUN composer dump-autoload && composer run-script post-install-cmd

# Открываем порт для dev
EXPOSE 8000

# Запуск dev server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]