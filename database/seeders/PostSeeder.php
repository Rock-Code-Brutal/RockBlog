<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create a test user if none exists
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@blog.com',
                'email_verified_at' => now(),
            ]);
        }

        // Create sample posts
        $posts = [
            [
                'title' => 'Welcome to Our Blog',
                'body' => "Welcome to our amazing blog! This is the first post to get you started.\n\nWe're excited to share our thoughts, insights, and stories with you. This blog will cover various topics including technology, lifestyle, and much more.\n\nStay tuned for more exciting content!",
            ],
            [
                'title' => 'Getting Started with Laravel',
                'body' => "Laravel is an amazing PHP framework that makes web development a joy.\n\nIn this post, we'll explore some of the key features that make Laravel so popular:\n\n- Elegant syntax\n- Built-in ORM (Eloquent)\n- Powerful routing system\n- Blade templating engine\n- Authentication system\n\nWhether you're a beginner or an experienced developer, Laravel has something to offer for everyone.",
            ],
            [
                'title' => 'The Power of Modern Web Development',
                'body' => "Web development has evolved tremendously over the past decade.\n\nToday's web applications are more powerful, interactive, and user-friendly than ever before. With frameworks like Laravel, developers can build robust applications quickly and efficiently.\n\nKey trends in modern web development:\n- Progressive Web Apps (PWAs)\n- Single Page Applications (SPAs)\n- API-first development\n- Microservices architecture\n- Cloud-native applications\n\nThe future of web development looks brighter than ever!",
            ]
        ];

        foreach ($posts as $postData) {
            Post::create([
                'title' => $postData['title'],
                'body' => $postData['body'],
                'user_id' => $user->id,
            ]);
        }
    }
}
