<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Posts</h1>
            <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Create Post</a>
        </div>

        <div class="bg-white shadow-lg rounded-lg">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="px-6 py-3 border-b">Title</th>
                    <th class="px-6 py-3 border-b">Created At</th>
                    <th class="px-6 py-3 border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td class="px-6 py-4 border-b">{{ $post->title }}</td>
                        <td class="px-6 py-4 border-b">{{ $post->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
