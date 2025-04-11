<x-admin-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">USC Approved Requests</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Event Name</th>
                        <th class="px-6 py-3 text-left">Organizer</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($approvals as $approval)
                        <tr>
                            <td class="px-6 py-4">{{ $approval->id }}</td>
                            <td class="px-6 py-4">{{ $approval->listing->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                {{ $approval->user->fname ?? '' }} {{ $approval->user->lname ?? '' }}
                            </td>
                            <td class="px-6 py-4">{{ $approval->status }}</td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
