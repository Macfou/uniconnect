<x-ufmo-layout>

    @php
        $firstRequest = $requests->first();
    @endphp

    <div class="pt-28 pb-32 px-6 max-w-4xl mx-auto text-justify leading-relaxed font-serif">

        {{-- Back & Print Buttons --}}
        <div class="flex justify-between mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
            <button onclick="printDiv('printArea')" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9v6h4v5h4v-5h4V9H6z"></path>
                </svg>
                Print
            </button>
        </div>
        
       
        <div class="bg-white shadow-lg rounded-lg p-10">

            {{-- Letter Header --}}

            <div id="printArea">
            <div class="mb-6">
             

                <div class="text-center mt-4">
                    <p class="font-bold">University of Makati</p>
                    <p>Spmo Office</p>
                    <p>Clearance to MOVE/TRANSFER Furniture/Equipment</p>
                </div>

                <div class="flex justify-between mt-4">
                    <p>Event Date: <strong>{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</strong></p>
                    <p>Event Title: <strong>{{ $event->tags }}</strong></p>
                </div>

                <div class="flex justify-between mt-4">
                    <p>Requested By: <strong>{{ auth()->user()->fname }} {{ auth()->user()->lname }}</strong></p>
                    <p>College/Org: <strong>{{ auth()->user()->org }}</strong></p>
                </div>
            </div>

            {{-- Letter Body --}}
            <div class="mb-6">
                <p>Dear Sir/Madam,</p>

                <p class="mt-4">
                    I would like to request the following equipment to be transferred for the event entitled 
                    <strong>{{ $event->tags }}</strong>. The details are as follows:
                </p>
            </div>

            {{-- Equipment Table --}}
            <table class="min-w-full bg-white border mt-4 mb-6 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left border">Quantity</th>
                        <th class="px-4 py-2 text-left border">Item Description</th>
                        <th class="px-4 py-2 text-left border">Date of Transfer</th>
                        <th class="px-4 py-2 text-left border">From</th>
                        <th class="px-4 py-2 text-left border">To</th>
                        <th class="px-4 py-2 text-left border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="border-t">

                            <td class="px-4 py-2 border">
                                {{ is_array(json_decode($request->quantity, true)) ? implode(', ', json_decode($request->quantity, true)) : ($request->quantity ?? 'N/A') }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ is_array(json_decode($request->equipment, true)) ? implode(', ', json_decode($request->equipment, true)) : ($request->equipment ?? 'N/A') }}
                            </td>
                            
                            <td class="px-4 py-2 border">{{ $request->date_transfer ?? 'N/A' }}</td>
                            
                            <td class="px-4 py-2 border">{{ $request->from ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $request->to ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $request->status ?? 'Pending' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500 border">No requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Closing --}}
            <div class="mt-6">
                <p>Thank you very much for your kind consideration. I hope for your approval of this request.</p>
               
                <p class="mt-6 font-semibold">{{ $request->status ?? 'Pending' }}</p>
                <p>Spmo Office</p>
            </div>

        </div>
    </div>
    </div>
    <script>
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;
    
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // optional: reload to restore event listeners and state
        }
    </script>
    
</x-ufmo-layout>
