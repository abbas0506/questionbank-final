<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            GradeSeeder::class,
            SubjectSeeder::class,
            BookSeeder::class,
            // ChapterSeeder::class,
            // TopicSeeder::class,
            TypeSeeder::class,
            SubtypeSeeder::class,
            UserSeeder::class,
            // QuestionSeeder::class,
        ]);
    }
}
