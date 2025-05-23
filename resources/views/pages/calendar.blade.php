<x-layout>
    @include('partials._myevents')

    <div class="pt-10">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow-lg rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Calendar</h2>

                <!-- Year, Month & Classification Select -->
                <form method="GET" id="calendarForm" class="flex space-x-2">
                    <select id="classification" name="classification" class="text-md border rounded-md">
                        <option value="">Select Classification</option>
                        <option value="University Events">University Event</option>
                        <option value="Class Events">Class Events</option>
                        <option value="College Events">College Events</option>
                        <option value="Organization Events">Organization Events</option>
                        <option value="Sports Events">Sports Events</option>
                    </select>

                    <!-- Facility Dropdown -->
                    <select id="facilitySelector" class="text-md border rounded-md">
    <option value="">Select Facility</option>
    @foreach ($facilities as $facility)
        <option value="{{ $facility->facility_name }}"
            data-classification="{{ json_encode($facility->classification) }}"
            @if ($facility->status === 'Unavailable') disabled @endif>
            {{ $facility->facility_name }}
            @if ($facility->status === 'Unavailable') (Unavailable) @endif
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


                    <!-- Year Selection -->
                    <select name="year" class="border rounded p-2" onchange="this.form.submit()">
                        @php
                            $currentYear = date('Y');
                            $selectedYear = request('year', $currentYear);
                        @endphp
                        @for ($y = 2020; $y <= 2030; $y++)
                            <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>

                    <!-- Month Selection -->
                    <select name="month" class="border rounded p-2" onchange="this.form.submit()">
                        @php
                            $months = [
                                "January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                            ];
                            $selectedMonth = request('month', date('n'));
                        @endphp
                        @foreach ($months as $index => $month)
                            <option value="{{ $index + 1 }}" {{ ($index + 1) == $selectedMonth ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-700">
                @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                    <div class="bg-blue-500 p-2 rounded text-white font-semibold">{{ $day }}</div>
                @endforeach

                @php
                    // Philippine Holidays (2020 - 2030)
                    function getPhilippineHolidays($year) {
                        return [
                            "$year-01-01" => "New Year's Day",
                            "$year-04-09" => "Day of Valor",
                            "$year-05-01" => "Labor Day",
                            "$year-06-12" => "Independence Day",
                            "$year-11-01" => "All Saints' Day",
                            "$year-12-25" => "Christmas Day",
                            "$year-12-30" => "Rizal Day",
                        ];
                    }

                    $holidays = getPhilippineHolidays($selectedYear);
                    $firstDayOfMonth = date('w', strtotime("$selectedYear-$selectedMonth-01"));
                    $totalDays = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);
                @endphp

                @for ($i = 0; $i < $firstDayOfMonth; $i++)
                    <div></div>
                @endfor

                @for ($day = 1; $day <= $totalDays; $day++)
                    @php
                        $date = sprintf('%04d-%02d-%02d', $selectedYear, $selectedMonth, $day);
                        $isHoliday = isset($holidays[$date]);
                        $dayOfWeek = date('w', strtotime($date));
                        $bgClass = $isHoliday ? 'bg-red-500 text-white cursor-not-allowed' :
                                   ($dayOfWeek == 0 ? 'bg-gray-300 text-gray-800 cursor-not-allowed' :
                                   'bg-white hover:bg-blue-100 cursor-pointer');
                        $onClick = $isHoliday ? '' : "onclick='openModal(\"$date\")'";
                    @endphp

                    <div class="p-2 border rounded {{ $bgClass }}" {!! $onClick !!}>
                        {{ $day }}
                        @if ($isHoliday)
                            <br><span class="text-xs">🎉 {{ $holidays[$date] }}</span>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h3 class="text-lg font-semibold">Select Date: <span id="selectedDate"></span></h3>
            <h3 id="selectedTimeRange" class="text-lg font-semibold"></h3>
            <h3 class="text-lg font-semibold">Classification: <span id="selectedClassification"></span></h3>
            <h3 class="text-lg font-semibold">Facility: <span id="selectedFacility"></span></h3>

            @php
            // Convert booked time ranges into an array of individual times
            $bookedTimes = [];
        
            foreach ($bookedSlots as $slot) {
                $timeRange = explode(' - ', $slot);
                $startTime = strtotime($timeRange[0]);
                $endTime = strtotime($timeRange[1]);
        
                while ($startTime <= $endTime) {
                    $bookedTimes[] = date('g:i A', $startTime); // Format time as "7:00 AM"
                    $startTime = strtotime('+1 hour', $startTime);
                }
            }
        
            $timeSlots = [
                '7:00 AM', '8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
                '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM', '6:00 PM',
                '7:00 PM', '8:00 PM', '9:00 PM'
            ];
        @endphp
        
        <div id="timeSlots" class="grid grid-cols-4 gap-2 mt-4">
            @foreach ($timeSlots as $time)
                @php
                    $isBooked = in_array($time, $bookedTimes);
                @endphp
                <button 
                    class="time-btn p-2 border rounded {{ $isBooked ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-700' }}" 
                    data-time="{{ $time }}" 
                    data-value="{{ $loop->index + 1 }}" 
                    onclick="{{ $isBooked ? 'return false;' : 'selectTime(this)' }}" 
                    {{ $isBooked ? 'disabled' : '' }}>
                    {{ $time }}
                </button>
            @endforeach
        </div>
        


            <div class="mt-4 flex justify-end space-x-2">
                <button onclick="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded">Close</button>
                <a id="saveProceedBtn" href="#" onclick="redirectToCreate()"
                class="px-4 py-2 bg-blue-500 text-white rounded">
                Save & Proceed
            </a>
            
                
            </div>
        </div>
    </div>

    <script>
        let selectedTimes = [], startTime = null, endTime = null;

        function openModal(date) {
            document.getElementById('selectedDate').innerText = date;
            document.getElementById('selectedClassification').innerText = document.getElementById("classification").value || "None";
            document.getElementById('selectedFacility').innerText = document.getElementById("facilitySelector").value || "None";
            document.getElementById('modal').classList.remove('hidden');
            resetTimeSelection();
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function selectTime(button) {
            let time = button.getAttribute('data-time');
            startTime = startTime === null ? time : startTime;
            endTime = time;
            selectedTimes = getTimeRange(startTime, endTime);
            highlightSelectedTimes();
            updateSelectedTime();
        }

        function highlightSelectedTimes() {
            document.querySelectorAll('.time-btn').forEach(btn => {
                btn.classList.toggle('bg-green-500', selectedTimes.includes(btn.getAttribute('data-time')));
            });
        }

        function getTimeRange(start, end) {
            let times = [...document.querySelectorAll('.time-btn')].map(btn => btn.getAttribute('data-time'));
            return times.slice(times.indexOf(start), times.indexOf(end) + 1);
        }

        function updateSelectedTime() {
            document.getElementById('selectedTimeRange').innerText = selectedTimes.length ? `Selected Time: ${selectedTimes[0]} - ${selectedTimes[selectedTimes.length - 1]}` : "None";
        }
        function redirectToCreate() {
    let date = document.getElementById('selectedDate').innerText;
    let classification = document.getElementById('selectedClassification').innerText;
    let facility = document.getElementById('selectedFacility').innerText;
    let time = selectedTimes.length ? `${selectedTimes[0]} - ${selectedTimes[selectedTimes.length - 1]}` : "None";

    let url = `/listings/create?date=${encodeURIComponent(date)}&classification=${encodeURIComponent(classification)}&facility=${encodeURIComponent(facility)}&time=${encodeURIComponent(time)}`;
    
    window.location.href = url; // Redirect to /listings/create with parameters
}

document.addEventListener("DOMContentLoaded", function () {
    const selectedDateEl = document.getElementById("selectedDate");
    const selectedFacilityEl = document.getElementById("selectedFacility");
    const timeSlotsContainer = document.getElementById("timeSlots");

    function fetchBookedSlots() {
        let selectedDate = selectedDateEl.innerText.trim();
        let selectedFacility = selectedFacilityEl.innerText.trim();

        if (!selectedDate || !selectedFacility) return;

        fetch(`/get-booked-slots?venue=${selectedFacility}&event_date=${selectedDate}`)
            .then(response => response.json())
            .then(bookedSlots => {
                let bookedTimes = [];

                bookedSlots.forEach(slot => {
                    let timeRange = slot.split(" - ");
                    let startTime = new Date("1970-01-01 " + timeRange[0]);
                    let endTime = new Date("1970-01-01 " + timeRange[1]);

                    while (startTime <= endTime) {
                        bookedTimes.push(startTime.toLocaleTimeString("en-US", { hour: "numeric", minute: "2-digit", hour12: true }));
                        startTime.setHours(startTime.getHours() + 1);
                    }
                });

                document.querySelectorAll(".time-btn").forEach(button => {
                    let time = button.getAttribute("data-time");
                    if (bookedTimes.includes(time)) {
                        button.classList.add("bg-gray-400", "cursor-not-allowed");
                        button.classList.remove("bg-blue-500", "hover:bg-blue-700");
                        button.disabled = true;
                    } else {
                        button.classList.remove("bg-gray-400", "cursor-not-allowed");
                        button.classList.add("bg-blue-500", "hover:bg-blue-700");
                        button.disabled = false;
                    }
                });
            })
            .catch(error => console.error("Error fetching booked slots:", error));
    }

    // Call function when the modal opens (or when venue/date changes)
    document.getElementById("modal").addEventListener("click", fetchBookedSlots);
});

    </script>
</x-layout>
