<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>
    <div class="max-w-6xl mx-auto mt-10 bg-white shadow-xl rounded-2xl p-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">
            Event Checklist: <span class="text-blue-600">{{ $event->tags ?? 'Untitled Event' }}</span>
        </h2>

        <a href="{{ route('view_transfer', ['id' => $event->id]) }}" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
            View Requests
         </a>

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

        <form action="{{ route('permit.transfer.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="listings_id" value="{{ $event->id }}">
            <div>
                <label for="equipment" class="block text-sm font-medium">Equipment (use commas for multiple)</label>
                <input type="text" name="equipment" id="equipment" class="mt-1 block px-4 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. Chairs, Tables" required>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium">Quantity (match order with equipment)</label>
                <input type="text" name="quantity" id="quantity" class="mt-1 block px-4 py-2 w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. 10, 5" required>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium">Upload Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="mt-1 px-4 py-2 block w-full text-sm">
            </div>

            <div>
                <label for="from" class="block text-sm font-medium">From</label>
                <input type="text" name="from" id="from" class="mt-1 block w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="to" class="block text-sm font-medium">To</label>
                <input type="text" name="to" id="to" class="mt-1 block w-full px-4 py-2 rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">Submit</button>
            </div>

          
        </form>
    </div>
    </div>
</x-layout>
