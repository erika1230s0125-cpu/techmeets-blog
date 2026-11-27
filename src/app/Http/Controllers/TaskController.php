<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use App\Repositories\TaskRepository;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function __construct(
        private TaskService $taskService,
        private TaskRepository $taskRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskRepository->getByUser(auth()->id());

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        $task = $this->taskService->createTask($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'タスクを作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Gate::authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        $validated = $request->validated();
        
        $task = $this->taskService->updateTask($task, $validated);

        return redirect()->route('tasks.show', $task)
            ->with('success', 'タスクを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $this->taskService->deleteTask($task);

        return redirect()->route('tasks.index')
            ->with('success', 'タスクを削除しました');
    }

    public function toggle(Task $task)
    {
        Gate::authorize('update', $task);

        $this->taskService->toggleComplete($task);

        return redirect()->route('tasks.index')
            ->with('success', 'タスクの完了状態を切り替えました');
    }
}
