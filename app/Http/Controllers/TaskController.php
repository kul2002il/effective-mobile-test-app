<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(): JsonResource
    {
        return TaskResource::collection(Task::all());
    }

    public function store(StoreTaskRequest $request): JsonResource
    {
        /** @phpstan-ignore-next-line argument.type */
        $task = Task::query()->create($request->validated());

        return new TaskResource($task);
    }

    public function show(Task $task): JsonResource
    {
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task): JsonResource
    {
        /** @phpstan-ignore-next-line argument.type */
        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
