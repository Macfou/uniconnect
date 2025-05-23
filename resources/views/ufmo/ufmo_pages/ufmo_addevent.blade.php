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
    <label class="block font-semibold text-gray-700">Select Venue, Date & Time</label>
    <button type="button" onclick="window.location.href='{{ url('ufmo/ufmo_pages/ufmo_calendar') }}'" class="w-full mt-1 p-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
        Select
    </button>
</div>

    
            <h3 class="text-lg font-semibold">Select Date: {{ request('date') }}</h3>
        
        <h3 class="text-lg font-semibold">Facility: {{ request('facility') }}</h3>
        <h3 class="text-lg font-semibold">Selected Time: {{ request('time') }}</h3>
    
        <input type="hidden" for="event_date" name="event_date" value="{{ request('date') }}">
        
        <input type="hidden" for="venue" name="venue" value="{{ request('facility') }}">
        <input type="hidden" for="event_time" name="event_time" value="{{ request('time') }}">

            <div class="mb-4">
                <label class="block text-sm font-medium">Title</label>
                <input type="text" name="tags" class="w-full mt-1 border-black py-2 px-4 rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="w-full mt-1 border-black py-2 px-4 rounded-md"></textarea>
            </div>

            


            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                Submit Event
            </button>
        </form>
    </div>
</x-ufmo-layout>
