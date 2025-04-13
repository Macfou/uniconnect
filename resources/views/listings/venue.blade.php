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

    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
       
      
            <h2 class="text-xl py-2 px-4 font-semibold text-gray-800 mb-2">
                Venue details: <span class="text-blue-600">{{ $event->tags ?? 'Untitled Event' }}</span>
            </h2>


        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left font-semibold text-gray-700">Venue</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-700">Date</th>
                        <th class="py-3 px-6 text-left font-semibold text-gray-700">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-3 px-6">{{ $event->venue }}</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layout>
