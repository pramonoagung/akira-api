# Akira API

> Project repository AKIRA API.
> Versi Stable pada branch **master**. Gunakan **branch _dev_** untuk development.

## Minimum Requirement

1.  PHP >= 7.1.3

## Kontribusi aplikasi

Clone source code

```
git clone https://github.com/ThunderIntern/AKIRA-API
```

Install package dependency vendor

```
composer install
```

Buat table

```
php artisan migrate
```

Run seeding

```
php artisan db:seed
```

Run project

```
php -S localhost:8000 -t public
```
