<x-layout>
    @include('partials._myevents')
    
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-8">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <!-- Calendar Header -->
            <div class="flex justify-between items-center mb-10">
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
                <!-- Day Labels -->
                <div class="font-bold text-red-600 text-xl">Sun</div>
                <div class="font-bold text-gray-600 text-xl">Mon</div>
                <div class="font-bold text-gray-600 text-xl">Tue</div>
                <div class="font-bold text-gray-600 text-xl">Wed</div>
                <div class="font-bold text-gray-600 text-xl">Thu</div>
                <div class="font-bold text-gray-600 text-xl">Fri</div>
                <div class="font-bold text-gray-600 text-xl">Sat</div>
                <!-- Days will be dynamically inserted here -->
            </div>
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
  
      // Generate Calendar with Holiday Names
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
  
      // Get first day of the month and total days
      const firstDay = new Date(year, month - 1, 1).getDay();
      const daysInMonth = new Date(year, month, 0).getDate();
  
      // Add blank days for the first week
      for (let i = 0; i < firstDay; i++) {
          calendarGrid.innerHTML += `<div></div>`;
      }
  
      // Add days with holiday names
      for (let day = 1; day <= daysInMonth; day++) {
          const dateKey = `${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
          const isSunday = (firstDay + day - 1) % 7 === 0;
          const holidayName = holidays[dateKey] || null;
  
          calendarGrid.innerHTML += `
              <div class="py-4 px-2 rounded-lg ${
                  holidayName
                      ? 'bg-green-200 text-green-800'
                      : isSunday
                      ? 'bg-red-200 text-red-800'
                      : 'bg-gray-50 text-gray-700'
              } hover:bg-blue-200 focus:outline-none focus:ring focus:ring-blue-400 font-medium text-xl">
                  <div>${day}</div>
                  ${
                      holidayName
                          ? `<div class="text-sm font-normal text-gray-800 mt-1">${holidayName}</div>`
                          : ''
                  }
              </div>
          `;
      }
  }
  
  
      // Update Calendar on Selector Change
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
  
      // Initialize Calendar
      generateCalendar(new Date().getFullYear(), new Date().getMonth() + 1);
  </script>
  
</x-layout>