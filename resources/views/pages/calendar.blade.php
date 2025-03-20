
<x-layout>
    @include('partials._myevents')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-8">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <!-- Facility Selector -->
           
          <!-- Classification Dropdown -->
<!-- Classification Dropdown -->
<select 
    id="classification" 
    name="classification" 
    class="text-xl font-bold border rounded-md py-4 px-6 focus:ring focus:ring-blue-400 mb-6">
    <option value="">Select Classification</option>
    <option value="Class Events">Class Events</option>
    <option value="College Events">College Events</option>
    <option value="Organization Events">Organization Events</option>
    <option value="Sports Events">Sports Events</option>
</select>

<!-- Facility Dropdown -->
<select 
    id="facilitySelector" 
    class="text-xl font-bold border rounded-md py-4 px-6 focus:ring focus:ring-blue-400 mb-6">
    <option value="">Select Facility</option>
    @foreach ($facilities as $facility)
        <option value="{{ $facility->id }}" data-classification="{{ json_encode($facility->classification) }}">
            {{ $facility->facility_name }}
        </option>
    @endforeach
</select>

<script>
    document.getElementById("classification").addEventListener("change", function() {
        let selectedClass = this.value; // Get selected classification
        let facilitySelector = document.getElementById("facilitySelector"); // Facility dropdown
        
        // Loop through each facility option
        Array.from(facilitySelector.options).forEach(option => {
            if (option.value === "") {
                option.hidden = false; // Keep "Select Facility" option visible
            } else {
                let facilityClass = JSON.parse(option.getAttribute("data-classification")); // Convert JSON string to array
                
                // Show if classification array contains the selected value
                option.hidden = !facilityClass.includes(selectedClass);
            }
        });

        // Reset facility selection after filtering
        facilitySelector.value = "";
    });
