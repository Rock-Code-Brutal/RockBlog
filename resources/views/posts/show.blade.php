<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">
        <!-- Back Button -->
        <div class="mb-12">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-200 bg-white dark:bg-gray-800 px-6 py-3 rounded-lg shadow-sm hover:shadow-md">
                <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Posts
            </a>
        </div>

        <article class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden">
            @if($post->cover_image)
                <div class="w-full h-80 md:h-96">
                    <img src="{{ asset('storage/' . $post->cover_image) }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover">
                </div>
            @endif
            
            <div class="p-12 lg:p-16">
                <header class="mb-12">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-8 leading-tight">
                        {{ $post->title }}
                    </h1>
                    
                    <div class="flex items-center text-gray-600 dark:text-gray-400 text-base bg-gray-50 dark:bg-gray-700 px-6 py-4 rounded-lg">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <time datetime="{{ $post->created_at->toISOString() }}">
                            {{ $post->created_at->format('F j, Y') }}
                        </time>
                        <span class="mx-4">•</span>
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>{{ $post->user->name ?? 'Unknown Author' }}</span>
                    </div>
                </header>
                
                <div class="prose prose-xl dark:prose-invert max-w-none leading-relaxed">
                    <div class="text-gray-800 dark:text-gray-200 text-lg leading-8 space-y-6">
                        {!! nl2br(e($post->body)) !!}
                    </div>
                </div>
                
                @auth
                    @if(auth()->user()->id === $post->user_id)
                        <div class="mt-16 pt-12 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Post Management</h3>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('admin.posts.edit', $post) }}" 
                                   class="inline-flex items-center justify-center bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit Post
                                </a>
                                
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" 
                                      onsubmit="return confirm('Are you sure you want to delete this post?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition-colors duration-200 font-medium">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete Post
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </article>
    </div>
</x-app-layout>