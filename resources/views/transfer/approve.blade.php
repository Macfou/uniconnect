<x-spmo_layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Approved Permit Transfer Requests</h2>
        <table class="w-full table-auto border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">ID</th>
                    <th class="p-2">User</th>
                    <th class="p-2">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $req)
                    <tr class="border">
                        <td class="p-2">{{ $req->id }}</td>
                        <td class="p-2">{{ $req->user->name ?? 'Unknown' }}</td>
                        <td class="p-2">{{ $req->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-spmo_layout>
