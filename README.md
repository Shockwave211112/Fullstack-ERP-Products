# products_erp_tz

### Проект упакован в docker
Для запуска необходимо наличие docker/docker-desktop.

### Предварительная настройка .env в ./backend.
Заполнить следующие поля:
* DB_USERNAME
* DB_PASSWORD
* Поля MAIL

### Запуск
Перейти в папку с файлом docker-compose.yml в cmd, ввести команду:
```
docker compose up -d
```

#### По умолчанию запуск настроен на адрес и порт:
127.0.0.1:8001
