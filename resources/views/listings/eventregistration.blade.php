<x-layout>

    <x-card class="pt-10 max-w-md mx-auto">
        <a href="{{ route('listings.show', $listing->id) }}" class="inline-block text-black mb-4">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>

        <h1 class="text-xl font-bold mb-5">{{ $listing->title }}</h1>
        <p class="mb-4">Register for this event:</p>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('event.store', $listing->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Full Name</label>
                <input type="text" name="full_name" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Year</label>
                <select name="year" class="w-full p-2 border rounded" required>
                    <option value="" disabled selected>Select Year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                    <option value="5th Year">5th Year</option>
                </select>
            </div>
            

            <div>
                <label class="block text-gray-700 font-bold mb-2">College</label>
                <input type="text" name="college" class="w-full p-2 border rounded" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
                Register
            </button>
        </form>
    </x-card>

</x-layout>
