<x-layout>

    @include('partials._myevents')

    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-6">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
            <h2 class="text-xl font-semibold mb-4 text-center">Upload Multiple Certificates</h2>

            @if(session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('certificate.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label class="block mb-2 font-medium">Select Event:</label>
                <select name="event_id" class="w-full border p-2 rounded" required>
                    <option value="">-- Select Event --</option>
                    @foreach(App\Models\Listing::all() as $event)
                        <option value="{{ $event->id }}">{{ $event->tags }}</option>
                    @endforeach
                </select>
                @error('event_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <label class="block mt-4 font-medium">Upload Certificates:</label>
                <input type="file" name="certificates[]" class="w-full border p-2 rounded" multiple required>
                @error('certificates.*') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded w-full">Upload</button>
            </form>
        </div>

        {{-- Select Event to View Certificates --}}
        <div class="mt-8 w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-center">View Uploaded Certificates</h2>

            <form id="eventForm" method="GET" action="{{ route('certificate') }}">
                <label class="block mb-2 font-medium">Choose Event:</label>
                <select name="selected_event" id="selected_event" class="w-full border p-2 rounded">
                    <option value="">-- Select Event --</option>
                    @foreach(App\Models\Listing::all() as $event)
                        <option value="{{ $event->id }}" {{ request('selected_event') == $event->id ? 'selected' : '' }}>
                            {{ $event->tags }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded w-full">View Certificates</button>
            </form>
        </div>

        {{-- Certificate Table (Only if Event is Selected) --}}
        @if(request('selected_event'))
            <div class="mt-8 w-full max-w-4xl bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-center">Uploaded Certificates</h2>

                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">#</th>
                            <th class="border border-gray-300 px-4 py-2">Certificate</th>
                            <th class="border border-gray-300 px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certificates as $index => $certificate)
                            <tr class="text-center">
                                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="{{ asset('storage/certificates/' . $certificate->filename) }}" target="_blank" class="text-blue-500">View</a>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <form action="{{ route('certificate.destroy', $certificate->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if($certificates->isEmpty())
                            <tr>
                                <td colspan="3" class="border border-gray-300 px-4 py-2 text-center text-gray-500">No certificates uploaded for this event.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endif

    </div>

</x-layout>
