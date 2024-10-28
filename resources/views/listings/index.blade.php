<x-layout>

    

    <section class="pt-24">
        <div class="w-full shadow-lg text-left">
            <nav aria-label="breadcrumb" class="block w-full">
                <ol class="flex w-full flex-wrap items-center rounded-lg bg-white shadow-lg py-3 px-5">
                    <li class="flex items-center font-sans text-md font-bold text-black hover:text-blue-600 transition duration-200 ease-in-out">
                        <a href="#" class="flex items-center" id="upcoming-link">
                            <span>Upcoming Events</span>
                        </a>
                        <span class="mx-2 text-gray-400">/</span>
                    </li>
                    <li class="flex items-center font-sans text-md font-bold text-black hover:text-blue-600 transition duration-200 ease-in-out">
                        <a href="#" class="flex items-center" id="today-link">
                            <span>Today's Events</span>
                        </a>
                        <span class="mx-2 text-gray-400">/</span>
                    </li>
                    <li class="flex items-center font-sans text-md font-bold text-black hover:text-blue-600 transition duration-200 ease-in-out">
                        <a href="#" id="previous-link">
                            <span>Previous Events</span>
                        </a>
                    </li>
                </ol>
            </nav>
        </div>

      
    
        <!-- Incoming Events Section -->
        <section id="incoming" class="pt-4 ">
            <div class="lg:grid lg:grid-cols-2 gap-4 mx-4 pb-10">
                @forelse($upcomingEvents as $event)
                <x-card class="bg-white shadow-lg mb-6">
                    <div class="flex flex-wrap md:flex-nowrap">
                        <img class="w-full md:w-48 md:mr-6 block rounded" 
                            src="{{ $event->image ? asset('storage/' . $event->image) : asset('/images/no-image.png') }}" 
                            alt="Event Image" />
                        <div>

                            <div class="text-xl font-medium mb-4 text-laravel">{{ strtoupper($event->title) }}</div>
                            <h3 class="text-2xl font-bold text-laravel">
                                 <a>{{ $event->tags }}</a>
                            </h3>
                            
        
                            <x-listing-organizations :organizationsCsv="$event->organization" />
        
                            <div class="text-lg mt-4 text-laravel">
                                
                                <h3 class="text-sm font-medium text-laravel">
                                    <a href="/listings/{{ $event->id }}">See more Info...</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </x-card>
                @empty
                <div class="p-4 text-center text-lg font-bold pb-80">
                    No Upcoming events.
                </div>
                @endforelse
            </div>
        </section>
        
        
    
        <!-- Today's Events Section -->
        <section id="today" class="pt-10 hidden pb-32">
            @forelse($todaysEvents as $event)
                <div class="w-full max-w-6xl rounded bg-white shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
                    <div class="md:flex items-center -mx-10">
                        <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                            <div class="relative">
                                <img src="{{$event->image ? asset('storage/' . $event->image) : asset('/images/no-image.png')}}" class="w-full relative z-10 rounded" alt="">
                            </div>
                        </div>
                        

<div class="w-full md:w-1/2 px-10">
    <div class="mb-10">
        <h1 class="font-bold uppercase text-2xl mb-5">{{$event->tags}}</h1>
        <h2 class="text-xl mb-5">Here at <strong>{{$event->venue}}</strong></h2>

        <!-- Button to trigger modal -->
        <button type="button" id="openModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Submit Attendance
        </button>
  

<div class="pt-4">
    @if(!$event->eventTimings || $event->eventTimings->isEmpty() || !$event->eventTimings->last()->time_end)
        <!-- Show the "Will be starting at" message only if the event has not ended -->
        <div class="inline-block align-bottom mr-5">
            <span class="text-lg  leading-none align-baseline">Will be starting at</span>
            <span class="font-bold text-xl leading-none align-baseline">{{$event->event_time}}</span>
        </div>
    @endif

    <div id="eventContainer">
        <!-- Loop through the event timings for the current listing -->
        @if($event->eventTimings)
            @foreach($event->eventTimings as $eventTime)
                <div class="event">
                    <p> Started: <strong>{{ $eventTime->time_start }}</strong></p>
                    <p> Ended: <strong>{{ $eventTime->time_end }}</strong></p>
                    <p>Duration: <strong>{{ gmdate('H:i:s', $eventTime->event_duration) }} </strong></p>
                </div>
            @endforeach
        @else
            <p>No timing information available for this event.</p>
        @endif
    </div>
