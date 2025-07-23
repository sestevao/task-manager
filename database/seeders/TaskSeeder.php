<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Task::insert([
            [
                'title' => 'Buy groceries',
                'description' => 'Milk, eggs, and bread',
                'status' => 'todo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Fix website bug',
                'description' => 'Error on checkout page',
                'status' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Send project report',
                'description' => 'To the manager by 5 PM',
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
