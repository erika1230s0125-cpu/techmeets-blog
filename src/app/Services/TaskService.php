<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskService
{
    public function __construct(
        private TaskRepository $taskRepository
    ) {}

    public function createTask(array $data)
    {
        return DB::transaction(function () use ($data) {

            $task = $this->taskRepository->create($data);

            Log::info('Task created', ['task_id' => $task->id]);

            return $task;
        });
    }

    public function updateTask(Task $task, array $data)
    {
        return DB::transaction(function () use ($task, $data) {
            $updated = $this->taskRepository->update($task, $data);

            Log::info('Task updated', ['task_id' => $updated->id]);

            return $updated;
        });
    }

    public function deleteTask(Task $task)
    {
        return DB::transaction(function () use ($task) {
            $this->taskRepository->delete($task);

            Log::info('Task deleted', ['task_id' => $task->id]);
        });
    }

    public function toggleComplete(Task $task)
    {
        return DB::transaction(function () use ($task) {
            $updated = $this->taskRepository->update($task, ['is_completed' => !$task->is_completed]);

            Log::info('Task completion toggled', ['task_id' => $task->id, 'is_completed' => $task->is_completed]);

            return $updated;
        });
    }
}
