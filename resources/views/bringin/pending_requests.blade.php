<x-spmo_layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Pending Bring-In Requests</h2>

        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Item</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $request->user->lname ?? 'N/A' }} {{ $request->user->fname ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            @if(is_array($request->equipment))
                                {{ implode(', ', $request->equipment) }}
                            @else
                                {{ $request->equipment }}
                            @endif
                        </td>
                        
                        
                        <td class="px-4 py-2">{{ $request->status }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('bringin.updateStatus', $request->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Approved">
                                <button class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                            </form>
                            <form action="{{ route('bringin.updateStatus', $request->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="Rejected">
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-spmo_layout>
