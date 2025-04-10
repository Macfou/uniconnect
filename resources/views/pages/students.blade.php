<x-layout>
    @include('partials._faculty')

    @section('content')
    <div class="container mx-auto p-6 pt-20 bg-white shadow-md rounded-lg w-1/2">

        <!-- Top Buttons -->
        <div class="flex justify-between items-center mb-4">
            <button onclick="toggleSavedSections()" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                View Saved Sections
            </button>

            <button onclick="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Section
            </button>
        </div>

        <!-- Modal -->
        <div id="sectionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Select Section</h2>

                <label class="block text-gray-700 font-bold">Organization:</label>
                <select id="modal_filter_organization" class="w-full p-2 border rounded mb-2">
                    <option value="">-- Select Organization --</option>
                    @foreach($organizations as $org)
                        <option value="{{ $org->id }}">{{ $org->orgNameAbbv }}</option>
                    @endforeach
                </select>

                <label class="block text-gray-700 font-bold">Year Level:</label>
                <select id="modal_filter_year" class="w-full p-2 border rounded mb-2">
                    <option value="">-- Select Year Level --</option>
                    @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'] as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>

                <label class="block text-gray-700 font-bold">Section:</label>
                <select id="modal_filter_section" class="w-full p-2 border rounded mb-4">
                    <option value="">-- Select Section --</option>
                </select>

                <div class="flex justify-between">
                    <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button onclick="saveSection()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Save Section
                    </button>
                </div>
            </div>
        </div>
        <div id="saved_sections_wrapper" class="mt-6">
            <h3 class="text-xl font-semibold mb-3">Saved Sections</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Organization</th>
                        <th class="border p-2">Year</th>
                        <th class="border p-2">Section</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($savedSections as $savedSection)
                        <tr>
                            <td class="border p-2">{{ $savedSection->organization->orgNameAbbv }}</td>
                            <td class="border p-2">{{ $savedSection->year_level }}</td>
                            <td class="border p-2">{{ $savedSection->section_name }}</td>
                            <td class="border p-2">
                                <button onclick="viewStudents('{{ $savedSection->organization->orgNameAbbv }}', '{{ $savedSection->year_level }}', '{{ $savedSection->section_name }}')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    View Students
                                </button>
                            </td>
                        </tr>
                        <tr id="students_{{ $savedSection->section_name }}" class="hidden">
                            <td colspan="4">
                                <div id="students_list_{{ $savedSection->section_name }}"></div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
        
        
    
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

        function toggleSavedSections() {
            const wrapper = document.getElementById('saved_sections_wrapper');
            wrapper.classList.toggle('hidden');
        }

        function fetchSections() {
            const org = document.getElementById('modal_filter_organization').value;
            const year = document.getElementById('modal_filter_year').value;

            if (org && year) {
                fetch(`/sections/filter?organization=${org}&year_level=${year}`)
                    .then(res => res.json())
                    .then(data => {
                        const sectionDropdown = document.getElementById('modal_filter_section');
                        sectionDropdown.innerHTML = '<option value="">-- Select Section --</option>';
                        data.forEach(sec => {
                            sectionDropdown.innerHTML += `<option value="${sec.section_name}">${sec.section_name}</option>`;
                        });
                    })
                    .catch(err => console.error('Section fetch error:', err));
            }
        }

        document.getElementById('modal_filter_organization').addEventListener('change', fetchSections);
        document.getElementById('modal_filter_year').addEventListener('change', fetchSections);

        function saveSection() {
            const org = document.getElementById("modal_filter_organization").value;
            const year = document.getElementById("modal_filter_year").value;
            const section = document.getElementById("modal_filter_section").value;

            if (!org || !year || !section) {
                alert("Please complete all fields.");
                return;
            }

            fetch("{{ route('saved-sections.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({
                    organization_id: org,
                    year_level: year,
                    section_name: section,
                }),
            })
            .then(res => res.json())
            .then(data => {
                alert("Section saved!");
                location.reload();
            })
            .catch(err => {
                console.error("Save section error:", err);
                alert("Failed to save section.");
            });
        }

        function viewStudents(organization, yearLevel, sectionName) {
    fetch(`/students?organization=${encodeURIComponent(organization)}&yearLevel=${encodeURIComponent(yearLevel)}&sectionName=${encodeURIComponent(sectionName)}`)
        .then(response => response.text())
        .then(data => {
            const studentsRow = document.getElementById(`students_${sectionName}`);
            const studentsList = document.getElementById(`students_list_${sectionName}`);
            studentsList.innerHTML = data;
            studentsRow.classList.remove('hidden');
        })
        .catch(error => console.error('Error fetching student data:', error));
}

    </script>
</x-layout>
