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
            <div class="max-w-7xl mx-auto my-8 px-2">
                <ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 p-2 xl:p-5">
                    @forelse($upcomingEvents as $event)
                        <li class="relative bg-white flex flex-col justify-between border rounded shadow-md hover:shadow-primary-400">
                            <a class="relative" href="/tool/writey-ai">
                                <div class="relative w-full aspect-video">
                                    <img class="rounded w-full h-[280px] object-cover"
                                         src="{{ $event->image ? asset('storage/' . $event->image) : asset('/images/no-image.png') }}" alt="Event">
                                         <a href="/">
                                         <div
                                         class="text-xs absolute top-0 right-0 bg-blue-700 rounded-lg px-4 py-2 text-white mt-3 mr-3">
                                         Recommended for you
                                     </div>
                                    </a>
                                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-laravel text-white">
                                        <h2 class="text-xl font-semibold">{{ $event->tags }}</h2>
                                    </div>
                                </div>
                            </a>
            
                            <div class="flex flex-col justify-between gap-3 px-4 py-2">
                                <p><strong>{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }} at {{$event->event_time}}</strong></p>
                                <h3 class="text-sm font-medium text-laravel">
                                    <a href="/listings/{{ $event->id }}">See more Info...</a>
                                </h3>
                            </div>
                        </li>
                    @empty
                        <div class="p-4 text-center text-lg font-bold pb-80">
                            No Upcoming events.
                        </div>
                    @endforelse
                </ul>
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
        
  

<div class="pt-4">
   
        <!-- Show the "Will be starting at" message only if the event has not ended -->
        <div class="inline-block align-bottom mr-5">
            <span class="text-lg  leading-none align-baseline">Will be starting at</span>
            <span class="font-bold text-xl leading-none align-baseline">{{$event->event_time}}</span>
        </div>
  

   
</div>
</div>
</div>
                    
                            
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
        <section id="previous" class="pt-4 shadow-lg hidden pb-10">
            
                @forelse($previousEvents as $event)
                <div class="max-w-2xl mx-auto px-10 bg-white rounded-lg shadow-md lg:p-6 lg:max-w-4xl">
                    <!-- Post Header -->
                    <div class="flex items-center mb-4">
                      <img src="{{ asset('images/logo/umak_ccis_logo.png') }}" alt="User Avatar" class="w-12 h-12 rounded-full mr-4">
                      <div>
                        <h3 class="font-semibold text-lg">CCIS</h3>
                        <p class="text-sm text-gray-500">2 hours ago</p>
                      </div>
                    </div>
                  
                    <!-- Post Content -->
                    <p class="text-gray-800 text-base mb-4">Thank you for your participation in our event! Your involvement truly made a difference, and we appreciate your time and contribution. We hope you enjoyed the experience and look forward to having you join us again in the future. Your presence helped make the event a success!🎉</p>
                  
                    <!-- Post Images -->
                    <div class="grid grid-cols-3 gap-2 mb-4">
                      <img src="{{ asset('images/umak_after-event.jpg') }}" alt="Image 1" class="w-full h-32 object-cover rounded-lg">
                      <img src="{{ asset('images/umak_after-event.jpg') }}" alt="Image 2" class="w-full h-32 object-cover rounded-lg">
                      <img src="{{ asset('images/umak_after-event.jpg') }}" alt="Image 3" class="w-full h-32 object-cover rounded-lg">
                    </div>
                  
                    <!-- Reactions and Comments Toggle -->
                    <div class="flex items-center justify-between mb-4">
                      <!-- Reactions -->
                      <div class="flex space-x-4">
                        <div class="flex items-center">
                          <span class="text-red-500 text-xl">❤️</span>
                          <span class="ml-2 text-gray-600">123</span>
                        </div>
                        <div class="flex items-center">
                          <span class="text-blue-500 text-xl">😢</span>
                          <span class="ml-2 text-gray-600">8</span>
                        </div>
                      </div>
                  
                      <!-- Comments Icon -->
                      <button onclick="toggleComments()" class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-600">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m-7 4h8.486a2 2 0 001.414-.586l3.414-3.414A2 2 0 0022 14.485V7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2h1v3z" />
                        </svg>
                        <span class="text-gray-600">Comments</span>
                      </button>
                    </div>
                  
                    <!-- Comments Section (Initially Hidden) -->
                    <div id="commentsSection" class="hidden">
                      <div class="mt-4">
                        <div class="flex items-start mb-4">
                          <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User Avatar" class="w-8 h-8 rounded-full mr-3">
                          <div>
                            <p class="font-semibold text-sm">Jane Smith</p>
                            <p class="text-sm text-gray-700">That’s awesome! Keep it up!</p>
                          </div>
                        </div>
                  
                        <div class="flex items-start mb-4">
                          <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User Avatar" class="w-8 h-8 rounded-full mr-3">
                          <div>
                            <p class="font-semibold text-sm">Chris Johnson</p>
                            <p class="text-sm text-gray-700">Looking great! Love the new update.</p>
                          </div>
                        </div>
                  
                        <!-- Add a Comment -->
                        <div class="flex items-center mt-4">
                          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User Avatar" class="w-8 h-8 rounded-full mr-3">
                          <input type="text" placeholder="Add a comment..." class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
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

function toggleComments() {
    const commentsSection = document.getElementById('commentsSection');
    commentsSection.classList.toggle('hidden');
  }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>

    </x-layout>
    
    @include('partials._footer')
    