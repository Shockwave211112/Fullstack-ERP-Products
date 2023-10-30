# products_erp
Backend - Laravel
Frontend - VueJS 3

### Проект упакован в docker
Для запуска необходимо наличие docker compose/docker-desktop.

### Предварительная настройка .env в ./backend.
Заполнить следующие поля:
* DB_USERNAME [изначально установлено значение из docker-compose.yml]
* DB_PASSWORD [изначально установлено значение из docker-compose.yml]
* Поля MAIL

### Запуск
Перейти через cmd в папку с файлом docker-compose.yml, ввести команду:
```
docker compose up -d
```

#### По умолчанию запуск настроен на адрес и порт:
127.0.0.1:8001
