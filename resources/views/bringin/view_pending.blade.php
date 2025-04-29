<x-spmo_layout>

    @php
    $firstRequest = $requests->first();
@endphp

    <div class="pt-28 pb-32 px-6 max-w-4xl mx-auto text-justify leading-relaxed font-serif">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="javascript:history.back()" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-10">
            {{-- Letter Header --}}
           {{-- Letter Header --}}
<div class="mb-6">
    <p class="text-right">Requests Date: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>

    {{-- Centered Office & University Text --}}
    <div class="text-center mt-4">
        <p class="font-bold">Spmo Office</p>
        <p>University of Makati</p>
    </div>

    <div class="flex justify-between mt-4">
        <p>Date In: <strong>{{ $firstRequest->date_in ?? 'N/A' }}</strong></p>
        <p>Date Out: <strong>{{ $firstRequest->date_out ?? 'N/A' }}</strong></p>
    </div>

    <div class="flex justify-between mt-4">
        <p>Name of the Owner/Bearer <strong>{{ auth()->user()->fname }} {{ auth()->user()->lname }}</strong></p>
        <p>College <strong>{{ auth()->user()->org }}</strong></p>
    </div>
</div>



            {{-- Letter Body --}}
            <div class="mb-6">
                <p>Dear Sir/Madam,</p>

                <p class="mt-4">
                    I would like to respectfully request the following equipment to be brought in for the upcoming event 
                    entitled <strong>{{ $event->tags }}</strong>. Below is the list of items needed for the said activity:
                </p>
            </div>

            {{-- Equipment Table --}}
            <table class="min-w-full bg-white border mt-4 mb-6 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left border">Quantity</th>
                        <th class="px-4 py-2 text-left border">Item Description</th>
                        <th class="px-4 py-2 text-left border">Purpose</th>
                        <th class="px-4 py-2 text-left border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="border-t">

                            <td class="px-4 py-2 border">
                                {{ is_array($request->quantity) ? implode(', ', $request->quantity) : ($request->quantity ?? 'N/A') }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ is_array($request->equipment) ? implode(', ', $request->equipment) : ($request->equipment ?? 'N/A') }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $event->tags }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $request->status ?? 'Pending' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500 border">No requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

          {{-- Closing --}}




 </div>
 

           
        </div>
    </div>
</x-spmo_layout>
