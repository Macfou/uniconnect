


<x-layout>
    @include('partials._myevents')

    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="max-w-3xl w-full mx-auto pt-10 px-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Create an Event</h2>
                <p class="text-gray-600 mb-6">Fill out the form below to create an event.</p>

                <form method="POST" action="/listings" enctype="multipart/form-data">
                    @csrf

                    <!-- Event Title -->
                    <div class="mb-4">
                        <label for="tags" class="block font-semibold text-gray-700">Event Title</label>
                        <input type="text" name="tags" id="tags" class="w-full mt-1 p-2 border rounded bg-gray-50" value="{{ old('tags') }}" />
                    </div>

                    <!-- Organization -->
                    <div class="mb-4">
                        <label for="title" class="block font-semibold text-gray-700">Organization</label>
                        <input type="text" name="title" id="title" class="w-full mt-1 p-2 border rounded bg-gray-50" />
                    </div>

                    <!-- Organizations Involved -->
                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700">Organizations Involved</label>
                        <button type="button" id="toggleDropdown" class="w-full mt-1 p-2 border rounded bg-gray-50 text-left">Select Organizations</button>
                        <div id="organizationDropdown" class="hidden mt-1 border rounded bg-gray-50 p-2">
                            <button type="button" id="selectAllButton" class="text-blue-500 underline">Select All</button>
                            @foreach($organizations as $organization)
                                <div class="mt-2">
                                    <input type="checkbox" class="organization-checkbox" name="organization[]" id="org-{{ $organization->id }}" value="{{ strtoupper($organization->orgNameAbbv) }}" {{ in_array($organization->orgNameAbbv, old('organization', [])) ? 'checked' : '' }}>
                                    <label for="org-{{ $organization->id }}">{{ strtoupper($organization->orgNameAbbv) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Venue, Date & Time -->
                    <div class="mb-4">
                        <label class="block font-semibold text-gray-700">Select Venue, Date & Time</label>
                        <button type="button" onclick="window.location.href='/pages/calendar'" class="w-full mt-1 p-2 bg-blue-500 hover:bg-blue-600 text-white rounded">Select</button>
                    </div>
                  
    <h3 class="text-lg font-semibold">Select Date: {{ request('date') }}</h3>
    <h3 class="text-lg font-semibold">Classification: {{ request('classification') }}</h3>
    <h3 class="text-lg font-semibold">Facility: {{ request('facility') }}</h3>
    <h3 class="text-lg font-semibold">Selected Time: {{ request('time') }}</h3>
                
                    <input type="hidden" for="event_date" name="event_date" value="{{ request('date') }}">
                    <input type="hidden" for="classifications" name="classifications" value="{{ request('classification') }}">
                    <input type="hidden" for="venue" name="venue" value="{{ request('facility') }}">
                    <input type="hidden" for="event_time" name="event_time" value="{{ request('time') }}">
                    <!-- Upload Image -->
                    <div class="mb-4">
                        <label for="image" class="block font-semibold text-gray-700">Upload Image</label>
                        <input type="file" name="image" id="image" class="w-full mt-1 p-2 border rounded bg-gray-50" />
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block font-semibold text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="w-full mt-1 p-2 border rounded bg-gray-50" placeholder="Event description...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <!-- Submit Button -->
                    <div class="md:col-span-5 text-right">
                      <div class="inline-flex items-end">
                          <button type="submit" name="is_draft" value="0" class="bg-laravel  text-white font-bold py-2 px-4 rounded">
                              Post Event
                          </button>
                          <button type="submit" name="is_draft" value="1" class="bg-white border border-laravel text-laravel font-bold py-2 px-4 rounded ml-2">
                              Save as Draft
                          </button>
                      </div>
                  </div>
                  
                  

            @if(session('qr_code'))
                <div class="mt-6 p-4 bg-white shadow-lg rounded-lg">
                    <h4 class="font-bold text-gray-800">QR Code:</h4>
                    <img src="{{ asset(session('qr_code')) }}" alt="QR Code" class="w-32 mt-2">
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toggleDropdownButton = document.getElementById('toggleDropdown');
            var organizationDropdown = document.getElementById('organizationDropdown');
            var checkboxes = document.querySelectorAll('.organization-checkbox');
            var selectAllButton = document.getElementById('selectAllButton');

            toggleDropdownButton.addEventListener('click', function() {
                organizationDropdown.classList.toggle('hidden');
            });

            function updateSelectedOrganizations() {
                var selectedOrganizations = [];
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedOrganizations.push(checkbox.value);
                    }
                });
                toggleDropdownButton.textContent = selectedOrganizations.length > 0 ? selectedOrganizations.join(', ') : 'Select Organizations';
            }

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', updateSelectedOrganizations);
            });

            selectAllButton.addEventListener('click', function() {
                var allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
                updateSelectedOrganizations();
            });

            updateSelectedOrganizations();
        });

        function toggleLinkInput() {
            const status = document.getElementById('status').value;
            const linkInput = document.getElementById('linkInput');
            const linkField = document.getElementById('link');

            if (status === 'online') {
                linkInput.classList.remove('hidden');
                linkField.setAttribute('required', 'required');
            } else {
                linkInput.classList.add('hidden');
                linkField.removeAttribute('required');
            }
        }

        window.onload = toggleLinkInput;
    </script>

</x-layout>

@include('partials._footer')
