<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-6xl mx-auto">
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">
                Request Equipment for: <span class="text-blue-600">{{ $event->tags ?? 'Untitled Event' }}</span>
            </h2>

           
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('listings.bringin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="listings_id" value="{{ $event->id }}">

                <div id="equipment-list">
                    <div class="equipment-group flex items-center space-x-4 mb-4">
                        <input type="text" name="equipment[]" class="border rounded px-3 py-2 w-1/2" placeholder="Equipment Name" required>
                        <input type="number" name="quantity[]" class="border rounded px-3 py-2 w-1/4" placeholder="Quantity" min="1" required>
                        <button type="button" class="remove-equipment text-red-500 hover:text-red-700 font-bold">✕</button>
                    </div>
                </div>

                <button type="button" id="add-equipment" class="mb-4 text-blue-600 hover:underline">
                    + Add Another Equipment
                </button>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Upload Images</label>
                    <input type="file" name="images[]" multiple class="border rounded px-3 py-2 w-full">
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    Submit Request
                </button>

                <a href="{{ route('view_bringin', ['id' => $event->id]) }}" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                    View Requests
                 </a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-equipment').addEventListener('click', function () {
            const equipmentList = document.getElementById('equipment-list');

            const newGroup = document.createElement('div');
            newGroup.classList.add('equipment-group', 'flex', 'items-center', 'space-x-4', 'mb-4');
            newGroup.innerHTML = `
                <input type="text" name="equipment[]" class="border rounded px-3 py-2 w-1/2" placeholder="Equipment Name" required>
                <input type="number" name="quantity[]" class="border rounded px-3 py-2 w-1/4" placeholder="Quantity" min="1" required>
                <button type="button" class="remove-equipment text-red-500 hover:text-red-700 font-bold">✕</button>
            `;

            equipmentList.appendChild(newGroup);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-equipment')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</x-layout>
