# products_erp
Система управления продуктами по случайному заданию из вакансий.
REST API Backend на Laravel, простой фронт для использования на VueJS 3.

>Laravel v10.26.2
> 
>PHP 8.1
>
>spatie\permissions
>
>laravel-sanctum
>
>Кэширование через Redis
>
>Кастомные ошибки

В config/products.php устанавливается логин и пароль администратора по умолчанию, а также почта для уведомлений и список ролей с доступом к добавлению продуктов/изменению артикулов.

### Неообходимо

* Docker
### Проект упакован в docker.
Для запуска необходимо наличие docker compose/docker-desktop.

### Предварительная настройка .env в ./backend:
Заполнить следующие поля:
* DB_USERNAME
* DB_PASSWORD
* Поля MAIL [пусты]

### Запуск
После настройки .env: вернуться в корневую папку с проектом, ввести:
```
docker compose up -d
```
#### Дождаться полного запуска (полный запуск контейнера php-queue может занять какое-то время).
#### По умолчанию запуск настроен на адрес и порт:
127.0.0.1:8001

### Вёрстка
Сверстано согласно макету:

![Макет](https://s.iimg.su/s/05/eqiul6oD8wxkceUODzz7IlzV2gtQeMAa5qF6dVJA.png)
