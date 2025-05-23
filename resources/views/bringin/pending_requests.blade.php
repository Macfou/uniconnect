<x-spmo_layout>
    <div class="p-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Pending Bring-In Requests</h2>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">College</th>
                        
                        <th class="px-6 py-3 text-left">Request</th>
                        
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($requests as $request)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $request->user->lname ?? 'N/A' }} {{ $request->user->fname ?? 'N/A' }}
                            </td>
                           
                            <td class="px-6 py-4">
                                {{ $request->user->org ?? 'N/A' }} 
                            </td>

                          
                                
                                <td class="px-6 py-4">
                                    <a href="{{ route('view_bringin_spmo', $request->listings_id) }}" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                        View Requests
                                     </a>
                                </td>
                          

                            <td class="px-6 py-4 space-x-2">
                                <form action="{{ route('bringin.updateStatus', $request->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="Approved">
                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('bringin.updateStatus', $request->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                        Reject
                                    </button>
                                </form>
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
