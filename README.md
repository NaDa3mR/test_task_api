## Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/NaDa3mR/test_task_api.git
cd test_task_api
## API Endpoints
PS E:\xampp\htdocs\test-task-api> php artisan route:list --path=api

  GET|HEAD        api/tasks ..................................................................................... tasks.index › API\TaskController@index
  POST            api/tasks ..................................................................................... tasks.store › API\TaskController@store
  POST            api/tasks/{id}/restore .................................................................................... API\TaskController@restore
  GET|HEAD        api/tasks/{task} ................................................................................ tasks.show › API\TaskController@show
  PUT|PATCH       api/tasks/{task} ............................................................................ tasks.update › API\TaskController@update
  DELETE          api/tasks/{task} .......................................................................... tasks.destroy › API\TaskController@destroy
 
