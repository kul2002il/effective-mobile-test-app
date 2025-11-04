<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

/**
 * @group Task
 *
 * API for manage tasks.
 */
class TaskController extends Controller
{
    /**
     * Show all tasks
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Create task
     *
     * @param StoreTaskRequest $request
     * @return JsonResource
     */
    public function store(StoreTaskRequest $request): JsonResource
    {
        /** @phpstan-ignore-next-line argument.type */
        $task = Task::query()->create($request->validated());

        return new TaskResource($task);
    }

    /**
     * Show one task
     *
     * @param Task $task
     * @return JsonResource
     */
    public function show(Task $task): JsonResource
    {
        return new TaskResource($task);
    }

    /**
     * Update task
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return JsonResource
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResource
    {
        /** @phpstan-ignore-next-line argument.type */
        $task->update($request->validated());

        return new TaskResource($task);
    }

    /**
     * Delete task
     *
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
