# Используются
 
 - Laravel
    - Queue
    - Custom BasicAuth [BasicAuth.php]
    - Custom Excel Importer
    - Commands * (You can generate api token, for get access token request)

# Install

**NOTICE: The test Excel file located in directory 'public/test.xlsx'**

1. First we need send default commands
```
composer install
php artisan key:generate
php artisan migrate
php artisan queue:work
```
2. You can change password in the file .env
```
AUTH_PASSWORD="12345"
```
3. Clear Cache
```
php artisan optimize
```
4. Db seed
```
php artisan db:seed
```
5. Generate Access Token
```
php artisan api-token:generate 1
```
5. Go to Postman
```
Headers: Authorization: <Token from point 5>

POST: /excel/upload | Body => [ file => test.xlsx ]
GET: /excel/getData
```

# Тестовое задание  

Реализовать контроллер с валидацией и загрузкой excel файла.

Доступ к контроллеру загрузки закрыть basic-авторизацией.

Загруженный файл через jobs поэтапно (по 1000 строк) парсить в БД (таблица rows).

Прогресс парсинга файла хранить в redis (уникальный ключ + количество обработанных строк).

Поля excel:
`id
name
date (d.m.Y)`

Для парсинга excel можете использовать любой пакет из composer, за **исключением maatwebsite/excel**

Реализовать контроллер для вывода импортированных данных (rows) с группировкой по date - двумерный массив
