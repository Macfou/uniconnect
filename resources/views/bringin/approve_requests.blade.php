<x-spmo_layout>
    <div class="p-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Approved Bring-In Requests</h2>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Item</th>
                        <th class="px-6 py-3 text-left">Quantity</th>
                        <th class="px-6 py-3 text-left">Purpose</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($requests as $request)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $request->user->lname ?? 'N/A' }} {{ $request->user->fname ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                @if(is_array($request->equipment))
                                    {{ implode(', ', $request->equipment) }}
                                @else
                                    {{ $request->equipment }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $quantities = is_array($request->quantity)
                                        ? $request->quantity
                                        : json_decode($request->quantity, true);
                                @endphp
                                {{ is_array($quantities) ? implode(', ', $quantities) : ($quantities ?? 'N/A') }}
                            </td>
                            <td class="px-6 py-4">For Event</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 text-sm rounded-full
                                    {{ $request->status === 'Approved' ? 'bg-green-100 text-green-800' : ($request->status === 'Rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $request->status }}
                                </span>
                            </td>
                          
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">No pending requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-spmo_layout>
