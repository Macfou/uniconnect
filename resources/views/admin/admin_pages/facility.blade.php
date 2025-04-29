<x-ufmo-layout>

    <div class="capitalize pb-10">
        <nav aria-label="breadcrumb" class="w-max">
          <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
            <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
              <a href="#">
                <p class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">UFMO</p>
              </a>
              <span class="text-gray-500 text-sm antialiased font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
            </li>
            <li class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Facility</h6>
            </li>
          </ol>
        </nav>
        
      </div>

    <div class="relative flex flex-col w-full h-full text-slate-700  bg-white mx-w-lg shadow-md rounded-xl">
        <div class="relative mx-4 mt-4 flex justify-between items-center">
            <!-- Left Side: University Facility Title -->
            <h3 class="text-lg font-bold text-slate-800">University Facility</h3>
        
            <!-- Right Side: Add Facility Button -->
            <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                <a href="#addFacilityModal"
                   class="flex select-none items-center gap-2 rounded bg-laravel py-2.5 px-4 text-xs font-semibold text-white shadow-md shadow-slate-900/10 transition-all hover:shadow-lg hover:shadow-slate-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                   type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                         stroke-width="2" class="w-4 h-4">
                        <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                    </svg>
                    Add Facility
                </a>
            </div>
        </div>
        

        <!-- Facility Table -->
        <table class="w-full mt-4 text-left table-auto border border-slate-200 rounded-lg">
            <thead class="bg-slate-50">
                <tr>
                    <th class="p-4 border-b border-slate-200">Facility Name</th>
                    <th class="p-4 border-b border-slate-200">Description</th>
                    <th class="p-4 border-b border-slate-200">Sitting Capacity</th>
                    <th class="p-4 border-b border-slate-200">Classification</th>
                    <th class="p-4 border-b border-slate-200">Status</th>
                    <th class="p-4 border-b border-slate-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facilities as $facility)
                    <tr class="hover:bg-slate-100">
                        <td class="p-4 border-b">{{ $facility->facility_name }}</td>
                        <td class="p-4 border-b">{{ $facility->description }}</td>
                        <td class="p-4 border-b">{{ $facility->sitting_capacity }}</td>
                        <td class="p-4 border-b">{{ implode(', ', json_decode($facility->classification, true)) }}</td>
                        <td class="p-4 border-b">
                            <button onclick="toggleStatus({{ $facility->id }})"
                                class="px-4 py-2 rounded text-white {{ $facility->status == 'Available' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $facility->status }}
                            </button>
                            <script>
                                function toggleStatus(id) {
                                    fetch(`/facility/${id}/toggle-status`, {
                                        method: "PUT",
                                        headers: {
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                            "Content-Type": "application/json"
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            location.reload(); // Refresh page to show updated status
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                                }
                                </script>
                        </td>
                        <td class="p-4 border-b">
                            <!-- Edit Button -->
                            <button
                            class="text-blue-600 hover:underline"
                            onclick="location.href='#editFacilityModal-{{ $facility->id }}'">
                            Edit
                        </button>

                             <!-- Edit Facility Modal -->
    <div id="editFacilityModal-{{ $facility->id }}" class="modal hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-lg font-bold mb-4">Edit Facility</h2>
            <a href="#" class="close">&times;</a>
            <form action="{{ route('admin.admin_pages.facility.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium">Facility Name</label>
                    <input type="text" name="facility_name" value="{{ $facility->facility_name }}" class="w-full border p-2 rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="description" class="w-full border p-2 rounded-lg">{{ $facility->description }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Sitting Capacity</label>
                    <input type="number" name="sitting_capacity" value="{{ $facility->sitting_capacity }}" class="w-full border p-2 rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Image</label>
                    <input type="file" name="image" class="w-full border p-2 rounded-lg">
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <a href="#" class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>
                            
                            <!-- Delete Button -->
                            <a href="#deleteFacilityModal-{{ $facility->id }}"
                                class="text-red-600 hover:text-red-800 ml-4">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Facility Modal -->
    <div id="addFacilityModal" class="modal">
        <div class="modal-content">
            <a href="#" class="close">&times;</a>
            <h2 class="text-lg font-bold mb-4">Add Facility</h2>
            <form action="{{ route('admin.admin_pages.facility.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium">Facility Name</label>
                    <input type="text" name="facility_name" class="w-full border border-slate-300 rounded-lg p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="description" class="w-full border border-slate-300 rounded-lg p-2"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Image</label>
                    <input type="file" name="image" class="w-full border border-slate-300 rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium">Sitting Capacity</label>
                    <input type="number" name="sitting_capacity" class="w-full border border-slate-300 rounded-lg p-2" required>
                </div>
                <!-- Classification Dropdown -->
                <div>
                    <label class="block text-sm font-medium">Classification</label>
                    <div class="relative">
                        
                        <button type="button" id="classificationDropdownButton" class="w-full border border-slate-300 rounded-lg p-2 bg-white text-left">
                            Select Classification
                        </button>
                        <div id="classificationDropdown" class="absolute hidden bg-white border border-slate-300 rounded-lg w-full mt-1 shadow-lg p-2 z-10">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="classification[]" value="University Event" class="classification-checkbox">
                                <span>University Event</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="classification[]" value="Class Events" class="classification-checkbox">
                                <span>Class Events</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="classification[]" value="College Events" class="classification-checkbox">
                                <span>College Events</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="classification[]" value="Organization Events" class="classification-checkbox">
                                <span>Organization Events</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="classification[]" value="Sports Events" class="classification-checkbox">
                                <span>Sports Events</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const dropdownButton = document.getElementById("classificationDropdownButton");
                    const dropdown = document.getElementById("classificationDropdown");
                    const checkboxes = document.querySelectorAll(".classification-checkbox");
                
                    dropdownButton.addEventListener("click", function () {
                        dropdown.classList.toggle("hidden");
                    });
                
                    document.addEventListener("click", function (event) {
                        if (!dropdown.contains(event.target) && event.target !== dropdownButton) {
                            dropdown.classList.add("hidden");
                        }
                    });
                
                    checkboxes.forEach((checkbox) => {
                        checkbox.addEventListener("change", function () {
                            let selected = Array.from(checkboxes)
                                .filter((cb) => cb.checked)
                                .map((cb) => cb.value);
                            dropdownButton.textContent = selected.length ? selected.join(", ") : "Select Classification";
                        });
                    });
                });
                </script>
                
                <!-- Status Dropdown -->
                <div>
                    <label class="block text-sm font-medium">Status</label>
                    <select name="status" class="w-full border border-slate-300 rounded-lg p-2" required>
                        <option value="Available">Available</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <a href="#" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700">Cancel</a>
                    <button type="submit" class="py-2 px-4 bg-laravel text-white rounded hover:bg-red-700">Add</button>
                </div>
            </form>
        </div>
    </div>
    

   

    <!-- Delete Confirmation Modal -->
    @foreach ($facilities as $facility)
        <div id="deleteFacilityModal-{{ $facility->id }}" class="modal">
            <div class="modal-content">
                <a href="#" class="close">&times;</a>
                <p class="text-center text-lg font-semibold mb-4">Are you sure you want to delete this facility?</p>
                <div class="flex justify-center space-x-4">
                    <form action="{{ route('admin.admin_pages.facility.destroy', $facility->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-800">Yes</button>
                    </form>
                    
                    <a href="#" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700">Cancel</a>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal CSS -->
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal:target {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            width: 400px;
            position: relative;
        }

        .close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            text-decoration: none;
            font-size: 1.5rem;
            color: #333;
        }

        .close:hover {
            color: red;
        }
    </style>
</x-ufmo-layout>
