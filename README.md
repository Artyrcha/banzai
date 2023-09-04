<p align="center">
    <h1 align="center">Banzai Api</h1>
</p>

## Установка
### PHP
Установить MySQL 8.0, PHP 8.0. Создать базу данных, заполнить данные для подключения в <i>common\config\main-local.php</i>
```bash
php composer install   #установка зависимостей
php init               #инициализация проекта
php yii migrate        #применение миграций