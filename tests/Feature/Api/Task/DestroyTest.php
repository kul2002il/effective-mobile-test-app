<?php

namespace Tests\Feature\Api\Task;

use Database\Factories\TaskFactory;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    public function test_destroy_deletes_task(): void
    {
        $task = TaskFactory::new()->createOne();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
