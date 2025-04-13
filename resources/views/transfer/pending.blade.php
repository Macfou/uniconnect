<x-spmo_layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Pending Permit Transfer Requests</h2>
        <table class="w-full table-auto border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">ID</th>
                    <th class="p-2">User</th>
                    <th class="p-2">To Transfer</th>
                    <th class="p-2">From</th>
                    <th class="p-2">To </th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $req)
                    <tr class="border">
                        <td class="p-2">{{ $req->id }}</td>
                        <td class="p-2">{{ $req->user->lname ?? 'Unknown' }} {{ $req->user->fname ?? 'Unknown' }}</td>
                        <td class="p-2">{{ $req->equipment }}</td>
                        <td class="p-2">{{ $req->from }}</td>
                        <td class="p-2">{{ $req->to }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('permit.updateStatus', ['id' => $req->id, 'status' => 'Approved']) }}" class="inline">
                                @csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('permit.updateStatus', ['id' => $req->id, 'status' => 'Rejected']) }}" class="inline">
                                @csrf
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-spmo_layout>
