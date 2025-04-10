<div class="max-w-6xl mx-auto p-4">
    <div class="flex flex-col md:flex-row justify-between mb-4 gap-4">
        <!-- Organization Filter -->
        <select wire:model="organization" class="border px-3 py-2 rounded shadow-sm w-full md:w-auto">
            <option value="">All Organizations</option>
            @foreach ($organizations as $org)
                <option value="{{ $org }}">{{ $org }}</option>
            @endforeach
        </select>

        <!-- Search -->
        <input wire:model.debounce.300ms="search" type="text" placeholder="Search event title..." 
               class="border px-3 py-2 rounded shadow-sm w-full md:w-1/2">
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Organization</th>
                    <th class="px-4 py-2">Tags</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($listings as $listing)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $listing->id }}</td>
                        <td class="px-4 py-2">{{ $listing->title }}</td>
                        <td class="px-4 py-2">{{ $listing->organization }}</td>
                        <td class="px-4 py-2">{{ $listing->tags }}</td>
                        <td class="px-4 py-2">{{ $listing->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-4 py-6 text-gray-500">No listings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $listings->links() }}
    </div>
</div>
