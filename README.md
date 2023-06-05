## Описание

Сделать модель товары с несколькими заполненными товарами. Модель должна содержать Наименование, цена, категория (у 1 товара может быть несколько категорий).
Реализовывать фронт и CRUD для товаров не обязательно. 
Нужно сделать раздел категории товаров. Реализовать для этого раздела front с функционалом CRUD используя Livewire.
Категория товаров должна включать в себя: название и описание категории. 
Категория может иметь подкатегории.
Фронт необходимо выполнить используя стандартные стили Bootstrap.
Вывод списка категорий должен содержать следующую информацию: 
- наименование категории, 
- количество подкатегорий у данной категории, 
- количество товаров в данной категории, 
- наименование родительской категории.
При добавлении/редактировании категории товара, для выбора родительской категории необходимо реализовать выпадающий список с поисковой строкой (для этого можно использовать из плагинов: SELECT2.JS или Bootstrap-select.js. Или любой другой на ваше усмотрение). 


## Стек

Приложение построено с использованием следующих технологий:

- PHP 8.1 (backend)
- Laravel 10 (web-framework)
- Livewire v.2x 
- MYSQL 10.7.5 (Database ORM)
- Bootstrap 5.3 (frontend-library)
- HTML
- CSS


## Установка

Для локального запуска приложения необходимо выполнить следующие действия:

1. Клонировать репозиторию из GitHub:

```bash
git clone https://github.com/allayar27/Test-_task.git
```

2. Копировать .env.example в .env

3. Запустите миграцию с сидами с выполнив команду:

```bash
 php artisan migrate:fresh --seed
``` 
   
4. Запустите приложение:

```bash
 php artisan serve
```




