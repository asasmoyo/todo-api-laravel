<?php

namespace App\Http\Controllers\Api;

use App\Todo;
use App\Http\Resources\Todo as TodoResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TodoController extends BaseController {
    public function index(Request $request) {
        $todos = Todo::paginate(20);
        return TodoResource::collection($todos);
    }

    public function store(Request $request) {
        $payload = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:500',
        ]);
        $todo = Todo::create($payload);
        $todo->refresh();
        return new TodoResource($todo);
    }

    public function update(Request $request, $id) {
        $payload = $request->validate([
            'done' => 'required|boolean',
        ]);
        $todo = Todo::find($id);
        $todo->done = $payload['done'];
        return new TodoResource($todo);
    }

    public function destroy(Request $request, $id) {
        $todo = Todo::find($id);
        $todo->delete();
        return response('', 204);
    }
}
