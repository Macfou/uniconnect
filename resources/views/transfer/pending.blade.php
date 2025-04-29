<x-spmo_layout>
    <div class="p-6">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Pending Permit Transfer Requests</h2>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">To Transfer</th>
                        <th class="px-6 py-3 text-left">From</th>
                        <th class="px-6 py-3 text-left">To</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($requests as $req)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">{{ $req->id }}</td>
                            <td class="px-6 py-4">
                                {{ $req->user->lname ?? 'Unknown' }} {{ $req->user->fname ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4">{{ $req->equipment }}</td>
                            <td class="px-6 py-4">{{ $req->from }}</td>
                            <td class="px-6 py-4">{{ $req->to }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <form method="POST" action="{{ route('permit.updateStatus', ['id' => $req->id, 'status' => 'Approved']) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                        Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('permit.updateStatus', ['id' => $req->id, 'status' => 'Rejected']) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
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
