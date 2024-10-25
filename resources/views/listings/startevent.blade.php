<x-layout>
    @include('partials._myevents')

    <!-- Profile Card -->
    <div class="pt-28 pb-20">
        <div class="max-w-[800px] mx-auto sticky p-4 rounded-lg bg-white shadow-lg">
            <!-- First div -->
            <div class="md:col-span-1 bg-white shadow-lg h-64 rounded-lg overflow-hidden">
                <img class="w-full h-full object-cover" 
                     src="{{ $listing->image ? asset('storage/' . $listing->image) : asset('/images/no-image.png') }}" 
                     alt="Event Image" />
            </div>

            <!-- Event details -->
            <div class="md:col-span-3 bg-white shadow-xl p-4 space-y-2 p-3 rounded-lg mt-6">
                <p>What: <strong>{{$listing->tags}}</strong></p>
                <p>Where: <strong>{{$listing->venue}}</strong></p>
                <p>When: <strong>{{$listing->event_time}}</strong></p>
                <p>For:  <x-listing-organizations :organizationsCsv="$listing->organization" /> </p> 
                <h1 class="font-bold text-lg text-gray-600"></h1>
                <h1 class="text-lg text-gray-600 text-justify pt-2">{{$listing->description}}</h1>
            </div>

            <!-- Flex container to align left and right divs -->
            <div class="flex mt-6 space-x-4">
                <img alt="QR Code" class="rounded-t" src="{{ $listing->qr_code ? asset($listing->qr_code) : asset('/images/no-image.png') }}">

                <!-- Right side (60% width with form) -->
                <div class="w-3/5">
                    <form id="eventForm" method="post" onsubmit="startEvent(event)">
                        <input type="hidden" id="listing_id" value="{{ $listing->id }}"> <!-- Assuming $listing is passed to the view -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                                Input Link
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" id="input1" type="text" placeholder="fb live link">
                        </div>
                    
                        <!-- Button to start the event -->
                        <button id="startButton" type="submit" class="block w-full rounded-lg bg-laravel text-white py-3.5 px-7">
                            Start Now!
                        </button>
                    </form>
                    
                    <!-- Save button for saving event data -->
                    <button id="saveButton" type="button" class="mt-4 hidden" onclick="saveEvent()">Save</button>
                    
                    <!-- Display area for event status and timer -->
                    <div id="eventStatus" class="mt-4 text-lg"></div>
                    <div id="timer" class="mt-2 text-xl hidden"></div>
                    
                    <!-- Button to stop the event -->
                    <button id="stopButton" type="button" class="mt-4 hidden" onclick="stopEvent()">Stop Event</button>
                    
                    <!-- Display for event start, end, and duration -->
                    <div id="eventDetails" class="mt-4 hidden">
                        <div id="timeStarted" class="text-lg"></div>
                        <div id="timeEnded" class="text-lg"></div>
                        <div id="duration" class="text-lg"></div>
                    </div>
                    
                    
                </div>
            </div>

            
        </div>
    </div>

    <script>
        let timerInterval;
        let eventStartTime;
        let durationInSeconds = 0;
        
        function startEvent(event) {
            event.preventDefault(); // Prevent form submission
        
            eventStartTime = new Date();
            document.getElementById("eventStatus").textContent = "Ongoing Event";
            document.getElementById("timer").classList.remove("hidden");
            document.getElementById("stopButton").classList.remove("hidden");
            document.getElementById("startButton").classList.add("hidden");
            document.getElementById("timeStarted").textContent = `Event Started At: ${eventStartTime.toLocaleTimeString()}`;
        
            timerInterval = setInterval(() => {
                durationInSeconds++;
                const hours = Math.floor(durationInSeconds / 3600);
                const minutes = Math.floor((durationInSeconds % 3600) / 60);
                const seconds = durationInSeconds % 60;
                document.getElementById("timer").textContent = `Event Duration: ${hours}h ${minutes}m ${seconds}s`;
            }, 1000);
        }
        
        function stopEvent() {
            clearInterval(timerInterval); // Stop the timer
        
            const timeEndedDiv = document.getElementById("timeEnded");
            const durationDiv = document.getElementById("duration");
            const durationContainer = document.getElementById("eventDetails");
        
            // Capture the end time
            const eventEndTime = new Date();
            const endTimeFormatted = eventEndTime.toLocaleTimeString();
        
            // Display end time
            timeEndedDiv.textContent = `Event Ended At: ${endTimeFormatted}`;
        
            // Calculate and display the duration
            const hours = Math.floor(durationInSeconds / 3600);
            const minutes = Math.floor((durationInSeconds % 3600) / 60);
            const seconds = durationInSeconds % 60;
        
            durationDiv.textContent = `Total Duration: ${hours}h ${minutes}m ${seconds}s`;
        
            // Show the event details (start time, end time, and duration)
            durationContainer.classList.remove("hidden");
        
            // Show the Save button
            document.getElementById("saveButton").classList.remove("hidden");
        
            // Hide the stop button after stopping the event
            document.getElementById("stopButton").classList.add("hidden");
        }
        
        function saveEvent() {
    const listingId = document.getElementById("listing_id").value;

    // Assume `eventStartTime` and `durationInSeconds` are already available globally.
    const eventStartTimeFormatted = eventStartTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
    const eventEndTime = new Date(eventStartTime);
    eventEndTime.setSeconds(eventEndTime.getSeconds() + durationInSeconds);
    const eventEndTimeFormatted = eventEndTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });

    const eventDuration = durationInSeconds;

    // Prepare data to send
    const data = {
        listing_id: listingId,
        time_start: eventStartTimeFormatted,
        time_end: eventEndTimeFormatted,
        event_duration: eventDuration,
    };

    console.log("Sending data:", data); // Debug log to check data being sent

    // Send AJAX request to save event data
    fetch('/event/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Event data saved successfully!'); // Success
            document.getElementById("saveButton").classList.add("hidden");
        } else {
            console.error('Server error:', data.error);
            alert(`Failed to save event data: ${data.error}`);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        alert('An error occurred while saving event data.');
    });
}



        </script>
        
</x-layout>

@include('partials._footer')
