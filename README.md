# Task Manager API

Учебный проект: REST API для управления задачами в учебной группе.

## Стек

- PHP 8.3
- Laravel 11
- MySQL 8.4
- Composer

## Сущности

- groups, disciplines, users, tasks, task_submissions

## Запуск

git clone https://github.com/stass-loom/task-manager.git
cd task-manager
composer install
cp .env.example .env
php artisan key:generate

В .env указать подключение к БД:

DB_HOST=127.0.1.12
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=

php artisan migrate:fresh
php artisan serve

API доступно: http://127.0.0.1:8000/api/tasks

## Методы

GET /api/tasks - список (пагинация, фильтры: discipline_id, teacher_id, sort_by, order)

GET /api/tasks/{id} - одна задача

POST /api/tasks - создание

PUT /api/tasks/{id} - обновление

DELETE /api/tasks/{id} - удаление

## Роли

guest, student, teacher, admin (реализовано в модели User)

## Soft delete

В модели User добавлен трейт SoftDeletes, поле deleted_at.

## Демонстрация изменения схемы БД

Поле max_score добавлено отдельной миграцией после создания tasks.

## Репозиторий

https://github.com/stass-loom/task-manager
