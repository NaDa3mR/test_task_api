<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tasks = [
            [
                'title' => 'Complete Laravel project',
                'description' => 'Finish building REST API with all endpoints and validation',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => Carbon::now()->addDays(3)->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Write documentation',
                'description' => 'Prepare README and API documentation for the project',
                'status' => 'in_progress',
                'priority' => 'medium',
                'due_date' => Carbon::now()->addDays(5)->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Test API endpoints',
                'description' => 'Check all endpoints with Postman and fix errors',
                'status' => 'done',
                'priority' => 'low',
                'due_date' => Carbon::now()->subDays(2)->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Prepare presentation',
                'description' => 'Prepare slides for project demo',
                'status' => 'pending',
                'priority' => 'high',
                'due_date' => Carbon::now()->addDays(1)->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Code review',
                'description' => 'Review code of team members for quality',
                'status' => 'in_progress',
                'priority' => 'medium',
                'due_date' => Carbon::now()->addDays(4)->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('tasks')->insert($tasks);
    }
}
