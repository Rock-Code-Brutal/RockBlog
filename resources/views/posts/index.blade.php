<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BlogCMS') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{ config('app.name', 'BlogCMS') }}
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Login</a>
                            <a href="{{ route('register') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-16">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
                <!-- Header -->
                <div class="text-center mb-16">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                        Welcome to Our Blog
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Discover amazing content and stories
                    </p>
                </div>

                @if($posts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-16">
                        @foreach($posts as $post)
                            <article class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                @if($post->cover_image)
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img src="{{ asset('storage/' . $post->cover_image) }}" 
                                             alt="{{ $post->title }}" 
                                             class="w-full h-48 object-cover">
                                    </div>
                                @endif
                                
                                <div class="p-8">
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                                        <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    
                                    <p class="text-gray-600 dark:text-gray-300 mb-6 line-clamp-3 leading-relaxed">
                                        {{ Str::limit(strip_tags($post->body), 150) }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-6">
                                        <span>{{ $post->created_at->format('M j, Y') }}</span>
                                        <span>by {{ $post->user->name ?? 'Unknown Author' }}</span>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <a href="{{ route('posts.show', $post) }}" 
                                           class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                            Read more
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center mt-12">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-20">
                        <div class="text-6xl text-gray-400 dark:text-gray-600 mb-6">📝</div>
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">No posts yet</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-8">Be the first to create a post!</p>
                        @auth
                            <a href="{{ route('admin.posts.create') }}" 
                               class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                Create First Post
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 shadow mt-20">
            <div class="max-w-7xl mx-auto py-12 px-6 sm:px-8 lg:px-10">
                <div class="text-center text-gray-600 dark:text-gray-300">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