</script>



            <!-- Year Selector -->
            <select
                id="yearSelector"
                class="text-xl font-bold border rounded-md py-4 px-6 focus:ring focus:ring-blue-400">
                @for ($year = 2020; $year <= 2028; $year++)
                    <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>

            <!-- Month Selector -->
            <select
                id="monthSelector"
                class="text-xl font-bold border rounded-md py-4 px-6 focus:ring focus:ring-blue-400 mb-6">
                @foreach ([ 
                    'January', 'February', 'March', 'April', 'May',
                    'June', 'July', 'August', 'September', 'October',
                    'November', 'December'
                ] as $monthIndex => $month)
                    <option value="{{ $monthIndex + 1 }}" {{ $monthIndex + 1 == now()->month ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>

            <!-- Calendar Grid -->
            <div id="calendarGrid" class="grid grid-cols-7 gap-6 text-center text-lg">
                <!-- Days will be dynamically generated -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <input type="checkbox" id="modalToggle" class="hidden peer">
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden peer-checked:flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-5xl">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Book Your Slot</h2>
    
            <!-- Selected Details -->
            <div class="mb-6 grid grid-cols-3 gap-4 text-gray-700">
                <p>Selected Facility: <span id="selectedFacility" class="font-semibold">-</span></p>
                <p>Selected Date: <span id="selectedDate" class="font-semibold">-</span></p>
                <p>Selected Time: <span id="selectedTime" class="font-semibold">-</span></p>
            </div>
    
            <!-- Time Slot Selection -->
            <div class="p-6 bg-gray-100 shadow-md rounded-lg">
                <h3 class="text-xl font-semibold mb-4 text-gray-700 text-center">Select Time Slot</h3>
    
                <div class="grid grid-cols-6 gap-3">
                    @php
                        $startTime = strtotime('07:00 AM');
                        $endTime = strtotime('09:00 PM');
                        $interval = 60 * 60; // 1-hour steps
                    @endphp
    
                    @while ($startTime <= $endTime)
                        <button 
                            type="button"
                            class="time-btn text-md font-medium py-3 px-4 rounded-lg bg-white shadow-sm transition-all duration-200 hover:bg-blue-500 hover:text-white text-gray-700"
                            data-time="{{ date('g:i A', $startTime) }}"
                            onclick="selectTimeRange(this)">
                            {{ date('g:i A', $startTime) }}
                        </button>
                        @php $startTime += $interval; @endphp
                    @endwhile
                </div>
            </div>
    
            <!-- Action Buttons -->
            <div class="mt-6 flex justify-between">
                <button 
                    onclick="resetSelection()" 
                    class="px-5 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600">
                    Reset Selection
                </button>
    
                <form id="bookingForm" method="GET" action="/listings/create" class="flex space-x-3">
                    <input type="hidden" name="facility" id="formFacility">
                    <input type="hidden" name="venue_id" id="formVenueId">
                    <input type="hidden" name="date" id="formDate">
                    <input type="hidden" name="time" id="formTime">
                    
                    <label for="modalToggle" class="px-5 py-2 bg-gray-500 text-white rounded-md cursor-pointer hover:bg-gray-600">
                        Cancel
                    </label>
                    <button 
                        type="submit" 
                        class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Confirm
                    </button>
                </form>
                
            </div>
        </div>
    </div>
    
    <script>
        let startTime = null;
        let endTime = null;
    
        function selectTimeRange(button) {
            const time = button.dataset.time;
    
            if (!startTime) {
                startTime = time;
                button.classList.add('bg-blue-500', 'text-white');
            } else if (!endTime) {
                endTime = time;
                highlightSelectedRange();
            } else {
                resetSelection();
                selectTimeRange(button);
            }
    
            updateSelectedTime();
        }
    
        function highlightSelectedRange() {
            const buttons = document.querySelectorAll('.time-btn');
            let inRange = false;
    
            buttons.forEach(btn => {
                if (btn.dataset.time === startTime || btn.dataset.time === endTime) {
                    inRange = !inRange;
                    btn.classList.add('bg-blue-500', 'text-white');
                }
                if (inRange) {
                    btn.classList.add('bg-blue-400', 'text-white');
                }
            });
        }
    
        function resetSelection() {
            document.querySelectorAll('.time-btn').forEach(btn => {
                btn.classList.remove('bg-blue-500', 'bg-blue-400', 'text-white');
            });
            startTime = null;
            endTime = null;
            document.getElementById('selectedTime').innerText = 'None';
        }
    
        function updateSelectedTime() {
    if (startTime && endTime) {
        document.getElementById('selectedTime').innerText = `${startTime} - ${endTime}`;
        document.getElementById('formTime').value = `${startTime} - ${endTime}`;
    }
}

    </script>
    

    <script>
        // Philippine Holidays
        const holidays = {
            "01-01": "New Year's Day",
            "02-25": "EDSA Revolution Anniversary",
            "04-09": "Day of Valor",
            "05-01": "Labor Day",
            "06-12": "Independence Day",
            "08-21": "Ninoy Aquino Day",
            "11-01": "All Saints' Day",
            "11-30": "Bonifacio Day",
            "12-25": "Christmas Day",
            "12-30": "Rizal Day",
        };
    
        // Booked times (to be populated from server)
        let bookedTimes = {};
    
        // Fetch booked times from server
        // Function to fetch booked slots
async function fetchBookedTimes(year, month, facilityId) {
    try {
        const response = await fetch(`/api/booked-times?year=${year}&month=${month}&facility=${facilityId}`);
        const data = await response.json();
        bookedTimes = data;
        return data;
    } catch (error) {
        console.error('Error fetching booked times:', error);
        return {};
    }
}

// Check if a specific time slot is booked
function isTimeSlotBooked(facilityId, date, time) {
    const dateKey = date.split('/').map(x => x.padStart(2, '0')).join('-');
    
    // Check if this date and facility combination exists in booked times
    if (bookedTimes[dateKey] && bookedTimes[dateKey][facilityId]) {
        return bookedTimes[dateKey][facilityId].includes(time);
    }
    
    return false;
}



    
        // Generate Calendar
        async function generateCalendar(year, month) {
            // Fetch booked times for this month
            const facilityId = document.getElementById('facilitySelector').value;
            if (facilityId) {
                await fetchBookedTimes(year, month, facilityId);
            }

            const calendarGrid = document.getElementById('calendarGrid');
            calendarGrid.innerHTML = `        
                <div class="font-bold text-red-600 text-xl">Sun</div>
                <div class="font-bold text-gray-600 text-xl">Mon</div>
                <div class="font-bold text-gray-600 text-xl">Tue</div>
                <div class="font-bold text-gray-600 text-xl">Wed</div>
                <div class="font-bold text-gray-600 text-xl">Thu</div>
                <div class="font-bold text-gray-600 text-xl">Fri</div>
                <div class="font-bold text-gray-600 text-xl">Sat</div>
            `;
    
            const firstDay = new Date(year, month - 1, 1).getDay();
            const daysInMonth = new Date(year, month, 0).getDate();
    
            for (let i = 0; i < firstDay; i++) {
                calendarGrid.innerHTML += `<div></div>`;
            }
    
            for (let day = 1; day <= daysInMonth; day++) {
                const dateKey = `${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const isSunday = (firstDay + day - 1) % 7 === 0;
                const isHoliday = holidays[dateKey];
    
                calendarGrid.innerHTML += `
                    <button 
                        class="py-4 px-2 rounded-lg ${
                            isHoliday
                                ? 'bg-green-200 text-green-800 cursor-not-allowed'
                                : isSunday
                                ? 'bg-red-200 text-red-800 cursor-not-allowed'
                                : 'bg-gray-50 text-gray-700 hover:bg-blue-200'
                        } font-medium text-xl" 
                        ${isHoliday || isSunday ? 'disabled' : `onclick="openModal('${year}/${month}/${day}')"`}>
                        ${day}
                    </button>
                `;
            }
        }
    
        // Open Modal with selected date and facility
        function openModal(date) {
    const facilityDropdown = document.getElementById('facilitySelector');
    const selectedFacilityId = facilityDropdown.value;
    
    if (!selectedFacilityId) {
        alert("Please select a facility first.");
        return;
    }

    // Get selected facility name
    const selectedFacilityName = facilityDropdown.options[facilityDropdown.selectedIndex].text;

    document.getElementById('selectedFacility').textContent = selectedFacilityName;
    document.getElementById('formFacility').value = selectedFacilityName; // Store name instead of ID
    document.getElementById('formVenueId').value = selectedFacilityId; // Store ID if needed
    document.getElementById('selectedDate').textContent = date;
    document.getElementById('formDate').value = date;

    document.getElementById('modalToggle').checked = true;
}



const bookedSlots = @json($bookedSlots); // Pass booked slots from backend

// Loop through time slot buttons and disable the booked ones
document.querySelectorAll('.time-slot-btn').forEach(button => {
    const timeId = button.getAttribute('data-time-id'); // Assuming the time_id is stored as a data attribute
    if (bookedSlots.includes(parseInt(timeId))) {
        button.disabled = true;
        button.classList.add('bg-red-100', 'text-gray-400', 'cursor-not-allowed');
        button.classList.remove('hover:bg-gray-100');
    } else {
        button.disabled = false;
        button.classList.remove('bg-red-100', 'text-gray-400', 'cursor-not-allowed');
        button.classList.add('hover:bg-gray-100');
    }
});
    
        function setTimeSlot(time, timeId) {
            const selectedFacility = document.getElementById('facilitySelector').selectedOptions[0].text; // Get facility name
            const selectedDate = document.getElementById('formDate').value;

            // Additional check before setting time slot (defensive programming)
            if (isTimeSlotBooked(selectedFacility, selectedDate, time)) {
                alert('This time slot is already booked. Please choose another.');
                return;
            }

            // Set selected time slot and facility name in the modal or form
            document.getElementById('selectedTime').textContent = time;
            document.getElementById('formTime').value = time;

            // Set facility name (instead of id) in the hidden input
            document.getElementById('selectedFacility').textContent = selectedFacility;
            document.getElementById('formFacility').value = selectedFacility; // This passes the facility name
        }
    
        // Update Year/Month and Re-Generate Calendar
        document.getElementById('yearSelector').addEventListener('change', (event) => {
            generateCalendar(event.target.value, document.getElementById('monthSelector').value);
        });
    
        document.getElementById('monthSelector').addEventListener('change', (event) => {
            generateCalendar(document.getElementById('yearSelector').value, event.target.value);
        });
    
        // Initial Calendar Load
        generateCalendar(new Date().getFullYear(), new Date().getMonth() + 1);
    </script>
</x-layout>

