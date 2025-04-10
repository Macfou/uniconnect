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

        {{-- Event Checklist Card --}}
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="px-6 py-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                    Event Checklist: <span class="text-blue-600">{{ $event->tags ?? 'Untitled Event' }}</span>
                </h2>

                {{-- View and Action Buttons Under Title --}}
                <div class="flex gap-4">
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                        View Event
                    </a>
                    <button class="text-indigo-600 hover:underline text-sm font-medium">Edit</button>
                    <button class="text-red-600 hover:underline text-sm font-medium">Delete</button>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider text-xs border-b">
                        <tr>
                            <th class="px-6 py-3">For Approval</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Request</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">Adviser</td>
                            <td class="px-6 py-4 text-yellow-500 font-semibold">Pending</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('request.adviser', ['id' => $event->id]) }}" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                    Request
                                 </a>
                                 
                            </td>
                        </tr>
                    
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">USC</td>
                            <td class="px-6 py-4 text-yellow-500 font-semibold">Pending</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('request.usc', ['id' => $event->id]) }}" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                    Request
                                 </a>
                            </td>
                        </tr>
                    
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">College/Dean</td>
                            <td class="px-6 py-4 text-yellow-500 font-semibold">Pending</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('request.dean', ['id' => $event->id]) }}" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                    Request
                                 </a>
                            </td>
                        </tr>
                    
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">Permit Borrow</td>
                            <td class="px-6 py-4 text-yellow-500 font-semibold">Pending</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('pages.borrow', ['listing_id' => $event->id]) }}">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                        Borrow
                                    </button>
                                </a>
                            </td>
                        </tr>
                    
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">Permit Bring In</td>
                            <td class="px-6 py-4 text-yellow-500 font-semibold">Pending</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('listings.bringin', ['id' => $event->id]) }}">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                        Request
                                    </button>
                                </a>
                            </td>
                        </tr>
                    
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">Permit Transfer</td>
                            <td class="px-6 py-4 text-yellow-500 font-semibold">Pending</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('listings.permit_transfer', ['id' => $event->id]) }}">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                        Request
                                    </button>
                                </a>
                            </td>
                        </tr>
                    
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">UFMO</td>
                            <td class="px-6 py-4 text-yellow-500 font-semibold">Pending</td>
                            <td class="px-6 py-4">
                              
                            </td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

    @include('partials._footer')
</x-layout>
