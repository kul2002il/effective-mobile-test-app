<?php

namespace Tests\Feature\Api\Task;

use Carbon\Carbon;
use Database\Factories\TaskFactory;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_index_returns_all_tasks(): void
    {
        Carbon::setTestNow('2024-01-01 12:00:00');

        $task1 = TaskFactory::new()->createOne([
            'title'       => 'First Task',
            'description' => 'First description',
            'status'      => 'pending'
        ]);

        $task2 = TaskFactory::new()->createOne([
            'title'       => 'Second Task',
            'description' => 'Second description',
            'status'      => 'completed'
        ]);

        $response = $this->getJson('/api/tasks');

        $response->assertExactJson([
            'data' => [
                [
                    'id'          => $task1->id,
                    'title'       => 'First Task',
                    'description' => 'First description',
                    'status'      => 'pending',
                    'created_at'  => '2024-01-01T12:00:00.000000Z',
                    'updated_at'  => '2024-01-01T12:00:00.000000Z',
                ],
                [
                    'id'          => $task2->id,
                    'title'       => 'Second Task',
                    'description' => 'Second description',
                    'status'      => 'completed',
                    'created_at'  => '2024-01-01T12:00:00.000000Z',
                    'updated_at'  => '2024-01-01T12:00:00.000000Z',
                ],
            ]
        ]);
    }
}
