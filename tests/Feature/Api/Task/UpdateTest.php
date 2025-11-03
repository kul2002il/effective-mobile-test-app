<?php

namespace Tests\Feature\Api\Task;

use Carbon\Carbon;
use Database\Factories\TaskFactory;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    public function test_update_modifies_task(): void
    {
        Carbon::setTestNow('2024-01-01 12:00:00');

        $task = TaskFactory::new()->createOne([
            'title'       => 'Original Title',
            'description' => 'Original description',
            'status'      => 'pending'
        ]);

        Carbon::setTestNow('2024-01-02 14:30:00');

        $payload = [
            'title'       => 'Updated Title',
            'description' => 'Updated description',
            'status'      => 'completed'
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $payload);

        $response->assertExactJson([
            'data' => [
                'id'          => $task->id,
                'title'       => 'Updated Title',
                'description' => 'Updated description',
                'status'      => 'completed',
                'created_at'  => '2024-01-01T12:00:00.000000Z',
                'updated_at'  => '2024-01-02T14:30:00.000000Z',
            ]
        ]);

        $this->assertDatabaseHas('tasks', $payload);
    }

    public function test_update_fails_validation(): void
    {
        $task = TaskFactory::new()->createOne();

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title'  => '',
            'status' => ''
        ]);

        $response->assertUnprocessable()
            ->assertExactJson([
                'message' => 'The title field is required. (and 1 more error)',
                'errors'  => [
                    'title'  => ['The title field is required.'],
                    'status' => ['The status field is required.'],
                ]
            ]);
    }
}
