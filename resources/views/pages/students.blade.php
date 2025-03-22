<x-layout>
    @include('partials._faculty')

    @section('content')
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg max-w-3xl">
        <h2 class="text-2xl font-bold mb-4">Manage Sections & Students</h2>

        <!-- Button to Open Modal -->
        <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Select Section
        </button>

        <!-- Modal for Selecting Section -->
        <div id="sectionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-1/3">
                <h2 class="text-xl font-bold mb-4">Select Section</h2>

                <label class="block text-gray-700 font-bold">Organization:</label>
                <select id="modal_filter_organization" class="w-full p-2 border rounded">
                    <option value="">-- Select Organization --</option>
                    @foreach($organizations as $org)
                        <option value="{{ $org->id }}">{{ $org->orgNameAbbv }}</option>
                    @endforeach
                </select>

                <label class="block text-gray-700 font-bold mt-2">Year Level:</label>
                <select id="modal_filter_year" class="w-full p-2 border rounded">
                    <option value="">-- Select Year Level --</option>
                    @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'] as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

                <label class="block text-gray-700 font-bold mt-2">Section:</label>
                <select id="modal_filter_section" class="w-full p-2 border rounded">
                    <option value="">-- Select Section --</option>
                </select>

                <div class="flex justify-between mt-4">
                    <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button onclick="saveSection()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Save Section
                    </button>
                </div>
            </div>
        </div>

        <!-- Table to Display Saved Sections -->
        <div class="mt-6">
            <h3 class="text-lg font-bold mb-2">Saved Sections</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Organization</th>
                        <th class="border p-2">Year Level</th>
                        <th class="border p-2">Section</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="saved_sections_table">
                    <!-- Saved sections will be displayed here -->
                </tbody>
            </table>
        </div>

        <!-- Table to Display Students -->
        <div id="students_section" class="mt-6 hidden">
            <h3 class="text-lg font-bold mb-2">Students in Section</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">First Name</th>
                        <th class="border p-2">Last Name</th>
                    </tr>
                </thead>
                <tbody id="students_table">
                    <!-- Students will be displayed here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let savedSections = [];

        function openModal() {
            document.getElementById('sectionModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('sectionModal').classList.add('hidden');
        }

        function fetchSections() {
            let organization = document.getElementById('modal_filter_organization').value;
            let yearLevel = document.getElementById('modal_filter_year').value;

            if (organization && yearLevel) {
                fetch(`/sections/filter?organization=${organization}&year_level=${yearLevel}`)
                    .then(response => response.json())
                    .then(data => {
                        let sectionDropdown = document.getElementById('modal_filter_section');
                        sectionDropdown.innerHTML = '<option value="">-- Select Section --</option>';
                        data.forEach(section => {
                            sectionDropdown.innerHTML += `<option value="${section.section_name}">${section.section_name}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching sections:', error));
            }
        }

        document.getElementById('modal_filter_organization').addEventListener('change', fetchSections);
        document.getElementById('modal_filter_year').addEventListener('change', fetchSections);

        function saveSection() {
            let organization = document.getElementById('modal_filter_organization').value;
            let orgText = document.getElementById('modal_filter_organization').selectedOptions[0].text;
            let yearLevel = document.getElementById('modal_filter_year').value;
            let section = document.getElementById('modal_filter_section').value;

            if (organization && yearLevel && section) {
                savedSections.push({ organization, orgText, yearLevel, section });
                updateSectionsTable();
                closeModal();
            } else {
                alert("Please select all fields.");
            }
        }

        function updateSectionsTable() {
            let tableBody = document.getElementById('saved_sections_table');
            tableBody.innerHTML = '';

            savedSections.forEach((sec, index) => {
                tableBody.innerHTML += `
                    <tr>
                        <td class="border p-2">${sec.orgText}</td>
                        <td class="border p-2">${sec.yearLevel}</td>
                        <td class="border p-2">${sec.section}</td>
                        <td class="border p-2">
                            <button onclick="viewStudents(${index})" class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700">View</button>
                            <button onclick="removeSection(${index})" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button>
                        </td>
                    </tr>
                `;
            });
        }

        function removeSection(index) {
            savedSections.splice(index, 1);
            updateSectionsTable();
            document.getElementById('students_section').classList.add('hidden');
        }

        function viewStudents(index) {
            let sec = savedSections[index];

            fetch(`/pages/students/filter?organization=${sec.organization}&year_level=${sec.yearLevel}&section=${sec.section}`)
                .then(response => response.json())
                .then(data => {
                    let studentsTable = document.getElementById('students_table');
                    studentsTable.innerHTML = '';

                    data.forEach(student => {
                        studentsTable.innerHTML += `
                            <tr>
                                <td class="border p-2">${student.fname}</td>
                                <td class="border p-2">${student.lname}</td>
                            </tr>
                        `;
                    });

                    document.getElementById('students_section').classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching students:', error));
        }
    </script>
</x-layout>
