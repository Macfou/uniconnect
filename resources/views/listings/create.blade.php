@php
    $selectedFacility = request('facility');
    $selectedDate = request('date');
    $selectedTime = request('time');
@endphp

<x-layout>
  @include('partials._myevents')

  {{----------triall------------------------------trial-----------------------}}

  <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
    <div class="max-w-full mx-auto pt-20 pl-6 pr-2 pl-2  lg:pl-32 lg:max-w-[1000px]">
      <div>
        <form method="POST" action="/listings" enctype="multipart/form-data">
          @csrf
          <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
            <div class="container max-w-full sm:max-w-screen-lg mx-auto">
              <div>
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                  <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">
                      <p class="font-bold text-black text-lg">Event Details</p>
                      <p>Please fill out all the fields.</p>
                    </div>

                  

                    {{---organization----}}

                    <div class="lg:col-span-2">
                      <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                        <div class="md:col-span-5">
                          <label for="tags">Title</label>
                          <input type="text" name="tags" id="tags" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{old('tags')}}" />
                        </div>
                       
                      
                      <!-- Link Input (static, always visible) -->
                    
                      
                        {{--title-------}}
                        <div class="md:col-span-5">
                          <label for="title">Organization</label>
                          <input type="text" name="title" id="title" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"  />
                        </div>

                     

                        {{----org involeve----------}}
                        <div class="md:col-span-3">
                          <label for="organization">Organizations Involved</label>

                          <!-- Toggle Button or Label -->
                          <button type="button" id="toggleDropdown" class="h-10 mt-1 px-4 border rounded bg-gray-50 w-full text-left">
                              Select Organizations
                          </button>

                          <!-- Hidden Dropdown Container -->
                          <div id="organizationDropdown" class="hidden h-auto mt-1 border rounded px-4 bg-gray-50">
                              <!-- Select All Button -->
                              <div class="mt-2">
                                  <button type="button" id="selectAllButton" class="text-blue-500 underline">Select All</button>
                              </div>

                              @foreach($organizations as $organization)
                                  <div class="mt-2">
                                      <input type="checkbox" class="organization-checkbox" name="organization[]" id="organization-{{ $organization->id }}" value="{{ strtoupper($organization->orgNameAbbv) }}" {{ in_array($organization->orgNameAbbv, old('organization', [])) ? 'checked' : '' }}>
                                      <label for="organization-{{ $organization->id }}">{{ strtoupper($organization->orgNameAbbv) }}</label>
                                  </div>
                              @endforeach
                          </div>
                      </div>

                      {{----date------}}
                      <div class="md:col-span-3">
                        <label for="event_date">Select a Venue, Date and Time</label>
                        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                            <button 
                                type="button" 
                                onclick="window.location.href='/pages/calendar'" 
                                class="w-full text-gray-800 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md"
                            >
                                Select a Venue, Date and Time
                            </button>
                        </div>
                        @error('event_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($selectedFacility && $selectedDate && $selectedTime)
                    <div class="mb-6">
                        <p class="text-gray-700">Selected Facility: <strong>{{ $selectedFacility }}</strong></p>
                        <p class="text-gray-700">Selected Date: <strong>{{$selectedDate}}</strong></p>
                        <p class="text-gray-700">Selected Time: <strong>{{$selectedTime}}</strong></p>
                    </div>
                @endif
        
                
                   
                <input type="hidden" name="venue" value="{{ $selectedFacility }}">
                <input type="hidden" name="event_date" value="{{ $selectedDate }}">
                <input type="hidden" name="event_time" value="{{ $selectedTime }}">

                    

                      {{------image----}}

                      <div class="md:col-span-5">
                        <label for="image">Upload Image</label>
                        <input type="file" name="image" id="image" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"  value="{{old('image')}}" placeholder="" />

                        @error('image')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                      </div>
                    </div>

                    {{------contact----}}

                    {{------description----}}

                    <div class="md:col-span-5">
                      <label for="description">Description</label>
                      
                      <textarea class="bg-gray-50 text-black border border-gray-200 rounded p-2 w-full" name="description" rows="10"  value="{{old('description')}}"
                    placeholder="Description about event"></textarea>

                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div>
                </div>

                    <div class="md:col-span-5 text-right">
                      <div class="inline-flex items-end">
                        <button class="bg-laravel hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Post Event</button>
                      </div>
                    </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
    @if(session('qr_code')) <!-- Check if QR code path is present in the session -->
    <div>
        <h4>QR Code:</h4>
        <img src="{{ asset(session('qr_code')) }}" alt="QR Code" />
    </div>
    @endif

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggleDropdownButton = document.getElementById('toggleDropdown');
        var organizationDropdown = document.getElementById('organizationDropdown');
        var checkboxes = document.querySelectorAll('.organization-checkbox');
        var selectAllButton = document.getElementById('selectAllButton');

        // Toggle the dropdown visibility
        toggleDropdownButton.addEventListener('click', function() {
            organizationDropdown.classList.toggle('hidden'); // Toggle the hidden class
        });

        // Update the button text with selected organizations
        function updateSelectedOrganizations() {
            var selectedOrganizations = [];
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedOrganizations.push(checkbox.value);
                }
            });
            toggleDropdownButton.textContent = selectedOrganizations.length > 0 ? selectedOrganizations.join(', ') : 'Select Organizations';
        }

        // Listen for checkbox changes
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateSelectedOrganizations);
        });

        // Select/Deselect all checkboxes
        selectAllButton.addEventListener('click', function() {
            var allChecked = Array.from(checkboxes).every(function(checkbox) {
                return checkbox.checked;
            });

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !allChecked; // Select all if not all are checked, otherwise deselect all
            });

            updateSelectedOrganizations();
        });

        // Initial update of the button text
        updateSelectedOrganizations();
    });

    // Function to show/hide link input based on status selection
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

    // Initialize the form state on page load
    window.onload = toggleLinkInput;

  </script>

</x-layout>

@include('partials._footer')
