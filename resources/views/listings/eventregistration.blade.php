<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">
        <div 
        class="fixed inset-0 bg-cover bg-center -z-10"
        style="background-image: url('{{ asset('images/umakadmin.jpg') }}');">
        </div>
       
        <x-card class="pt-10 bg-laravel max-w-md mx-auto">
            <a href="{{ route('listings.show', $listing->id) }}" class="inline-block text-white mb-4">
                <i class="fa-solid text-white fa-arrow-left"></i> Back
            </a>

            <h1 class="text-xl text-white font-bold mb-5">{{ $listing->title }}</h1>
            <p class="mb-4 text-white">Register In: {{ $listing->tags }}</p>

            @if(session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form for registration -->
            <form id="registerForm" action="{{ route('event.store', $listing->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-white font-bold mb-2">Email</label>
                    <input type="email" name="email" class="w-full bg-laravel text-white p-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-white font-bold mb-2">Full Name</label>
                    <input type="text" name="full_name" class="w-full bg-laravel text-white p-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-white font-bold mb-2">Year</label>
                    <select name="year" class="w-full bg-laravel text-white p-2 border rounded" required>
                        <option value="" disabled selected>Select Year</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                        <option value="5th Year">5th Year</option>
                    </select>
                </div>

                <div>
                    <label class="block text-white font-bold mb-2">College</label>
                    <input type="text" name="college" class="w-full bg-laravel text-white p-2 border rounded" required>
                </div>

                <!-- The submit button triggers the modal -->
                <button type="button" onclick="openModal()" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-700">
                    Register
                </button>

                <!-- Confirmation Modal -->
                <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-sm">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Are you sure you want to register for this event?</h2>

                        <div class="flex justify-end gap-4">
                            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-700">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Yes, Register
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </x-card>

    </div>
</x-layout>

<script>
    // Function to open the modal
    function openModal() {
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }
</script>
