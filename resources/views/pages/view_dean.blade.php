<x-layout>

    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-xl font-bold"> Requests for: {{ $event->tags }}</h2>

<table class="min-w-full bg-white border mt-4">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 text-left">Adviser Name</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($requests as $request)
        <tr class="border-t">
            <td class="px-4 py-2">
                {{ $request->dean->fname ?? 'N/A' }} {{ $request->dean->lname ?? '' }}
            </td>
            <td class="px-4 py-2">
                {{ $request->dean->email ?? 'N/A' }}
            </td>
            <td class="px-4 py-2">
                {{ $request->status ?? 'N/A' }}
            </td>
        </tr>
    @empty
            <tr>
                <td colspan="2" class="text-center py-4 text-gray-500">No  requests found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
</div>

</x-layout>