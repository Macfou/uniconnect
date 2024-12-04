<x-layout>
    @include('partials._myevents')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-8">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <!-- Calendar Header -->
            <div class="flex justify-between items-center mb-10">
                <!-- Facility Selector -->
                <select class="text-xl font-bold border rounded-md py-4 px-6 focus:ring focus:ring-blue-400">
                    <option value="">Facility</option>
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
                    class="text-xl font-bold border rounded-md py-4 px-6 focus:ring focus:ring-blue-400">
                    @foreach ([
                        'January', 'February', 'March', 'April', 'May',
                        'June', 'July', 'August', 'September', 'October',
                        'November', 'December'
                    ] as $monthIndex => $month)
                        <option value="{{ $monthIndex + 1 }}" {{ $monthIndex + 1 == now()->month ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Calendar Grid -->
            <div id="calendarGrid" class="grid grid-cols-7 gap-6 text-center text-lg">
                <!-- Days will be dynamically generated -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Modal -->
<input type="checkbox" id="modalToggle" class="hidden peer">
<div
    class="fixed inset-0 bg-black bg-opacity-50 hidden peer-checked:flex items-center justify-center z-50">
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
        <ul class="space-y-2">
            <li>
                <button 
                    type="button" 
                    class="time-slot-btn w-full text-left px-4 py-2 border rounded-md hover:bg-gray-100" 
                    onclick="setTimeSlot('8:00 AM - 10:00 AM')">
                    8:00 AM - 10:00 AM
                </button>
            </li>
            <li>
                <button 
                    type="button" 
                    class="time-slot-btn w-full text-left px-4 py-2 border rounded-md hover:bg-gray-100" 
                    onclick="setTimeSlot('10:00 AM - 12:00 PM')">
                    10:00 AM - 12:00 PM
                </button>
            </li>
            <li>
                <button 
                    type="button" 
                    class="time-slot-btn w-full text-left px-4 py-2 border rounded-md hover:bg-gray-100" 
                    onclick="setTimeSlot('12:00 PM - 2:00 PM')">
                    12:00 PM - 2:00 PM
                </button>
            </li>
            <li>
                <button 
                    type="button" 
                    class="time-slot-btn w-full text-left px-4 py-2 border rounded-md hover:bg-gray-100" 
                    onclick="setTimeSlot('2:00 PM - 4:00 PM')">
                    2:00 PM - 4:00 PM
                </button>
            </li>
            <li>
                <button 
                    type="button" 
                    class="time-slot-btn w-full text-left px-4 py-2 border rounded-md hover:bg-gray-100" 
                    onclick="setTimeSlot('4:00 PM - 6:00 PM')">
                    4:00 PM - 6:00 PM
                </button>
            </li>
        </ul>

        <!-- Hidden Form -->
        <form id="bookingForm" method="GET" action="/listings/create">
            <input type="hidden" name="facility" id="formFacility">
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

        // Generate Calendar
        function generateCalendar(year, month) {
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
                        ${isHoliday ? `<div class="text-sm font-normal text-gray-800 mt-1">${holidays[dateKey]}</div>` : ''}
                    </button>
                `;
            }
        }

        // Open Modal with Selected Date
        function openModal(date) {
            const facilitySelector = document.querySelector('select');
    const selectedFacility = facilitySelector.options[facilitySelector.selectedIndex].text;

    // Set selected date and facility
    document.getElementById('selectedDate').textContent = date;
    document.getElementById('selectedFacility').textContent = selectedFacility;

    // Update form hidden fields
    document.getElementById('formFacility').value = selectedFacility;
    document.getElementById('formDate').value = date;

    // Show modal
    document.getElementById('modalToggle').checked = true;
        }

        function setTimeSlot(timeSlot) {
    document.getElementById('selectedTime').textContent = timeSlot;
    document.getElementById('formTime').value = timeSlot;
}

        // Initialize Calendar
        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth() + 1;
        generateCalendar(currentYear, currentMonth);

        document.getElementById('yearSelector').addEventListener('change', () => {
            const year = document.getElementById('yearSelector').value;
            const month = document.getElementById('monthSelector').value;
            generateCalendar(year, month);
        });

        document.getElementById('monthSelector').addEventListener('change', () => {
            const year = document.getElementById('yearSelector').value;
            const month = document.getElementById('monthSelector').value;
            generateCalendar(year, month);
        });
    </script>
</x-layout>
