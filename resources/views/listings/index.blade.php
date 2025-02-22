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
                <div class="w-full max-w-6xl rounded bg-laravel shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
                    <div class="md:flex items-center -mx-10">
                        <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                            <div class="relative">
                                <img src="{{$event->image ? asset('storage/' . $event->image) : asset('/images/no-image.png')}}" class="w-full relative z-10 rounded" alt="">
                            </div>
                        </div>
                        

<div class="w-full md:w-1/2 px-10">
    <div class="mb-10">
        <h1 class="font-bold text-white uppercase text-2xl mb-5">{{$event->tags}}</h1>
        <h2 class="text-xl text-white mb-5">Here at <strong>{{$event->venue}}</strong></h2>

        <!-- Button to trigger modal -->
        
  

<div class="pt-4">
   
        <!-- Show the "Will be starting at" message only if the event has not ended -->
        <div class="inline-block align-bottom mr-5">
            <span class="text-lg text-white  leading-none align-baseline">Will be starting at</span>
            <span class="font-bold text-xl text-white leading-none align-baseline">{{$event->event_time}}</span>
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
            
                
                <div class="max-w-7xl mx-auto my-8 px-2">
                  <ul class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 p-2 xl:p-5">
                    @forelse($previousEvents as $event)
                          <li class="relative bg-white flex flex-col justify-between border rounded shadow-md hover:shadow-primary-400">
                              <a class="relative" href="/tool/writey-ai">
                                  <div class="relative w-full aspect-video">
                                      <img class="rounded w-full h-[280px] object-cover"
                                           src="{{ $event->image ? asset('storage/' . $event->image) : asset('/images/no-image.png') }}" alt="Event">
                                           <a href="/">
                                           
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
                              No Previous events.
                          </div>
                      @endforelse
                  </ul>
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
    