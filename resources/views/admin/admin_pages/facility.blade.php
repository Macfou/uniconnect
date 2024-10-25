<x-admin-layout>
    @section('content')
    <div>
        <h1>Manage Facilities</h1>

        <!-- Add Facility Form -->
        <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="facilityName" placeholder="Facility Name" required>
            <input type="file" name="facilityImage" required>
            <input type="number" name="facilityCapacity" max="10000" required>
            <button type="submit">Add Facility</button>
        </form>

        <h2>Existing Facilities</h2>
        <ul>
            @forelse($facilities as $facility)
                <li>
                    {{ $facility->facilityName }}
                    <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    <a href="{{ route('facilities.edit', $facility->id) }}">Edit</a>
                </li>
            @empty
                <li>No facilities found</li>
            @endforelse
        </ul>
    </div>
    @endsection
</x-admin-layout>