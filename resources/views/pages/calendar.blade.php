<x-layout>
    @include('partials._myevents')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-8">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <!-- Facility Selector -->
            <select 
                id="facilitySelector" 
                class="text-xl font-bold border rounded-md py-4 px-6 focus:ring focus:ring-blue-400 mb-6">
                <option value="">Select Facility</option>
                @foreach ($facilities as $facility)
                    <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                @endforeach
            </select>

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
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-xl font-bold mb-4">Book Your Slot</h2>

            <!-- Selected Date Display -->
            <div class="mb-4">
                <p class="text-gray-700">
                    Selected Facility: <span id="selectedFacility" class="font-semibold">-</span>
                </p>
                <p class="text-gray-700">
                    Selected Date: <span id="selectedDate" class="font-semibold">-</span>
                </p>
                <p class="text-gray-700">
                    Selected Time: <span id="selectedTime" class="font-semibold">-</span>
                </p>
            </div>

            


            <h3 class="text-lg font-semibold mb-2">Select Time Slot</h3>
            <ul id="timeSlotList" class="space-y-2">
                @php
                    // Define all time slots with their corresponding time IDs
                    $timeSlots = [
                        1 => '8:00 AM - 10:00 AM',
                        2 => '10:00 AM - 12:00 PM',
                        3 => '12:00 PM - 2:00 PM',
                        4 => '2:00 PM - 4:00 PM',
                        5 => '4:00 PM - 6:00 PM',
                    ];
                @endphp
            
                @foreach ($timeSlots as $timeId => $timeLabel)
                    <li>
                        <button
                            type="button"
                            class="time-slot-btn w-full text-left px-4 py-2 border rounded-md {{ in_array($timeId, $bookedSlots) ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : 'hover:bg-gray-100' }}"
                            {{ in_array($timeId, $bookedSlots) ? 'disabled' : '' }}
                            onclick="{{ in_array($timeId, $bookedSlots) ? 'return false;' : "setTimeSlot('$timeLabel', $timeId)" }}">
                            {{ $timeLabel }}
                        </button>
                    </li>
                @endforeach
            </ul>


            
            

            <!-- Hidden Form -->
            <form id="bookingForm" method="GET" action="/listings/create">
                <input type="hidden" name="facility" id="formFacility">
                <input type="hidden" name="venue_id" id="formVenueId">
                <input type="hidden" name="date" id="formDate">
                <input type="hidden" name="time" id="formTime">
                <div class="mt-6 text-right">
                    <label for="modalToggle" class="px-4 py-2 bg-gray-500 text-white rounded-md cursor-pointer hover:bg-gray-600">Cancel</label>
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>

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
    const dateArr = date.split('/');
    const selectedDate = new Date(dateArr[0], dateArr[1] - 1, dateArr[2]);
    const selectedFacility = document.querySelector('#facilitySelector').value;
    const formattedDate = selectedDate.toLocaleDateString('en-CA'); // Ensure the format is 'yyyy-mm-dd'

    // Update the modal with the selected facility name and date
    const selectedFacilityName = document.querySelector('#facilitySelector option:checked')?.textContent || '-';
    document.getElementById('selectedFacility').textContent = selectedFacilityName;
    document.getElementById('selectedDate').textContent = formattedDate;
    document.getElementById('formDate').value = formattedDate;
    document.getElementById('formFacility').value = selectedFacility;  // Facility ID
    document.getElementById('formVenueId').value = selectedFacility;  // Venue ID 

    // Enable/Disable time slots based on bookings
    const timeSlotButtons = document.querySelectorAll('.time-slot-btn');
    timeSlotButtons.forEach(button => {
        const time = button.textContent.trim();
        
        // Ensure isTimeSlotBooked is checking the correct values
        if (isTimeSlotBooked(selectedFacility, formattedDate, time)) {
            button.disabled = true;
            button.classList.add('bg-red-100', 'text-gray-400', 'cursor-not-allowed');
            button.classList.remove('hover:bg-gray-100');
        } else {
            button.disabled = false;
            button.classList.remove('bg-red-100', 'text-gray-400', 'cursor-not-allowed');
            button.classList.add('hover:bg-gray-100');
        }
    });

    // Open the modal
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
