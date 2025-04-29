<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-4xl mx-auto leading-relaxed font-serif">

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

        <div id="printArea" class="bg-white shadow-lg rounded-lg p-10">

            {{-- Letter Header --}}
            <div class="text-center mb-6">
                <p class="text-lg font-bold">University of Makati</p>
                <p class="font-medium">{{ auth()->user()->org }}</p>
                <p class="mt-2">Request for Adviser Approval</p>
            </div>

            {{-- Letter Body --}}
            <p>Dear {{ $requests->first()->adviser->fname ?? 'Adviser' }} {{ $requests->first()->adviser->lname ?? '' }},</p>

            <p class="mt-4">
                I hope this message finds you well. On behalf of <strong>{{ auth()->user()->org }}</strong>, we are requesting your approval to conduct the event titled <strong>{{ $event->tags }}</strong>. The event is part of our organizational goals to promote student engagement and development.
            </p>

            <p class="mt-4">
                Date and Time: <strong>{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
                    {{ $event->event_time }}</strong>
            </p>

            
            <p class="mt-4">
                Venue: <strong>{{ $event->venue }} </strong>
            </p>

            {{-- Request Table --}}
            <table class="min-w-full bg-white border mt-4 mb-6 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left border">Adviser Name</th>
                        <th class="px-4 py-2 text-left border">Email</th>
                        <th class="px-4 py-2 text-left border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="border-t">
                            <td class="px-4 py-2 border">{{ $request->adviser->fname ?? 'N/A' }} {{ $request->adviser->lname ?? '' }}</td>
                            <td class="px-4 py-2 border">{{ $request->adviser->email ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $request->status ?? 'Pending' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500 border">No adviser requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Closing --}}
            <p class="mt-4">
                We respectfully seek your approval and guidance in conducting this event. Should you have any concerns or recommendations, please feel free to reach out.
            </p>

            <p class="mt-6">Sincerely,</p>
            <p class="mt-1 font-semibold">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</p>
            <p>{{ auth()->user()->org }}</p>
        </div>
    </div>

    {{-- Print Script --}}
    <script>
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
</x-layout>