</div>
</div>
</div>
<!-- Modal (initially hidden) -->
<div id="qrModal" class="fixed z-10 inset-0 flex items-center justify-center p-4 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full">
            <div class="px-4 py-2">
                <h3 class="text-xl font-bold mb-4">Scan QR Code</h3>
                <hr class="border-black px-4">
                <!-- Video element to display the camera stream -->
                <video id="cameraStream" width="100%" height="300" autoplay></video>
            </div>
            <div class="px-4 py-2 flex justify-end">
                <button id="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
                        
                        <!-- Modal -->
                     

                        

                        <!------------modalend------------->

                        
                          
                            
                            
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-lg font-bold pb-80">
                    No events today.
                </div>
            @endforelse
        </section>
        
        
        
        

       
        
    
        <!-- Previous Events Section -->
        <section id="previous" class="pt-4 shadow-lg hidden">
            <div class="mx-auto px-4 py-8 max-w-xl my-20 lg:max-w-3xl">
                @forelse($previousEvents as $event)
                <div class="bg-white shadow-2xl rounded-lg mb-6 tracking-wide">
                    <div class="md:flex-shrink-0">
                        <img src="{{ asset('images/umak_after-event.jpg') }}" alt="Image" class="w-full h-64 rounded-lg rounded-b-none">
                    </div>
                    <div class="px-4 py-2 mt-2">
                        <h2 class="font-bold text-2xl text-gray-800 tracking-normal">{{ $event->tags }}</h2>
                        
                        <p class="text-sm text-gray-700 px-2 mr-1">
                            {{ $event->description }}
                        </p>
                        <div class="flex items-center justify-between mt-2 mx-6">
                            <a href="#" class="text-blue-500 text-xs -ml-3 "></a>
                            <a href="#" class="flex text-gray-700">
                                <svg fill="none" viewBox="0 0 24 24" class="w-6 h-6 text-blue-500" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                                5
                            </a>
                        </div>
                        <div class="author flex items-center -ml-3 my-3">
                            <div class="user-logo">
                                <img class="w-12 h-12 object-cover rounded-full mx-4 shadow" src="{{ asset('images/logo/umak_ccis_logo.png') }}" alt="avatar">
                            </div>
                            <h2 class="text-sm tracking-tighter text-gray-900">
                                <a href="#">{{ $event->org }}</a> <span class="text-gray-600">{{ $event->event_date }}</span>
                            </h2>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-4 text-center">
                    No previous events.
                </div>
                @endforelse
            </div>
        </section>
        
    
    <script>
        // Get references to sections and links
        const incomingSection = document.getElementById('incoming');
        const todaySection = document.getElementById('today');
        const previousSection = document.getElementById('previous');
      
        const upcomingLink = document.getElementById('upcoming-link');
        const todayLink = document.getElementById('today-link');
        const previousLink = document.getElementById('previous-link');
      
        // Function to hide all sections
        function hideAllSections() {
          incomingSection.classList.add('hidden');
          todaySection.classList.add('hidden');
          previousSection.classList.add('hidden');
        }
      
        // Event listeners for the links
        upcomingLink.addEventListener('click', function(event) {
          event.preventDefault();  // Prevent page reload
          hideAllSections();
          incomingSection.classList.remove('hidden');
        });
      
        todayLink.addEventListener('click', function(event) {
          event.preventDefault();  // Prevent page reload
          hideAllSections();
          todaySection.classList.remove('hidden');
        });
      
        previousLink.addEventListener('click', function(event) {
          event.preventDefault();  // Prevent page reload
          hideAllSections();
          previousSection.classList.remove('hidden');
        });

        /////// qr scan

        
       
    document.addEventListener('DOMContentLoaded', function () {
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const qrModal = document.getElementById('qrModal');
        const videoElement = document.getElementById('cameraStream');

        openModalButton.addEventListener('click', function () {
            qrModal.classList.remove('hidden');
            qrModal.classList.add('flex');

            // Access the user's camera
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function (stream) {
                        videoElement.srcObject = stream;
                    })
                    .catch(function (error) {
                        console.error('Error accessing camera:', error);
                    });
            } else {
                alert('Camera access is not supported by your browser.');
            }
        });

        closeModalButton.addEventListener('click', function () {
            qrModal.classList.remove('flex');
            qrModal.classList.add('hidden');

            // Stop the camera stream
            const stream = videoElement.srcObject;
            if (stream) {
                const tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
            }
            videoElement.srcObject = null;
        });
    });



    </script>
    
    </x-layout>
    
    @include('partials._footer')
    