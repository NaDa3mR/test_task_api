<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::query();

        if ($request->status)
            $tasks->where('status', $request->status);
        if ($request->priority)
            $tasks->where('priority', $request->priority);
        if ($request->search)
            $tasks->where('title', 'like', "%{$request->search}%");

        if ($request->sort) {
            $tasks->orderBy($request->sort);
        } else {
            $tasks->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
                ->orderBy('due_date', 'asc');
        }
        // $tasks = $tasks->paginate(10);

        $tasks = $tasks->get()->map(function ($task) {
            $task->is_overdue = $task->due_date && $task->status !== 'done' && $task->due_date < now()->toDateString();
            return $task;
        });

        return response()->json([
            'success' => true,
            'data' => $tasks,
            'message' => 'Tasks retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        if ($request->priority === 'high' && !$request->due_date) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Due date is required for high priority tasks'
            ], 422);
        }
        $data['status'] = 'pending';
        $task = Task::create($data);

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if ($request->status) {
            $allowed = [
                'pending' => ['in_progress'],
                'in_progress' => ['done'],
                'done' => [],
            ];

            if (!in_array($request->status, $allowed[$task->status])) {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'message' => "Invalid status transition"
                ], 422);
            }
        }

        $task->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['success' => true, 'data' => [], 'message' => 'Task deleted']);
    }

    //Soft Delete
    public function restore($id)
    {
        $task = Task::withTrashed()->find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Task not found'
            ], 404);
        }

        $task->restore();

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task restored successfully'
        ]);
    }
}

