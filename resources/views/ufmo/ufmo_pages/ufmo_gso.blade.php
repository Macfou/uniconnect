<x-ufmo-layout>
    <div class="pt-28 pb-32 px-6 max-w-4xl mx-auto">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        {{-- Letter Format Container --}}
        <div class="bg-white shadow-md rounded-xl p-10 leading-relaxed text-gray-800">
            {{-- Header --}}
            <div class="mb-6">
                <p class="text-sm">University of Makati</p>
                <p class="text-sm">Makati City</p>
                <p class="text-sm">{{ now()->format('F d, Y') }}</p>
            </div>

            {{-- Greeting --}}
            <p class="mb-4">To Whom It May Concern,</p>

            {{-- Body --}}
            <p class="mb-4">
                I hope this message finds you well. I am writing to formally request the following equipment to be used for an approved activity/event. Below is the list of equipment and their respective quantities:
            </p>

            {{-- Equipment Table --}}
            <div class="overflow-x-auto my-6">
                <table class="w-full text-left border border-gray-300 rounded-md text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-3 border-b">Equipment</th>
                            <th class="p-3 border-b">Quantity</th>
                            <th class="p-3 border-b">Status</th>
                            <th class="p-3 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">{{ $request->equipment->name }}</td>
                                <td class="p-3 border-b">{{ $request->quantity }}</td>
                                <td class="p-3 border-b">
                                    @php
                                        $color = match($request->status) {
                                            'approved' => 'bg-green-500',
                                            'pending' => 'bg-yellow-500',
                                            default => 'bg-gray-400',
                                        };
                                    @endphp
                                    <span class="inline-block px-3 py-1 text-white text-xs rounded-full {{ $color }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="p-3 border-b">
                                    @if($request->status == 'pending')
                                        <form action="{{ route('pages.requestview.cancel', ['id' => $request->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this request?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 text-xs rounded hover:bg-red-700">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-sm text-gray-700">Ready for Pick Up</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-4">No equipment requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Closing --}}
            <p class="mb-4">
                I assure you that the equipment will be handled with utmost care and returned promptly after the event. Your kind assistance in this request will be greatly appreciated.
            </p>

            <p class="mb-2">Sincerely,</p>
            <p class="font-semibold">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</p>
            <p class="text-sm text-gray-600">{{ auth()->user()->org ?? 'Organization Representative' }}</p>
        </div>
    </div>

    
</x-ufmo-layout>
