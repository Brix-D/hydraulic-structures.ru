## Гидротехнические сооружения

### Выпускная квалификационная работа студента Владислава Денисова

Веб-приложение для учета и контроля уровня воды в различных гидротехнических сооружениях

### Установка: 
для установки и запуска на компьютер в development-режиме потребуется: 
- open server 
- nginx
- MySQl
- php версии > 8
- composer
- node.js версии > 16, вместе с npm

### Шаги для установки

1. git clone https://github.com/Brix-D/hydraulic-structures.ru.git hydraulic-structures.ru
2. cd hydraulic-structures.ru
3. composer install
4. npm install
5. импортировать базу (будет выложена отдельно)
6. скопировать файл .env.example в текущую директорию с именем .env
7. открыть настройки open server вкладка домены, поставить ручной + автометический выбор
8. добавить запись hydraulic-structures.ru -> hydraulic-structures.ru/public
9. открыть open server консоль, перейти в папку с проектом и выполнить
   php artisan migrate, php artisan optimize
