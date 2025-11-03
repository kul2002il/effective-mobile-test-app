<?php

namespace Tests\Feature\Api\Task;

use Carbon\Carbon;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function test_store_creates_task(): void
    {
        Carbon::setTestNow('2024-01-01 12:00:00');

        $payload = [
            'title'       => 'New Task',
            'description' => 'New description',
            'status'      => 'pending'
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertJson([
            'data' => [
                'title'       => 'New Task',
                'description' => 'New description',
                'status'      => 'pending',
                'created_at'  => '2024-01-01T12:00:00.000000Z',
                'updated_at'  => '2024-01-01T12:00:00.000000Z',
            ]
        ]);

        $this->assertDatabaseHas('tasks', $payload);
    }

    public function test_store_fails_validation(): void
    {
        $response = $this->postJson('/api/tasks', []);

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
