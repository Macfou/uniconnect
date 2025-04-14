<x-ufmo-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-semibold">Approval Status for Event: {{ $listing->event_name }}</h1>

        <div class="mt-4">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border-b">Approval </th>
                        <th class="p-2 border-b">Status</th>
                        
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border-b">Adviser Approval</td>
                        <td class="p-2 border-b 
                            {{ $adviserStatus == 'Approve' ? 'text-green-500' : 
                            ($adviserStatus == 'Reject' ? 'text-red-500' : 'text-yellow-500') }}">
                            {{ $adviserStatus ?? 'Pending' }}
                        </td>
                
                    </tr>
                    <tr>
                        <td class="p-2 border-b">Dean Approval</td>
                        <td class="p-2 border-b 
                            {{ $deanStatus == 'Approve' ? 'text-green-500' : 
                            ($deanStatus == 'Reject' ? 'text-red-500' : 'text-yellow-500') }}">
                            {{ $deanStatus ?? 'Pending' }}
                        </td>
                       
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('ufmo.ufmo_pages.ufmo_pending') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">Back</a>
        </div>
    </div>
</x-ufmo-layout>
