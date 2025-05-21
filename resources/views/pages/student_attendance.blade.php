<x-layout>
    <div class="max-w-4xl mx-auto px-4 pt-28 py-6">

         <div class="mb-6">
        <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back
        </a>
    </div>
        <!-- Filters -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-4 md:space-y-0 md:space-x-4">
            <form method="GET" action="{{ route('pages.student_attendance') }}" class="flex flex-wrap gap-3 items-center w-full md:w-auto">
                <!-- Organization Filter -->
                <select name="organization" onchange="this.form.submit()" class="border-gray-300 rounded px-3 py-2 shadow-sm focus:ring focus:border-blue-300">
                    <option value="">All Organizations</option>
                    @foreach ($organizations as $org)
                        <option value="{{ $org }}" {{ request('organization') == $org ? 'selected' : '' }}>{{ $org }}</option>
                    @endforeach
                </select>

                <!-- Search Bar -->
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search event title..." 
                    value="{{ request('search') }}" 
                    class="border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Search
                </button>
            </form>
        </div>

        <!-- Listings Table -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-2 font-medium">ID</th>
                        <th class="px-4 py-2 font-medium">Title</th>
                        <th class="px-4 py-2 font-medium">Organization</th>
                        <th class="px-4 py-2 font-medium">Tags</th>
                        <th class="px-4 py-2 font-medium">Date</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($listings as $listing)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $listing->id }}</td>
                            <td class="px-4 py-2">{{ $listing->title }}</td>
                            <td class="px-4 py-2">{{ $listing->organization }}</td>
                            <td class="px-4 py-2">{{ $listing->tags }}</td>
                            <td class="px-4 py-2">{{ $listing->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('attendees.view', $listing->id) }}" 
                                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    View 
                                </a>
                            </td> <!-- View Attendees button -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-4 py-6 text-gray-500">No listings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bottom -->
        <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
            <div>
                Showing page {{ $listings->currentPage() }} of {{ $listings->lastPage() }}
            </div>
            <div>
                {{ $listings->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-layout>
