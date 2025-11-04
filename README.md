# Выполненное тестовое задание от Effective Mobile

## Установка и запуск в Dev окружении

```bash
# Имя пути к текущей директории не должно содержать русских символов и пробелов.
git clone git@github.com:kul2002il/effective-mobile-test-app.git .

cp .env.dev .env
composer install

./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate

# Запуск автотестов
./vendor/bin/sail test
```

## Документация

Для API была сгенерирована [документация](https://kul2002il.github.io/effective-mobile-test-app/public/docs/#).

## Комментарий

Данное задание было выполнено за 6 часов.
