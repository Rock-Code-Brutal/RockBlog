<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;

class FixPostsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:posts-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix posts data and ensure all posts have valid user associations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking posts data...');
        
        // Count posts and users
        $postCount = Post::count();
        $userCount = User::count();
        
        $this->info("Posts: {$postCount}, Users: {$userCount}");
        
        // Find posts without users or with invalid user_id
        $postsWithoutUser = Post::whereNull('user_id')->get();
        $postsWithInvalidUser = Post::whereNotNull('user_id')
            ->whereNotExists(function($query) {
                $query->select('id')
                      ->from('users')
                      ->whereColumn('users.id', 'posts.user_id');
            })->get();
        
        $problematicPosts = $postsWithoutUser->merge($postsWithInvalidUser);
        
        if ($problematicPosts->count() > 0) {
            $this->warn("Found {$problematicPosts->count()} posts with missing or invalid users");
            
            // Get or create a default user
            $defaultUser = User::first();
            if (!$defaultUser) {
                $this->info('Creating default user...');
                $defaultUser = User::create([
                    'name' => 'Admin User',
                    'email' => 'admin@blog.com',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ]);
            }
            
            foreach ($problematicPosts as $post) {
                $this->info("Fixing post: {$post->title}");
                $post->update(['user_id' => $defaultUser->id]);
            }
            
            $this->info('All posts have been fixed!');
        } else {
            $this->info('All posts have valid user associations.');
        }
        
        // Show final stats
        $this->info('Final check:');
        Post::with('user')->get()->each(function($post) {
            $userName = $post->user ? $post->user->name : 'NULL';
            $this->line("Post: {$post->title} - User: {$userName}");
        });
    }
}
