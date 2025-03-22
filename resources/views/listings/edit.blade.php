<x-layout>
    @include('partials._myevents')

    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
        <div class="w-full max-w-3xl bg-white shadow-md rounded-lg p-8">
    
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Draft Event</h1>

        <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Title</label>
                    <input type="text" name="title" value="{{ $listing->tags   }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Organization</label>
                    <input type="text" name="organization" value="{{ $listing->organization }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

               <!-- Venue (Read-Only) -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Venue</label>
    <input type="text" value="{{ $listing->venue }}" readonly 
        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-200 cursor-not-allowed">
    <input type="hidden" name="venue" value="{{ $listing->venue }}"> <!-- Hidden input -->
</div>

<!-- Event Date (Read-Only) -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Event Date</label>
    <input type="text" value="{{ \Carbon\Carbon::parse($listing->event_date)->format('Y-m-d') }}" readonly 
        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-200 cursor-not-allowed">
   <input type="hidden" name="event_date" value="{{ \Carbon\Carbon::parse($listing->event_date)->format('Y-m-d') }}"> <!-- Hidden input -->
</div>

<!-- Event Time (Read-Only) -->
<div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Event Time</label>
    <input type="text" value="{{ $listing->event_time }}" readonly 
        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-200 cursor-not-allowed">
    <input type="hidden" name="event_time" value="{{ $listing->event_time }}"> <!-- Hidden input -->
</div>

                

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea name="description" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $listing->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Image</label>
                    <input type="file" name="image" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if($listing->image)
                        <p class="mt-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $listing->image) }}" class="w-40 h-40 object-cover mt-2 rounded">
                    @endif
                </div>

                <div class="flex justify-between mt-6">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Save Changes
                    </button>
                    
                    <a href="{{ route('listings.draft') }}" 
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
