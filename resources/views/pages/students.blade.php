<x-layout>

    @include('partials._facility')
    @section('content')
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">View Students</h2>

        <!-- Filters -->
        <div class="mb-6 p-4 border rounded bg-gray-100">
            <label for="filter_organization" class="block text-gray-700 font-bold">Select Organization:</label>
            <select id="filter_organization" class="w-full p-2 border rounded">
                <option value="">-- Select Organization --</option>
                @foreach($organizations as $org)
                    <option value="{{ $org->orgNameAbbv }}">{{ $org->orgNameAbbv }}</option>
                @endforeach
            </select>

            <label for="filter_year" class="block text-gray-700 font-bold mt-4">Select Year Level:</label>
            <select id="filter_year" class="w-full p-2 border rounded">
                <option value="">-- Select Year Level --</option>
                @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'] as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>

            <label for="filter_section" class="block text-gray-700 font-bold mt-4">Select Section:</label>
            <select id="filter_section" class="w-full p-2 border rounded">
                <option value="">-- Select Section --</option>
            </select>
        </div>

        <!-- Students Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">First Name</th>
                        <th class="border p-2">Last Name</th>
                    </tr>
                </thead>
                <tbody id="students_table">
                    <!-- Students will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('filter_organization').addEventListener('change', fetchSections);
        document.getElementById('filter_year').addEventListener('change', fetchSections);
        document.getElementById('filter_section').addEventListener('change', fetchStudents);

        function fetchSections() {
            let organization = document.getElementById('filter_organization').value;
            let yearLevel = document.getElementById('filter_year').value;

            if (organization && yearLevel) {
                fetch(`/sections/filter?organization=${organization}&year_level=${yearLevel}`)
                    .then(response => response.json())
                    .then(data => {
                        let sectionDropdown = document.getElementById('filter_section');
                        sectionDropdown.innerHTML = '<option value="">-- Select Section --</option>';
                        data.forEach(section => {
                            sectionDropdown.innerHTML += `<option value="${section.section_name}">${section.section_name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching sections:', error));
            }
        }

        function fetchStudents() {
            let organization = document.getElementById('filter_organization').value;
            let yearLevel = document.getElementById('filter_year').value;
            let section = document.getElementById('filter_section').value;

            fetch(`/students/filter?organization=${organization}&year_level=${yearLevel}&section=${section}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('students_table');
                    tableBody.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(student => {
                            let row = `<tr>
                                <td class="border p-2">${student.fname}</td>
                                <td class="border p-2">${student.lname}</td>
                            </tr>`;
                            tableBody.innerHTML += row;
                        });
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="2" class="text-center p-2">No students found</td></tr>';
                    }
                })
                .catch(error => console.error('Error fetching students:', error));
        }
    </script>
</x-layout>
