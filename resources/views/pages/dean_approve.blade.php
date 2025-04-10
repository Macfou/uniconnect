<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">

        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>
        <h2 class="text-2xl font-semibold mb-4">Approved Event Requests</h2>

        <table class="w-full text-sm text-left border border-gray-300 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Requested By</th>
                    <th class="px-6 py-3">Event Title</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($approvedRequests as $request)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $request->user->fname ?? 'N/A' }} {{ $request->user->lname ?? '' }}</td>
                        <td class="px-6 py-4">{{ $request->listing->tags ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-green-600 font-semibold">{{ $request->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No approved requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
