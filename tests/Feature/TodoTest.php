<?php

namespace Tests\Feature;

use App\Todo;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->seed();

        $response = $this->getJson('/api/todos');
        $response->assertStatus(200);
        $this->assertGreaterThan(0, count($response->json('data')));
    }

    public function testCreate()
    {
        $dummy = factory(Todo::class)->make();

        $param = [
            'title' => $dummy->title,
            'description' => $dummy->description,
        ];
        $response = $this->postJson('/api/todos', $param);
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => array_merge(
                    $param,
                    ['done' => false],
                ),
            ]);
    }

    public function testUpdate()
    {
        $dummy = factory(Todo::class)->make();

        $param = [
            'title' => $dummy->title,
            'description' => $dummy->description,
        ];
        $response = $this->postJson('/api/todos', $param);
        $response->assertStatus(201);

        $param = [
            'done' => !$dummy->done,
        ];
        $id = $response->json('data')['id'];
        $response = $this->patchJson("/api/todos/{$id}", $param);
        $response->assertStatus(200);

        $this->assertEquals($response->json('data')['done'], !$dummy->done);
    }

    public function testDestroy()
    {
        $dummy = factory(Todo::class)->make();

        $param = [
            'title' => $dummy->title,
            'description' => $dummy->description,
        ];
        $response = $this->postJson('/api/todos', $param);
        $response->assertStatus(201);

        $id = $response->json('data')['id'];
        $response = $this->deleteJson("/api/todos/{$id}");
        $response->assertStatus(204);
    }
}
