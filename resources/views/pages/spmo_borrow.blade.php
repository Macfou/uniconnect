<x-layout>

    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">
    <div class="mb-6">
        <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back
        </a>
    </div>

    <div class="pt-20">
        <div class="max-w-6xl mx-auto  p-6 bg-white shadow-md rounded-lg">
            <h2 class="text-xl font-bold text-gray-800">Request Equipment for: {{ $event->tags }}</h2>
            <p class="text-black font-bold"><span class="text-black font-semibold">Venue:</span> {{ $event->venue }}</p>
            <p class="text-black font-bold"><span class="text-black font-semibold">Date:</span> {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</p>

            @if (session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        {{ session('error') }}
    </div>
@endif


            <form action="{{ route('spmo.store') }}" method="POST" class="mt-6">
                @csrf
                <input type="hidden" name="listing_id" value="{{ $event->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700">Select Equipment</label>
                    <select name="equipment_id" class="w-full p-2 border rounded-lg">
                        @foreach($equipments as $equipment)
                            <option value="{{ $equipment->id }}">
                                {{ $equipment->name }} (Available: {{ $equipment->available_quantity }})
                            </option>
                        @endforeach
                    </select>
                    
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Quantity</label>
                    <input type="number" name="quantity" class="w-full p-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Date of Transfer</label>
                    <input type="date" name="date_of_transfer" class="w-full p-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Date of Return</label>
                    <input type="date" name="date_of_return" class="w-full p-2 border rounded-lg" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700">From</label>
                    <input type="text" name="from" class="w-full p-2 border rounded-lg" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700">To</label>
                    <input type="text" name="to" class="w-full p-2 border rounded-lg" required>
                </div>
                
               
                
                <div class="mb-4">
                    <label class="block text-gray-700">Remarks</label>
                    <textarea name="remarks" class="w-full p-2 border rounded-lg" rows="3" placeholder="Optional remarks..."></textarea>
                </div>
                

                <button type="submit" class="bg-laravel text-white px-4 py-2 rounded hover:bg-blue-700">
                    Submit Request
                </button>

                <a href="{{ route('pages.spmo_requests', ['id' => $event->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                    View Requests
                </a>
                
            </form>
        </div>
    </div>
</div>

@include('partials._footer')
</x-layout>
