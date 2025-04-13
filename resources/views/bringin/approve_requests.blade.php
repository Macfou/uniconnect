<x-spmo_layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Approved Bring-In Requests</h2>

        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Item</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $request->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $request->item_name }}</td>
                        <td class="px-4 py-2">{{ $request->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-spmo_layout>
