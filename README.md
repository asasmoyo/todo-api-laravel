## Todo API Laravel

### Requirements

1. Docker (https://docs.docker.com/engine/install/)

1. Pre-download images

    Jalankan program Docker terlebih dahulu lalu buka terminal dan jalankan:

    ```
    docker pull postgres:12
    docker pull php:7.4-apache
    ```

### Endpoints

Host: http://todo-api-laravel.herokuapp.com

Headers required:

    1. `Content-type: application/json`

1. `GET /api/todos` get all todo tasks

    Example response:

    ```
    {
        "data": [
            {
            "id": 1,
            "title": "working",
            "description": "in github",
            "done": false
            }
        ],
        "links": {
            "first": "http://todo-api-laravel.herokuapp.com/api/todos?page=1",
            "last": "http://todo-api-laravel.herokuapp.com/api/todos?page=1",
            "prev": null,
            "next": null
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "path": "http://todo-api-laravel.herokuapp.com/api/todos",
            "per_page": 20,
            "to": 1,
            "total": 1
        }
    }
    ```

1. `POST /api/todos` create a new todo task

    Request payload:

    1. `title` string, max 100 characters

    1. `description` string, max 500 characters

    Example request payload:

    ```
    {
        "title": "programming homework",
        "description": "assignment #10"
    }
    ```

    Example response:

    ```
    {
        "data": {
            "id": 1,
            "title": "working",
            "description": "in github",
            "done":false
        }
    }
    ```

1. `PATCH /api/todos/{id}` update specified todo

    Request payload:

    1. `done` boolean

    Example request payload:

    ```
    {
        "done": true
    }
    ```

    Example response body:

    ```
    {
        "data": {
            "id": 1,
            "title": "working",
            "description": "in github",
            "done": true
        }
    }
    ```

1. `DELETE /api/todos{id}` delete specified todo

    Expected response status: `204 No Content`

    No response body.
