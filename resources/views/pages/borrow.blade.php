<x-layout>
    @include('partials._myevents')

    <div class="pt-20">
        <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
            <h2 class="text-xl font-bold text-gray-800">Borrow Equipment for: {{ $event->tags }}</h2>
            <p class="text-black font-bold"><span class="text-black font-semibold">Venue:</span> {{ $event->venue }}</p>
            <p class="text-black font-bold"><span class="text-black font-semibold">Date:</span> {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</p>

            <form action="{{ route('borrow.store') }}" method="POST" class="mt-6">
                @csrf
                <input type="hidden" name="listing_id" value="{{ $event->id }}">

                <div class="mb-4">
                    <label class="block text-gray-700">Select Equipment</label>
                    <select name="equipment_id" class="w-full p-2 border rounded-lg">
                        @foreach($equipments as $equipment)
                            <option value="{{ $equipment->id }}">
                                {{ $equipment->name }} (Available: {{ max(0, $equipment->quantity) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Quantity</label>
                    <input type="number" name="quantity" class="w-full p-2 border rounded-lg" required>
                </div>

                <button type="submit" class="bg-laravel text-white px-4 py-2 rounded hover:bg-blue-700">
                    Submit Request
                </button>

                <a href="{{ route('pages.requestview', ['id' => $event->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                    View Requests
                </a>
                
            </form>
        </div>
    </div>
</x-layout>
