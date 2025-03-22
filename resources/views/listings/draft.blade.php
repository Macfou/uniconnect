<x-layout>
    @include('partials._myevents')

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Draft Events</h1>

        <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
            @if($drafts->isEmpty())
                <p class="text-gray-600 text-center">No draft events found.</p>
            @else
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Title</th>
                            <th class="border border-gray-300 px-4 py-2">Organization</th>
                            <th class="border border-gray-300 px-4 py-2">Date</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drafts as $draft)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $draft->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $draft->organization }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $draft->event_date }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('listings.show', $draft->id) }}" 
                                       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        View
                                    </a>
                                    <a href="{{ route('listings.edit', $draft->id) }}" 
                                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('listings.destroy', $draft->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                                onclick="return confirm('Are you sure you want to delete this draft?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-layout>
