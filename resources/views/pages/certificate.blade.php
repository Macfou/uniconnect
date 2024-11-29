<x-layout>
    <div class="bg-gray-100 py-10">
        <div class="max-w-4xl mx-auto bg-white shadow-lg p-6 rounded-lg">
            <h2 class="text-2xl font-bold mb-6">Create a Certificate</h2>
    
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif
    
            <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Certificate Title</label>
                    <input type="text" id="title" name="title" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div class="mb-4">
                    <label for="background_image" class="block text-sm font-medium text-gray-700">Background Image</label>
                    <input type="file" id="background_image" name="background_image" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('background_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700">Certificate Content</label>
                    <div id="certificate-designer" class="border rounded p-4 mt-2 bg-gray-50" contenteditable="true" 
                         style="height: 300px; overflow-y: auto; border: 1px solid #ccc;">
                        <!-- User can drag and drop elements here -->
                    </div>
                    <input type="hidden" id="content" name="content">
                    @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
    
                <div class="flex justify-end">
                    <button type="button" onclick="saveContent()"
                            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Save Certificate</button>
                </div>
            </form>
        </div>
    
        <script>
            function saveContent() {
                const designerContent = document.getElementById('certificate-designer').innerHTML;
                document.getElementById('content').value = JSON.stringify({ html: designerContent });
                document.querySelector('form').submit();
            }
        </script>

</div>
    

</x-layout>