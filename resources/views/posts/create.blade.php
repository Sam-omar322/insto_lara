<x-app-layout>
<div class="card p-6 bg-white dark:bg-gray-800 dark:text-gray-200 rounded-lg shadow-md w-full max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>
        <div class="mb-4">
            <x-input-label for="image" :value="__('Post Image')" />
            <x-file-input id="image" name="image" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Post</button>
        </div>
    </form>
</div>

</x-app-layout>