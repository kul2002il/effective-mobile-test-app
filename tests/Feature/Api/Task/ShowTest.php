<?php

namespace Tests\Feature\Api\Task;

use Carbon\Carbon;
use Database\Factories\TaskFactory;
use Tests\TestCase;

class ShowTest extends TestCase
{
    public function test_show_returns_task(): void
    {
        Carbon::setTestNow('2024-01-01 12:00:00');

        $task = TaskFactory::new()->createOne([
            'title'       => 'Test Task',
            'description' => 'Test description',
            'status'      => 'in_progress'
        ]);

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertExactJson([
            'data' => [
                'id'          => $task->id,
                'title'       => 'Test Task',
                'description' => 'Test description',
                'status'      => 'in_progress',
                'created_at'  => '2024-01-01T12:00:00.000000Z',
                'updated_at'  => '2024-01-01T12:00:00.000000Z',
            ]
        ]);
    }
}
