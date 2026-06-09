# 📚 Система управления задачами для учебной группы (Task Manager)

## 📌 Описание проекта
Веб-приложение для организации учебного процесса, где преподаватели создают задачи (лабораторные работы, домашние задания), а студенты отмечают их выполнение.

---

## 👥 Роли и права

| Роль | Возможности |
|------|-------------|
| **Гость** | Просмотр списка дисциплин |
| **Студент** | Просмотр задач, отметка "Выполнено", просмотр прогресса |
| **Преподаватель** | CRUD задач, проверка работ, статистика по группе |
| **Администратор** | Управление пользователями, группами, дисциплинами |

---

## 🗄️ Структура базы данных

### Таблицы:
- **groups** – учебные группы (id, title, course)
- **disciplines** – дисциплины (id, title, description)
- **users** – пользователи (id, name, email, role, group_id, deleted_at)
- **tasks** – задачи (id, title, description, discipline_id, teacher_id, due_date, max_score)
- **task_submissions** – выполнения задач (id, task_id, student_id, status, submitted_at, comment, checked_by, checked_at, teacher_comment)

### Связи:
- `users` → `groups` (много студентов к одной группе)
- `tasks` → `disciplines` (много задач к одной дисциплине)
- `task_submissions` → `tasks` (много отправок к одной задаче)

---

## 🚀 Установка и запуск

### 1. Клонируйте репозиторий
```bash
git clone https://github.com/stass-loom/task-manager.git
cd task-manager
