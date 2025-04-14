<x-ufmo-layout>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-4">Create Event</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('eventadmin.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium">Title</label>
                <input type="text" name="title" class="w-full mt-1 border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="w-full mt-1 border-gray-300 rounded-md"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Venue</label>
                <input type="text" name="venue" class="w-full mt-1 border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Date</label>
                <input type="date" name="date" class="w-full mt-1 border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Time</label>
                <input type="time" name="time" class="w-full mt-1 border-gray-300 rounded-md" required>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                Submit Event
            </button>
        </form>
    </div>
</x-ufmo-layout>
