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
                        {{--title-------}}
                        <div class="md:col-span-5">
                          <label for="title">Organization</label>
                          <input type="text" name="title" id="title" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('organization', Auth::user()->org) }}" readonly style="text-transform: uppercase;" />
                        </div>

                        {{----venue-------}}
                        <div class="md:col-span-2">
                          <label for="venue">Venue</label>
                          <input type="text" name="venue" id="venue" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{old('venue')}}" placeholder="" />
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
                        <label  for="event_date">Select Date</label>
                        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                          <input type="date" name="event_date" id="event_date" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="{{old('event_date')}}"/>
                        </div>
                        @error('event_date')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                      </div>

                      {{------time-------}}
                      <div class="md:col-span-2">
                        <label for="state">Select Time</label>
                        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                            <input type="time" name="event_time" id="event_time" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="{{ old('event_time') }}" />
                        </div>
                        @error('event_time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                      @enderror
                      </div>

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
  </script>

</x-layout>

@include('partials._footer')
