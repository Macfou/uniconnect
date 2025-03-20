<x-admin-layout>
    @section('content')
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Sections by Organization & Year Level</h2>

        <!-- Filter Sections -->
        <div class="mb-6 p-4 border rounded bg-gray-100">
            <label for="filter_organization" class="block text-gray-700 font-bold">Select Organization:</label>
            <select id="filter_organization" class="w-full p-2 border rounded">
                <option value="">-- Select Organization --</option>
                @foreach($organizations as $org)
                    <option value="{{ $org->id }}">{{ $org->orgNameAbbv }}</option>
                @endforeach
            </select>

            <label for="filter_year" class="block text-gray-700 font-bold mt-4">Select Year Level:</label>
            <select id="filter_year" class="w-full p-2 border rounded">
                <option value="">-- Select Year Level --</option>
                @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'] as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sections Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Section Name</th>
                        <th class="border p-2">Year Level</th>
                        <th class="border p-2">Classification</th>
                    </tr>
                </thead>
                <tbody id="sections_table">
                    <!-- Sections will be loaded here -->
                </tbody>
            </table>
        </div>

        <hr class="my-6">

        <!-- Add Section Form -->
        <h2 class="text-2xl font-bold mb-4">Add Section to Organization</h2>
        <form action="{{ route('section.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="organization" class="block text-gray-700 font-bold">Select Organization:</label>
                <select name="organization_id" id="organization" class="w-full p-2 border rounded">
                    <option value="">-- Select Organization --</option>
                    @foreach($organizations as $org)
                        <option value="{{ $org->id }}">{{ $org->orgNameAbbv }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="section_name" class="block text-gray-700 font-bold">Section Name:</label>
                <input type="text" name="section_name" id="section_name" class="w-full p-2 border rounded" placeholder="Enter Section Name">
            </div>

            <div class="mb-4">
                <label for="classification" class="block text-gray-700 font-bold">Classification (Optional):</label>
                <input type="text" name="classification" id="classification" class="w-full p-2 border rounded" placeholder="Enter Classification">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Select Year Levels:</label>
                <div class="flex flex-wrap gap-3">
                    @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'] as $year)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="year_levels[]" value="{{ $year }}" class="mr-2">
                            {{ $year }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Add Section
            </button>
        </form>
    </div>

    <!-- JavaScript to Fetch Sections Dynamically -->
    <script>
        document.getElementById('filter_organization').addEventListener('change', fetchSections);
        document.getElementById('filter_year').addEventListener('change', fetchSections);

        function fetchSections() {
            let organizationId = document.getElementById('filter_organization').value;
            let yearLevel = document.getElementById('filter_year').value;

            fetch(`/sections/filter?organization_id=${organizationId}&year_level=${yearLevel}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('sections_table');
                    tableBody.innerHTML = '';
                    
                    if (data.length > 0) {
                        data.forEach(section => {
                            let row = `<tr>
                                <td class="border p-2">${section.section_name}</td>
                                <td class="border p-2">${section.year_level}</td>
                                <td class="border p-2">${section.classification ? section.classification : 'N/A'}</td>
                            </tr>`;
                            tableBody.innerHTML += row;
                        });
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="3" class="text-center p-2">No sections found</td></tr>';
                    }
                })
                .catch(error => console.error('Error fetching sections:', error));
        }
    </script>

</x-admin-layout>
