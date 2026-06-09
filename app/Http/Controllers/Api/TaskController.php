<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /api/tasks - index (список с пагинацией, фильтрацией, сортировкой)
    public function index(Request $request)
    {
        $query = Task::with(['discipline', 'teacher']);

        // Фильтрация по дисциплине
        if ($request->has('discipline_id')) {
            $query->where('discipline_id', $request->discipline_id);
        }

        // Фильтрация по преподавателю
        if ($request->has('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        // Сортировка
        $sortField = $request->get('sort_by', 'id');
        $sortOrder = $request->get('order', 'asc');
        if (in_array($sortField, ['id', 'title', 'due_date', 'created_at'])) {
            $query->orderBy($sortField, $sortOrder);
        }

        // Пагинация (по умолчанию 15)
        $perPage = $request->get('per_page', 15);
        $tasks = $query->paginate($perPage);

        return response()->json($tasks);
    }

    // GET /api/tasks/{id} - получить одну задачу
    public function show($id)
    {
        $task = Task::with(['discipline', 'teacher', 'submissions.student'])->findOrFail($id);
        return response()->json($task);
    }

    // POST /api/tasks - create (создание новой задачи)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discipline_id' => 'required|exists:disciplines,id',
            'teacher_id' => 'required|exists:users,id',
            'due_date' => 'required|date',
            'max_score' => 'nullable|integer|min:1|max:100'
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    // PUT /api/tasks/{id} - update (обновление задачи)
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'discipline_id' => 'sometimes|exists:disciplines,id',
            'teacher_id' => 'sometimes|exists:users,id',
            'due_date' => 'sometimes|date',
            'max_score' => 'nullable|integer|min:1|max:100'
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    // DELETE /api/tasks/{id} - delete (удаление задачи)
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
